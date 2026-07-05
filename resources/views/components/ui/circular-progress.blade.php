@props([
    'percent' => 0,
    'size' => 96,
    'strokeWidth' => 8,
    'label' => null,
    'color' => 'blue',
])

@php
    $percent = max(0, min(100, (float) $percent));
    $radius = ($size - $strokeWidth) / 2;
    $circumference = 2 * pi() * $radius;
    $offset = $circumference - ($percent / 100) * $circumference;
    $center = $size / 2;

    $colorClasses = match ($color) {
        'green' => 'text-green-600 dark:text-green-400',
        'red' => 'text-red-600 dark:text-red-400',
        'yellow' => 'text-yellow-500 dark:text-yellow-400',
        'gray' => 'text-gray-600 dark:text-gray-400',
        default => 'text-blue-700 dark:text-blue-400',
    };

    $displayLabel = $label ?? (round($percent) . '%');
@endphp

<div {{ $attributes->merge(['class' => 'relative inline-flex items-center justify-center']) }} style="width: {{ $size }}px; height: {{ $size }}px;">
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size }} {{ $size }}" class="-rotate-90 origin-center">
        <circle
            cx="{{ $center }}"
            cy="{{ $center }}"
            r="{{ $radius }}"
            fill="none"
            stroke="currentColor"
            stroke-width="{{ $strokeWidth }}"
            class="text-gray-200 dark:text-gray-800"
        />
        <circle
            cx="{{ $center }}"
            cy="{{ $center }}"
            r="{{ $radius }}"
            fill="none"
            stroke="currentColor"
            stroke-width="{{ $strokeWidth }}"
            stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"
            class="{{ $colorClasses }} transition-all duration-500"
        />
    </svg>
    <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-900 dark:text-white">
        {{ $displayLabel }}
    </span>
</div>
