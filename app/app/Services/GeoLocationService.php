<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoLocationService
{
    /**
     * Look up country/city/isp for a public IP via ip-api.com's free tier.
     * Returns null for private/local/reserved IPs, which the API can't resolve.
     */
    public function lookup(string $ip): ?array
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return null;
        }

        try {
            $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,country,city,isp',
            ]);

            if (! $response->ok() || $response->json('status') !== 'success') {
                return null;
            }

            return [
                'country' => $response->json('country'),
                'city' => $response->json('city'),
                'isp' => $response->json('isp'),
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }
}
