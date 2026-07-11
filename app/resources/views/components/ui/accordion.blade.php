@props([
    'items' => [],
])

<div x-data="{ openIndex: null }" class="border-t border-gray-200 dark:border-gray-800">
    @foreach ($items as $item)
        <div class="border-b border-gray-200 dark:border-gray-800">
            <button
                type="button"
                @click="openIndex = openIndex === {{ $loop->index }} ? null : {{ $loop->index }}"
                class="w-full flex items-center justify-between gap-4 py-4 text-left"
                :aria-expanded="openIndex === {{ $loop->index }}"
            >
                <span class="font-medium text-gray-900 dark:text-white">{{ $item['question'] }}</span>
                <svg
                    class="w-4 h-4 shrink-0 text-gray-400 dark:text-gray-500 transition-transform duration-300"
                    :class="openIndex === {{ $loop->index }} && 'rotate-180'"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div
                x-show="openIndex === {{ $loop->index }}"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="pb-4 pr-8 text-sm text-gray-600 dark:text-gray-400 leading-relaxed"
            >
                {{ $item['answer'] }}
            </div>
        </div>
    @endforeach
</div>
