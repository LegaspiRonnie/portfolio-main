<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Profile;
use App\Services\GeoLocationService;
use App\Services\GitHubService;
use App\Services\LocationService;
use App\Services\WeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExternalIntegrationsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_location_service_geocodes_and_persists_coordinates(): void
    {
        Http::fake([
            'nominatim.openstreetmap.org/*' => Http::response([
                ['lat' => '15.9944', 'lon' => '120.5486'],
            ]),
        ]);

        $profile = Profile::first();
        $this->assertNull($profile->latitude);

        $coordinates = app(LocationService::class)->coordinatesFor($profile);

        $this->assertSame(15.9944, $coordinates['lat']);
        $this->assertSame(120.5486, $coordinates['lng']);
        $this->assertNotNull($profile->fresh()->latitude);
    }

    public function test_location_service_skips_geocoding_once_coordinates_are_cached_on_the_profile(): void
    {
        Http::fake();

        $profile = Profile::first();
        $profile->update(['latitude' => 10.0, 'longitude' => 20.0]);

        $coordinates = app(LocationService::class)->coordinatesFor($profile);

        $this->assertSame(10.0, $coordinates['lat']);
        Http::assertNothingSent();
    }

    public function test_location_service_returns_null_when_geocoding_api_fails(): void
    {
        Http::fake([
            'nominatim.openstreetmap.org/*' => Http::response([], 500),
        ]);

        $coordinates = app(LocationService::class)->coordinatesFor(Profile::first());

        $this->assertNull($coordinates);
    }

    public function test_weather_service_returns_current_conditions(): void
    {
        Http::fake([
            'api.open-meteo.com/*' => Http::response([
                'current_weather' => [
                    'temperature' => 29.4,
                    'windspeed' => 10.2,
                    'weathercode' => 1,
                    'is_day' => 1,
                ],
            ]),
        ]);

        $weather = app(WeatherService::class)->currentWeather(15.9944, 120.5486);

        $this->assertSame(29.4, $weather['temperature']);
        $this->assertSame('Partly cloudy', $weather['description']);
    }

    public function test_weather_service_gracefully_returns_null_on_failure(): void
    {
        Http::fake([
            'api.open-meteo.com/*' => Http::response([], 503),
        ]);

        $this->assertNull(app(WeatherService::class)->currentWeather(0, 0));
    }

    public function test_github_service_returns_null_when_username_not_configured(): void
    {
        Http::fake();

        $this->assertNull(app(GitHubService::class)->profileFor(null));
        Http::assertNothingSent();
    }

    public function test_github_service_returns_profile_and_repos(): void
    {
        Http::fake([
            'api.github.com/users/ronnie-legaspi' => Http::response([
                'login' => 'ronnie-legaspi',
                'avatar_url' => 'https://avatars.githubusercontent.com/u/1',
                'html_url' => 'https://github.com/ronnie-legaspi',
                'public_repos' => 12,
                'followers' => 3,
            ]),
            'api.github.com/users/ronnie-legaspi/repos*' => Http::response([
                ['name' => 'jobdocs-roadmap', 'html_url' => 'https://github.com/ronnie-legaspi/jobdocs-roadmap', 'description' => 'A roadmap app', 'stargazers_count' => 2, 'language' => 'JavaScript'],
            ]),
        ]);

        $github = app(GitHubService::class)->profileFor('ronnie-legaspi');

        $this->assertSame('ronnie-legaspi', $github['username']);
        $this->assertSame(12, $github['public_repos']);
        $this->assertCount(1, $github['repos']);
        $this->assertSame('jobdocs-roadmap', $github['repos'][0]['name']);
    }

    public function test_geolocation_service_skips_private_ips_without_calling_api(): void
    {
        Http::fake();

        $this->assertNull(app(GeoLocationService::class)->lookup('127.0.0.1'));
        $this->assertNull(app(GeoLocationService::class)->lookup('192.168.1.10'));
        Http::assertNothingSent();
    }

    public function test_geolocation_service_enriches_public_ip(): void
    {
        Http::fake([
            'ip-api.com/*' => Http::response([
                'status' => 'success',
                'country' => 'Philippines',
                'city' => 'Pozorrubio',
                'isp' => 'PLDT',
            ]),
        ]);

        $geo = app(GeoLocationService::class)->lookup('8.8.8.8');

        $this->assertSame('Philippines', $geo['country']);
        $this->assertSame('Pozorrubio', $geo['city']);
    }

    public function test_homepage_renders_weather_and_qr_code_when_location_resolves(): void
    {
        Http::fake([
            'nominatim.openstreetmap.org/*' => Http::response([
                ['lat' => '15.9944', 'lon' => '120.5486'],
            ]),
            'api.open-meteo.com/*' => Http::response([
                'current_weather' => ['temperature' => 29.4, 'windspeed' => 10.2, 'weathercode' => 0, 'is_day' => 1],
            ]),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('29.4°C', false);
        $response->assertSee('api.qrserver.com', false);
        $response->assertSee('leaflet', false);
    }

    public function test_homepage_hides_github_section_when_username_not_set(): void
    {
        Http::fake();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('id="github"', false);
    }

    public function test_homepage_shows_github_section_when_username_set(): void
    {
        Profile::first()->update(['github_username' => 'ronnie-legaspi']);

        Http::fake([
            'api.github.com/users/ronnie-legaspi' => Http::response([
                'login' => 'ronnie-legaspi',
                'avatar_url' => 'https://avatars.githubusercontent.com/u/1',
                'html_url' => 'https://github.com/ronnie-legaspi',
                'public_repos' => 12,
                'followers' => 3,
            ]),
            'api.github.com/users/ronnie-legaspi/repos*' => Http::response([]),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="github"', false);
        $response->assertSee('Recent GitHub activity');
    }

    public function test_discord_webhook_fires_when_configured(): void
    {
        Http::fake();
        config(['services.discord.contact_webhook_url' => 'https://discord.com/api/webhooks/test/token']);

        ContactMessage::create([
            'name' => 'Jane Recruiter',
            'email' => 'jane@example.com',
            'message' => 'Hello there',
        ]);

        Http::assertSent(fn ($request) => $request->url() === 'https://discord.com/api/webhooks/test/token');
    }

    public function test_discord_webhook_is_skipped_when_not_configured(): void
    {
        Http::fake();
        config(['services.discord.contact_webhook_url' => null]);

        ContactMessage::create([
            'name' => 'Jane Recruiter',
            'email' => 'jane@example.com',
            'message' => 'Hello there',
        ]);

        Http::assertNothingSent();
    }
}
