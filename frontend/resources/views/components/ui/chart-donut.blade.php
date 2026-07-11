{{-- Pass segment colors as valid SVG stroke values, e.g. '#2563eb' or 'currentColor'. --}}
@props([
    'segments' => [],
])

@php
    $size = 160;
    $strokeWidth = 20;
    $radius = ($size - $strokeWidth) / 2;
    $circumference = 2 * pi() * $radius;
    $center = $size / 2;
    $total = array_sum(array_column($segments, 'value')) ?: 1;

    $cumulative = 0;
    $computed = [];
    foreach ($segments as $segment) {
        $value = $segment['value'] ?? 0;
        $percent = $value / $total * 100;
        $dash = ($percent / 100) * $circumference;
        $offset = $circumference - ($cumulative / 100) * $circumference;

        $computed[] = [
            'label' => $segment['label'] ?? '',
            'color' => $segment['color'] ?? '#2563eb',
            'value' => $value,
            'percent' => $percent,
            'dasharray' => "$dash " . ($circumference - $dash),
            'offset' => $offset,
        ];

        $cumulative += $percent;
    }
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col items-center gap-6']) }}>
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size }} {{ $size }}" class="-rotate-90 origin-center">
        <circle
            cx="{{ $center }}"
            cy="{{ $center }}"
            r="{{ $radius }}"
            fill="none"
            stroke="currentColor"
            stroke-width="{{ $strokeWidth }}"
            class="text-gray-100 dark:text-gray-800"
        />
        @foreach ($computed as $seg)
            <circle
                cx="{{ $center }}"
                cy="{{ $center }}"
                r="{{ $radius }}"
                fill="none"
                stroke="{{ $seg['color'] }}"
                stroke-width="{{ $strokeWidth }}"
                stroke-dasharray="{{ $seg['dasharray'] }}"
                stroke-dashoffset="{{ $seg['offset'] }}"
                class="transition-all duration-500"
            />
        @endforeach
    </svg>

    <ul class="w-full space-y-2">
        @foreach ($computed as $seg)
            <li class="flex items-center justify-between text-sm">
                <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $seg['color'] }}"></span>
                    {{ $seg['label'] }}
                </span>
                <span class="font-medium text-gray-900 dark:text-white">{{ round($seg['percent']) }}%</span>
            </li>
        @endforeach
    </ul>
</div>
