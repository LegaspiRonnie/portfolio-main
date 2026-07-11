<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function currentWeather(float $lat, float $lng): ?array
    {
        $key = sprintf('weather:%s:%s', round($lat, 3), round($lng, 3));

        return Cache::remember($key, now()->addMinutes(30), function () use ($lat, $lng) {
            try {
                $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'current_weather' => true,
                    'timezone' => 'auto',
                ]);

                if (! $response->ok()) {
                    return null;
                }

                $current = $response->json('current_weather');

                if (! $current) {
                    return null;
                }

                $isDay = (bool) ($current['is_day'] ?? true);
                $code = (int) $current['weathercode'];

                return [
                    'temperature' => $current['temperature'],
                    'windspeed' => $current['windspeed'],
                    'is_day' => $isDay,
                    'description' => $this->describeWeatherCode($code),
                    'icon' => $this->iconForWeatherCode($code, $isDay),
                ];
            } catch (\Throwable $e) {
                return null;
            }
        });
    }

    private function describeWeatherCode(int $code): string
    {
        return match (true) {
            $code === 0 => 'Clear sky',
            in_array($code, [1, 2, 3], true) => 'Partly cloudy',
            in_array($code, [45, 48], true) => 'Foggy',
            in_array($code, [51, 53, 55, 56, 57], true) => 'Drizzle',
            in_array($code, [61, 63, 65, 66, 67], true) => 'Rain',
            in_array($code, [71, 73, 75, 77], true) => 'Snow',
            in_array($code, [80, 81, 82], true) => 'Rain showers',
            in_array($code, [95, 96, 99], true) => 'Thunderstorm',
            default => 'Unknown',
        };
    }

    private function iconForWeatherCode(int $code, bool $isDay): string
    {
        return match (true) {
            $code === 0 => $isDay ? '☀️' : '🌙',
            in_array($code, [1, 2, 3], true) => $isDay ? '⛅' : '☁️',
            in_array($code, [45, 48], true) => '🌫️',
            in_array($code, [51, 53, 55, 56, 57], true) => '🌦️',
            in_array($code, [61, 63, 65, 66, 67], true) => '🌧️',
            in_array($code, [71, 73, 75, 77], true) => '🌨️',
            in_array($code, [80, 81, 82], true) => '🌧️',
            in_array($code, [95, 96, 99], true) => '⛈️',
            default => '🌡️',
        };
    }
}
