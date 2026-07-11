<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Temporary static content provider — the frontend is fully static for now.
 * Once the backend API (../app) is live, this class gets replaced by API calls.
 */
class StaticContent
{
    private static ?object $data = null;

    private static function data(): object
    {
        return self::$data ??= json_decode(file_get_contents(resource_path('content/content.json')));
    }

    public static function profile(): object
    {
        return self::data()->profile;
    }

    public static function projects(): Collection
    {
        return collect(self::data()->projects)
            ->filter(fn ($project) => ! ($project->is_archived ?? false))
            ->map(function ($project) {
                $project->images = self::projectImages($project);

                if (! ($project->image_url ?? null) && $project->images !== []) {
                    $project->image_url = $project->images[0];
                }

                return $project;
            })
            ->sortBy('sort_order')
            ->values();
    }

    /**
     * Images for a project are read straight from its public folder
     * (e.g. public/images/projects/sbirs) so new screenshots show up
     * without touching content.json.
     */
    private static function projectImages(object $project): array
    {
        $dir = $project->images_dir ?? null;

        if (! $dir || ! is_dir(public_path($dir))) {
            return [];
        }

        $images = [];

        foreach (glob(public_path($dir).'/*.{jpg,jpeg,png,webp,gif,JPG,JPEG,PNG,WEBP,GIF}', GLOB_BRACE) ?: [] as $file) {
            $images[] = asset(trim($dir, '/').'/'.rawurlencode(basename($file)));
        }

        sort($images);

        return $images;
    }

    public static function experience(): Collection
    {
        return collect(self::data()->experience)->sortBy('sort_order')->values();
    }

    public static function skills(): Collection
    {
        return collect(self::data()->skills)->sortBy('sort_order')->groupBy('group_name');
    }

    public static function posts(): Collection
    {
        return collect(self::data()->posts)
            ->map(function ($post) {
                $post->published_at = $post->published_at ? Carbon::parse($post->published_at) : null;

                return $post;
            })
            ->filter(fn ($post) => $post->published_at && $post->published_at->lte(now()))
            ->sortByDesc('published_at')
            ->values();
    }

    public static function post(string $slug): ?object
    {
        return self::posts()->firstWhere('slug', $slug);
    }

    public static function stats(): array
    {
        $profile = self::profile();

        return [
            'projects' => self::projects()->count(),
            'months' => $profile->stats_months_internship ?? 0,
            'technologies' => $profile->stats_technologies ?? 0,
            'percent' => $profile->stats_percent_learning ?? 100,
        ];
    }

    public static function coordinates(): ?array
    {
        $profile = self::profile();

        if (! ($profile->latitude ?? null) || ! ($profile->longitude ?? null)) {
            return null;
        }

        return ['lat' => $profile->latitude, 'lng' => $profile->longitude];
    }

    /**
     * Same curated quote bank the backend's QuoteService uses.
     *
     * @return array<int, array{text: string, author: string}>
     */
    public static function quotes(): array
    {
        return [
            ['text' => 'Talk is cheap. Show me the code.', 'author' => 'Linus Torvalds'],
            ['text' => 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.', 'author' => 'Martin Fowler'],
            ['text' => 'First, solve the problem. Then, write the code.', 'author' => 'John Johnson'],
            ['text' => 'Make it work, make it right, make it fast.', 'author' => 'Kent Beck'],
            ['text' => 'Programs must be written for people to read, and only incidentally for machines to execute.', 'author' => 'Harold Abelson'],
            ['text' => 'Premature optimization is the root of all evil.', 'author' => 'Donald Knuth'],
            ['text' => "It's not a bug – it's an undocumented feature.", 'author' => 'Anonymous'],
            ['text' => 'Debugging is twice as hard as writing the code in the first place.', 'author' => 'Brian Kernighan'],
            ['text' => 'Code is like humor. When you have to explain it, it\'s bad.', 'author' => 'Cory House'],
            ['text' => 'Simplicity is prerequisite for reliability.', 'author' => 'Edsger W. Dijkstra'],
            ['text' => 'Deleted code is debugged code.', 'author' => 'Jeff Sickel'],
            ['text' => 'There are only two hard things in Computer Science: cache invalidation and naming things.', 'author' => 'Phil Karlton'],
            ['text' => 'Walking on water and developing software from a specification are easy if both are frozen.', 'author' => 'Edward V. Berard'],
            ['text' => 'The most disastrous thing that you can ever learn is your first programming language.', 'author' => 'Alan Kay'],
            ['text' => 'Truth can only be found in one place: the code.', 'author' => 'Robert C. Martin'],
        ];
    }
}
