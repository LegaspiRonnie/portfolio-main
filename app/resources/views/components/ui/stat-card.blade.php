@props([
    'label' => '',
    'value' => 0,
    'icon' => null,
    'trend' => null,
])

@php
    $trendUp = $trend && str_starts_with($trend, '+');
    $trendDown = $trend && str_starts_with($trend, '-');
    $trendClasses = $trendUp
        ? 'text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/30'
        : ($trendDown ? 'text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/30' : 'text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800');
@endphp

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-all duration-300']) }}>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $label }}</p>
            <p class="text-3xl font-semibold text-gray-900 dark:text-white counter" data-target="{{ $value }}">0</p>
        </div>
        @if ($icon)
            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-700 dark:text-blue-400 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                </svg>
            </div>
        @endif
    </div>

    @if ($trend)
        <span class="inline-flex items-center gap-1 mt-3 px-2 py-0.5 rounded-full text-xs font-medium transition-colors duration-300 {{ $trendClasses }}">
            {{ $trend }}
        </span>
    @endif
</div>
