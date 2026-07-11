<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Http;

class LocationService
{
    /**
     * Resolve and persist lat/lng coordinates for the profile's location.
     *
     * Geocoded once via OpenStreetMap's free Nominatim API (chosen over
     * Open-Meteo's geocoder, whose database is sparse for small towns —
     * it otherwise mismatches "Pozorrubio" to a town in Spain), then
     * cached permanently on the profile row so we never call it again.
     */
    public function coordinatesFor(Profile $profile): ?array
    {
        if ($profile->latitude !== null && $profile->longitude !== null) {
            return [
                'lat' => (float) $profile->latitude,
                'lng' => (float) $profile->longitude,
            ];
        }

        if (! $profile->location) {
            return null;
        }

        try {
            $response = Http::timeout(5)
                ->withHeaders(['User-Agent' => 'RonnieLegaspiPortfolio/1.0'])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => $profile->location,
                    'format' => 'json',
                    'limit' => 1,
                ]);

            if (! $response->ok() || empty($response->json())) {
                return null;
            }

            $result = $response->json('0');

            $profile->update([
                'latitude' => $result['lat'],
                'longitude' => $result['lon'],
            ]);

            return [
                'lat' => (float) $result['lat'],
                'lng' => (float) $result['lon'],
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }
}
