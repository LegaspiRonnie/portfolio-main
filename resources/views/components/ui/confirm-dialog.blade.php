@props([])

<div
    x-data
    x-show="$store.confirm.open"
    x-cloak
    @keydown.escape.window="$store.confirm.cancel()"
    class="fixed inset-0 z-[80] flex items-center justify-center p-4"
>
    <div
        x-show="$store.confirm.open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
        @click="$store.confirm.cancel()"
    ></div>

    <div
        x-show="$store.confirm.open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-2xl p-6"
    >
        <h3 class="font-semibold text-gray-900 dark:text-white mb-2" x-text="$store.confirm.title"></h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6" x-text="$store.confirm.message"></p>
        <div class="flex items-center justify-end gap-3">
            <button
                type="button"
                @click="$store.confirm.cancel()"
                class="px-4 py-2 rounded-lg text-sm font-medium border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors"
                x-text="$store.confirm.cancelText"
            ></button>
            <button
                type="button"
                @click="$store.confirm.confirm()"
                class="px-4 py-2 rounded-lg text-sm font-medium bg-blue-700 hover:bg-blue-800 text-white transition-colors"
                x-text="$store.confirm.confirmText"
            ></button>
        </div>
    </div>
</div>
