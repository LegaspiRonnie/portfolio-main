@props([
    'autoplay' => false,
    'interval' => 5000,
])

<div
    x-data="{
        active: 0,
        total: 0,
        paused: false,
        timer: null,
        next() { this.active = (this.active + 1) % this.total; },
        prev() { this.active = (this.active - 1 + this.total) % this.total; },
    }"
    x-init="
        total = $refs.track.children.length;
        @if ($autoplay)
        timer = setInterval(() => { if (!paused && total > 1) next(); }, {{ (int) $interval }});
        @endif
    "
    @mouseenter="paused = true"
    @mouseleave="paused = false"
    class="relative"
>
    <div class="overflow-hidden rounded-lg">
        <div
            x-ref="track"
            class="flex transition-transform duration-500 ease-out [&>*]:w-full [&>*]:shrink-0"
            :style="'transform: translateX(-' + (active * 100) + '%)'"
        >
            {{ $slot }}
        </div>
    </div>

    <template x-if="total > 1">
        <div>
            <button
                type="button"
                @click="prev()"
                aria-label="Previous slide"
                class="absolute left-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white dark:hover:bg-gray-900 shadow-md transition-colors duration-300"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button
                type="button"
                @click="next()"
                aria-label="Next slide"
                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white dark:hover:bg-gray-900 shadow-md transition-colors duration-300"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div class="flex items-center justify-center gap-2 mt-4">
                <template x-for="(_, i) in total" :key="i">
                    <button
                        type="button"
                        @click="active = i"
                        :aria-label="'Go to slide ' + (i + 1)"
                        class="w-2 h-2 rounded-full transition-colors duration-300"
                        :class="active === i ? 'bg-blue-700 dark:bg-blue-400' : 'bg-gray-300 dark:bg-gray-700'"
                    ></button>
                </template>
            </div>
        </div>
    </template>
</div>
