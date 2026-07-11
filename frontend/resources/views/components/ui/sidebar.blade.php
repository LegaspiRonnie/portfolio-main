@props([
    'items' => [],
    'title' => null,
])

<div
    {{ $attributes->merge(['class' => 'h-full flex flex-col border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 transition-colors duration-300 transition-all duration-300']) }}
    x-data="{ collapsed: localStorage.getItem('sidebar-collapsed') === 'true' }"
    x-init="$watch('collapsed', v => localStorage.setItem('sidebar-collapsed', v))"
    :class="collapsed ? 'w-16' : 'w-64'"
>
    <div class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-800">
        <span x-show="!collapsed" class="font-semibold text-gray-900 dark:text-white truncate">{{ $title }}</span>
        <button
            type="button"
            @click="collapsed = !collapsed"
            class="p-1.5 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300 shrink-0"
            aria-label="Toggle sidebar"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-2">
        @foreach ($items as $item)
            <a
                href="{{ $item['href'] ?? '#' }}"
                class="flex items-center gap-3 px-2.5 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-700 dark:hover:text-blue-400 transition-colors duration-300"
                :title="collapsed ? '{{ $item['label'] ?? '' }}' : ''"
            >
                @if (!empty($item['icon']))
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                    </svg>
                @endif
                <span x-show="!collapsed" class="truncate">{{ $item['label'] ?? '' }}</span>
            </a>
        @endforeach
    </nav>
</div>
