@props([
    'size' => 'md',
    'label' => null,
])

@php
$sizeClasses = [
    'sm' => 'w-4 h-4 border-2',
    'md' => 'w-6 h-6 border-2',
    'lg' => 'w-10 h-10 border-4',
][$size] ?? 'w-6 h-6 border-2';
@endphp

<span class="inline-flex items-center gap-2" role="status">
    <span class="{{ $sizeClasses }} rounded-full border-gray-200 dark:border-gray-800 border-t-blue-700 dark:border-t-blue-400 animate-spin"></span>
    @if ($label)
        <span class="sr-only">{{ $label }}</span>
    @endif
</span>
