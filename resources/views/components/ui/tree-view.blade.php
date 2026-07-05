@props([
    'nodes' => [],
])

<ul {{ $attributes->merge(['class' => 'space-y-1']) }}>
    @foreach ($nodes as $node)
        @php $hasChildren = !empty($node['children']); @endphp
        <li>
            @if ($hasChildren)
                <div x-data="{ open: true }">
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-1.5 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-700 dark:hover:text-blue-400 transition-colors duration-300"
                    >
                        <svg
                            class="w-3.5 h-3.5 shrink-0 transition-transform duration-200"
                            :class="open ? 'rotate-90' : 'rotate-0'"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="font-medium">{{ $node['label'] ?? '' }}</span>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        class="pl-5 border-l border-gray-200 dark:border-gray-800 ml-2 mt-1"
                    >
                        <x-ui.tree-view :nodes="$node['children']" />
                    </div>
                </div>
            @else
                <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400 pl-5">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span>
                    <span>{{ $node['label'] ?? '' }}</span>
                </div>
            @endif
        </li>
    @endforeach
</ul>
