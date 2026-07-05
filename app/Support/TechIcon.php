<?php

namespace App\Support;

class TechIcon
{
    /**
     * Maps known technology names to their Simple Icons slug (cdn.simpleicons.org).
     * Slugs verified live — entries with no reliable brand mark (e.g. "Microsoft
     * Office Suite", generic soft-skills) are intentionally omitted.
     */
    private const SLUGS = [
        'laravel (php)' => 'laravel',
        'laravel' => 'laravel',
        'react.js' => 'react',
        'vue.js' => 'vuedotjs',
        'javascript' => 'javascript',
        'typescript' => 'typescript',
        'html' => 'html5',
        'css' => 'css',
        'mysql' => 'mysql',
        'unity' => 'unity',
        'c#' => 'dotnet',
        'git' => 'git',
        'github' => 'github',
        'php' => 'php',
    ];

    public static function url(string $name): ?string
    {
        $slug = self::SLUGS[strtolower(trim($name))] ?? null;

        return $slug ? "https://cdn.simpleicons.org/{$slug}" : null;
    }
}
