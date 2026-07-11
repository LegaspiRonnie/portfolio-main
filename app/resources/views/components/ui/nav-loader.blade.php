<div
    x-data="{ show: false, _t: null }"
    x-init="
        window.addEventListener('nav-loader:start', () => {
            clearTimeout(_t);
            _t = setTimeout(() => { show = true; }, 120);
        });
        window.addEventListener('nav-loader:stop', () => {
            clearTimeout(_t);
            show = false;
        });
    "
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[70] flex items-center justify-center bg-white/50 dark:bg-gray-950/50 backdrop-blur-[1px] pointer-events-none"
    aria-hidden="true"
>
    <span class="w-10 h-10 rounded-full border-[3px] border-blue-600/25 dark:border-blue-400/25 border-t-blue-600 dark:border-t-blue-400 animate-spin"></span>
</div>
