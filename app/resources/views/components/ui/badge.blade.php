@props([
    'label' => null,
    'color' => 'blue',
    'variant' => 'soft',
])

@php
    $soft = match ($color) {
        'green' => 'bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400',
        'red' => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400',
        'yellow' => 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
        'gray' => 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300',
        default => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
    };

    $solid = match ($color) {
        'green' => 'bg-green-700 text-white',
        'red' => 'bg-red-700 text-white',
        'yellow' => 'bg-yellow-600 text-white',
        'gray' => 'bg-gray-700 text-white',
        default => 'bg-blue-700 text-white',
    };

    $colorClasses = $variant === 'solid' ? $solid : $soft;
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium transition-colors duration-300 $colorClasses"]) }}>
    {{ $label ?? $slot }}
</span>
