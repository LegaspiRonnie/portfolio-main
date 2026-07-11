@props([
    'items' => [],
])

@php
    $defaultIcon = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
@endphp

<div {{ $attributes->merge(['class' => 'relative pl-10']) }}>
    <div class="absolute left-4 top-0 bottom-0 w-px bg-gray-200 dark:bg-gray-800"></div>

    <div class="space-y-6">
        @foreach ($items as $item)
            <div class="relative flex items-start gap-3">
                <span class="absolute -left-10 flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] ?? $defaultIcon }}"/>
                    </svg>
                </span>

                <div class="flex-1 flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item['title'] ?? '' }}</p>
                        @if (!empty($item['description']))
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">{{ $item['description'] }}</p>
                        @endif
                    </div>
                    <span class="text-xs text-gray-400 dark:text-gray-500 whitespace-nowrap shrink-0">{{ $item['time'] ?? '' }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
