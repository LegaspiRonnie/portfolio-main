<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use App\Services\GeoLocationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $visitorCookie = $request->cookie('visitor_id');
        $isNewCookie = ! $visitorCookie;

        if ($isNewCookie) {
            $visitorCookie = (string) Str::uuid();
        }

        $visit = Visit::create([
            'ip_address' => $request->ip(),
            'path' => '/'.ltrim($request->path(), '/'),
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
            'visitor_cookie' => $visitorCookie,
            'session_id' => $request->hasSession() ? $request->session()->getId() : null,
        ]);

        $response = $next($request);

        if ($isNewCookie) {
            $response->withCookie(cookie('visitor_id', $visitorCookie, 60 * 24 * 365));
        }

        // Geolocate after the response is sent so it never slows down the page load.
        dispatch(function () use ($visit) {
            $geo = app(GeoLocationService::class)->lookup($visit->ip_address);

            if ($geo) {
                $visit->update($geo);
            }
        })->afterResponse();

        return $response;
    }
}
