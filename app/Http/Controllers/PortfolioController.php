<?php

namespace App\Http\Controllers;

use App\Models\ExperienceEntry;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Services\GitHubService;
use App\Services\LocationService;
use App\Services\QuoteService;
use App\Services\WeatherService;
use App\Support\PortfolioSample;

class PortfolioController extends Controller
{
    public function __construct(
        private LocationService $locationService,
        private WeatherService $weatherService,
        private GitHubService $gitHubService,
        private QuoteService $quoteService,
    ) {}

    public function index()
    {
        $profile = Profile::first();
        $projects = Project::where('is_archived', false)->orderBy('sort_order')->get();
        $experience = ExperienceEntry::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get()->groupBy('group_name');

        $stats = [
            'projects' => $projects->count(),
            'months' => $profile->stats_months_internship ?? 0,
            'technologies' => $profile->stats_technologies ?? 0,
            'percent' => $profile->stats_percent_learning ?? 100,
        ];

        $coordinates = $this->locationService->coordinatesFor($profile);
        $weather = $coordinates ? $this->weatherService->currentWeather($coordinates['lat'], $coordinates['lng']) : null;
        $github = $this->gitHubService->profileFor($profile->github_username);
        $quotes = $this->quoteService->all();
        $posts = Post::published()->orderByDesc('published_at')->limit(3)->get();
        $samples = PortfolioSample::all();

        return view('home', compact('profile', 'projects', 'experience', 'skills', 'stats', 'coordinates', 'weather', 'github', 'quotes', 'posts', 'samples'));
    }
}
