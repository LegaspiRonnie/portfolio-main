@props([
    'items' => [],
])

@php
    $typeColor = fn ($type) => match ($type) {
        'work' => 'bg-blue-700 dark:bg-blue-400',
        'education' => 'bg-green-600 dark:bg-green-400',
        'note' => 'bg-gray-400 dark:bg-gray-500',
        default => 'bg-blue-700 dark:bg-blue-400',
    };
@endphp

<div {{ $attributes->merge(['class' => 'relative pl-10']) }}>
    <div class="absolute left-4 top-0 bottom-0 w-px bg-gray-200 dark:bg-gray-800"></div>

    <div class="space-y-8">
        @foreach ($items as $item)
            <div
                data-reveal
                style="--reveal-delay:{{ $loop->index * 90 }}ms"
                class="relative"
            >
                <span class="absolute -left-[26px] top-1.5 w-3 h-3 rounded-full {{ $typeColor($item['type'] ?? null) }} ring-4 ring-white dark:ring-gray-950"></span>

                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-5 transition-all duration-300">
                    <p class="text-xs font-mono text-blue-700 dark:text-blue-400 mb-1">{{ $item['date'] ?? '' }}</p>
                    <h4 class="font-medium text-gray-900 dark:text-white mb-1">{{ $item['title'] ?? '' }}</h4>
                    @if (!empty($item['description']))
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $item['description'] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
