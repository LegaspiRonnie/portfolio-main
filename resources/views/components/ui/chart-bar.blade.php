@props([
    'labels' => [],
    'values' => [],
    'color' => 'blue',
    'height' => 160,
])

@php
    $max = max(count($values) ? $values : [0]);
    $max = $max > 0 ? $max : 1;

    $barColorClasses = match ($color) {
        'green' => 'bg-green-600 dark:bg-green-500',
        'red' => 'bg-red-600 dark:bg-red-500',
        'yellow' => 'bg-yellow-500 dark:bg-yellow-400',
        'gray' => 'bg-gray-600 dark:bg-gray-500',
        default => 'bg-blue-600 dark:bg-blue-500',
    };
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="flex items-end gap-2" style="height: {{ $height }}px;">
        @foreach ($values as $i => $value)
            @php $percentHeight = $max > 0 ? max(($value / $max) * 100, 2) : 2; @endphp
            <div class="flex-1 flex flex-col items-center justify-end h-full gap-2" title="{{ $labels[$i] ?? '' }}: {{ $value }}">
                <div class="w-full rounded-t {{ $barColorClasses }} transition-all duration-300" style="height: {{ $percentHeight }}%"></div>
                @if (isset($labels[$i]))
                    <span class="text-xs text-gray-500 dark:text-gray-400 truncate w-full text-center">{{ $labels[$i] }}</span>
                @endif
            </div>
        @endforeach
    </div>
</div>
