@props([
    'images' => [],
])

<div x-data="{ open: false, index: 0, total: {{ count($images) }} }">
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
        @foreach ($images as $image)
            <button
                type="button"
                @click="index = {{ $loop->index }}; open = true"
                class="group relative aspect-square overflow-hidden rounded-lg cursor-zoom-in"
            >
                <img
                    src="{{ $image['src'] }}"
                    alt="{{ $image['alt'] ?? '' }}"
                    loading="lazy"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                >
            </button>
        @endforeach
    </div>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="open = false"
        @keydown.arrow-left.window="index = (index - 1 + total) % total"
        @keydown.arrow-right.window="index = (index + 1) % total"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
    >
        <div @click="open = false" class="absolute inset-0"></div>

        @foreach ($images as $image)
            <img
                x-show="index === {{ $loop->index }}"
                x-cloak
                @click.stop=""
                src="{{ $image['src'] }}"
                alt="{{ $image['alt'] ?? '' }}"
                class="relative z-0 max-h-[85vh] max-w-[90vw] object-contain rounded-lg"
            >
        @endforeach

        <button
            type="button"
            @click.stop="open = false"
            aria-label="Close"
            class="absolute z-10 top-4 right-4 p-2 rounded-full bg-black/40 text-white/80 hover:text-white hover:bg-black/60 transition-colors duration-300"
        >
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <button
            type="button"
            @click.stop="index = (index - 1 + total) % total"
            aria-label="Previous image"
            class="absolute z-10 left-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-black/40 text-white/80 hover:text-white hover:bg-black/60 transition-colors duration-300"
        >
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button
            type="button"
            @click.stop="index = (index + 1) % total"
            aria-label="Next image"
            class="absolute z-10 right-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-black/40 text-white/80 hover:text-white hover:bg-black/60 transition-colors duration-300"
        >
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>
