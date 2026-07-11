@props([
    'hover' => false,
    'padding' => 'p-6',
])

@php
    $hoverClasses = $hover ? 'hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none' : '';
@endphp

<div {{ $attributes->merge(['class' => "bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg $padding transition-all duration-300 $hoverClasses"]) }}>
    {{ $slot }}
</div>
