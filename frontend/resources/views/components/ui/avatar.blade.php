@props([
    'src' => null,
    'name' => 'User',
    'size' => 'md',
    'ring' => false,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'w-8 h-8',
        'lg' => 'w-16 h-16',
        'xl' => 'w-24 h-24',
        default => 'w-12 h-12',
    };

    $ringClasses = $ring ? 'ring-2 ring-white dark:ring-gray-900' : '';
    $imageUrl = $src ?: 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=1d4ed8&color=ffffff&bold=true';
@endphp

<img
    {{ $attributes->merge(['class' => "$sizeClasses $ringClasses rounded-full object-cover shrink-0 transition-colors duration-300"]) }}
    src="{{ $imageUrl }}"
    alt="{{ $name }}"
    loading="lazy"
>
