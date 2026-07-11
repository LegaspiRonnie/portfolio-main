{{-- Self-contained toggle. Listen with x-on:view-changed.window="..." for global reach,
     or wrap this and the content it controls in a shared x-data ancestor and read `view` directly. --}}
@props([])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 p-1 rounded-lg bg-gray-100 dark:bg-gray-800']) }} x-data="{ view: 'grid' }">
    <button
        type="button"
        @click="view = 'grid'; $dispatch('view-changed', 'grid')"
        :class="view === 'grid' ? 'bg-white dark:bg-gray-900 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
        class="p-1.5 rounded-md transition-colors duration-300"
        aria-label="Grid view"
    >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
    </button>

    <button
        type="button"
        @click="view = 'list'; $dispatch('view-changed', 'list')"
        :class="view === 'list' ? 'bg-white dark:bg-gray-900 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
        class="p-1.5 rounded-md transition-colors duration-300"
        aria-label="List view"
    >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>
