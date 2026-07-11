@props([
    'variant' => 'text',
    'width' => null,
    'height' => null,
    'count' => 1,
])

@php
$lines = max(1, (int) $count);
@endphp

@if ($variant === 'circle' || $variant === 'avatar')
    @php
    $diameter = $width ?? $height ?? ($variant === 'avatar' ? '48px' : '40px');
    @endphp
    <div
        class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded-full"
        style="width: {{ $diameter }}; height: {{ $diameter }};"
    ></div>
@elseif ($variant === 'rect')
    <div
        class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded-lg"
        style="width: {{ $width ?? '100%' }}; height: {{ $height ?? '120px' }};"
    ></div>
@elseif ($variant === 'card')
    <div class="border border-gray-200 dark:border-gray-800 rounded-lg p-4 space-y-4" style="{{ $width ? "width:{$width};" : '' }}">
        <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded-lg w-full" style="height: {{ $height ?? '140px' }};"></div>
        <div class="space-y-2">
            <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded h-3 w-full"></div>
            <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded h-3 w-5/6"></div>
            <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded h-3 w-2/3"></div>
        </div>
        <div class="flex items-center gap-3 pt-1">
            <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded-full w-9 h-9 shrink-0"></div>
            <div class="flex-1 space-y-2">
                <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded h-2.5 w-1/2"></div>
                <div class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded h-2.5 w-1/3"></div>
            </div>
        </div>
    </div>
@else
    <div class="space-y-2" style="{{ $width ? "width:{$width};" : '' }}">
        @for ($i = 0; $i < $lines; $i++)
            <div
                class="animate-pulse bg-gray-200 dark:bg-gray-800 rounded {{ $i === $lines - 1 && $lines > 1 ? 'w-2/3' : 'w-full' }}"
                style="height: {{ $height ?? '0.75rem' }};"
            ></div>
        @endfor
    </div>
@endif
