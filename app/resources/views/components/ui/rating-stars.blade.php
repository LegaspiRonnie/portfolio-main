@props([
    'value' => 0,
    'max' => 5,
    'size' => 'md',
    'readonly' => true,
    'name' => null,
])

@php
$sizeClasses = [
    'sm' => 'w-4 h-4',
    'md' => 'w-5 h-5',
    'lg' => 'w-7 h-7',
][$size] ?? 'w-5 h-5';
$starPath = 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z';
@endphp

@if ($readonly)
    <div class="inline-flex items-center gap-0.5" role="img" aria-label="{{ number_format((float) $value, 1) }} out of {{ $max }} stars">
        @for ($i = 1; $i <= $max; $i++)
            @php $fill = max(0, min(1, ((float) $value) - ($i - 1))) * 100; @endphp
            <span class="relative inline-block {{ $sizeClasses }}">
                <svg class="{{ $sizeClasses }} text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="{{ $starPath }}"/>
                </svg>
                <span class="absolute inset-0 top-0 left-0 overflow-hidden" style="width: {{ $fill }}%;">
                    <svg class="{{ $sizeClasses }} text-blue-700 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $starPath }}"/>
                    </svg>
                </span>
            </span>
        @endfor
    </div>
@else
    <div x-data="{ rating: {{ (float) $value }}, hovered: null }" class="inline-flex items-center gap-0.5">
        <input type="hidden" name="{{ $name }}" x-model="rating">
        @for ($i = 1; $i <= $max; $i++)
            <button
                type="button"
                @click="rating = {{ $i }}"
                @mouseenter="hovered = {{ $i }}"
                @mouseleave="hovered = null"
                aria-label="Rate {{ $i }} out of {{ $max }}"
                class="{{ $sizeClasses }} cursor-pointer"
            >
                <svg
                    class="{{ $sizeClasses }} transition-colors duration-150"
                    :class="(hovered ?? rating) >= {{ $i }} ? 'text-blue-700 dark:text-blue-400' : 'text-gray-300 dark:text-gray-700'"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path d="{{ $starPath }}"/>
                </svg>
            </button>
        @endfor
    </div>
@endif
