<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubService
{
    public function profileFor(?string $username): ?array
    {
        if (! $username) {
            return null;
        }

        return Cache::remember("github:profile:{$username}", now()->addHour(), function () use ($username) {
            try {
                $userResponse = Http::timeout(5)
                    ->withHeaders(['Accept' => 'application/vnd.github+json'])
                    ->get("https://api.github.com/users/{$username}");

                if (! $userResponse->ok()) {
                    return null;
                }

                $reposResponse = Http::timeout(5)
                    ->withHeaders(['Accept' => 'application/vnd.github+json'])
                    ->get("https://api.github.com/users/{$username}/repos", [
                        'sort' => 'updated',
                        'per_page' => 3,
                    ]);

                $repos = $reposResponse->ok()
                    ? collect($reposResponse->json())
                        ->map(fn (array $repo) => [
                            'name' => $repo['name'],
                            'url' => $repo['html_url'],
                            'description' => $repo['description'],
                            'stars' => $repo['stargazers_count'],
                            'language' => $repo['language'],
                        ])
                        ->all()
                    : [];

                $user = $userResponse->json();

                return [
                    'username' => $user['login'],
                    'avatar_url' => $user['avatar_url'],
                    'profile_url' => $user['html_url'],
                    'public_repos' => $user['public_repos'],
                    'followers' => $user['followers'],
                    'repos' => $repos,
                ];
            } catch (\Throwable $e) {
                return null;
            }
        });
    }
}
