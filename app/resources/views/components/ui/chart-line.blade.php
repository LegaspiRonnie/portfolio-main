@props([
    'values' => [],
    'color' => 'blue',
    'height' => 120,
    'width' => 400,
])

@php
    $count = count($values);
    $min = $count ? min($values) : 0;
    $max = $count ? max($values) : 1;
    $range = ($max - $min) ?: 1;
    $padding = 8;

    $points = [];
    foreach ($values as $i => $value) {
        $x = $count > 1 ? ($i / ($count - 1)) * ($width - $padding * 2) + $padding : $width / 2;
        $normalized = ($value - $min) / $range;
        $y = ($height - $padding) - ($normalized * ($height - $padding * 2));
        $points[] = ['x' => round($x, 2), 'y' => round($y, 2)];
    }

    $pointsAttr = implode(' ', array_map(fn ($p) => "{$p['x']},{$p['y']}", $points));

    $colorClasses = match ($color) {
        'green' => 'text-green-600 dark:text-green-400',
        'red' => 'text-red-600 dark:text-red-400',
        'yellow' => 'text-yellow-500 dark:text-yellow-400',
        'gray' => 'text-gray-600 dark:text-gray-400',
        default => 'text-blue-700 dark:text-blue-400',
    };
@endphp

<svg {{ $attributes->merge(['class' => "$colorClasses w-full"]) }} viewBox="0 0 {{ $width }} {{ $height }}" preserveAspectRatio="none" style="height: {{ $height }}px;">
    <polyline
        points="{{ $pointsAttr }}"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    @foreach ($points as $point)
        <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="3" fill="currentColor" />
    @endforeach
</svg>
