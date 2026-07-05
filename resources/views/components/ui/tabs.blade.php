{{-- Content is rendered raw via {!! !!}. Callers must pass trusted/pre-escaped HTML. --}}
@props([
    'tabs' => [],
])

<div {{ $attributes->merge(['class' => 'w-full']) }} x-data="{ active: 0 }">
    <div class="flex items-center gap-1 border-b border-gray-200 dark:border-gray-800">
        @foreach ($tabs as $i => $tab)
            <button
                type="button"
                @click="active = {{ $i }}"
                :class="active === {{ $i }} ? 'text-blue-700 dark:text-blue-400 border-blue-700 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 border-transparent hover:text-gray-700 dark:hover:text-gray-300'"
                class="px-4 py-2.5 text-sm font-medium border-b-2 -mb-px transition-colors duration-300"
            >
                {{ $tab['label'] ?? 'Tab ' . ($i + 1) }}
            </button>
        @endforeach
    </div>

    @foreach ($tabs as $i => $tab)
        <div
            x-show="active === {{ $i }}"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="pt-4"
        >
            {!! $tab['content'] ?? '' !!}
        </div>
    @endforeach
</div>
