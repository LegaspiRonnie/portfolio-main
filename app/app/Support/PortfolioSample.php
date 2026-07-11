<?php

namespace App\Support;

class PortfolioSample
{
    private const META = [
        'client1' => [
            'title' => 'Personal Portfolio Website',
            'url' => 'https://ronnie-legaspi.vercel.app',
            'description' => 'An earlier build of my personal developer portfolio — designed and deployed on Vercel with a clean, minimal one-page layout.',
        ],
    ];

    public static function all(): array
    {
        $root = public_path('images/portfolio');

        if (! is_dir($root)) {
            return [];
        }

        $samples = [];

        foreach (scandir($root) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $dir = $root.DIRECTORY_SEPARATOR.$entry;

            if (! is_dir($dir)) {
                continue;
            }

            $images = [];

            foreach (glob($dir.'/*.{jpg,jpeg,png,webp,gif,JPG,JPEG,PNG,WEBP,GIF}', GLOB_BRACE) ?: [] as $file) {
                $images[] = asset('images/portfolio/'.rawurlencode($entry).'/'.rawurlencode(basename($file)));
            }

            sort($images);

            $meta = self::META[$entry] ?? [
                'title' => ucfirst(str_replace(['-', '_'], ' ', $entry)),
                'url' => null,
                'description' => null,
            ];

            $samples[] = array_merge($meta, ['slug' => $entry, 'images' => $images]);
        }

        return $samples;
    }
}
