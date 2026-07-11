@props(['color' => 'blue'])

<div
    x-data="{ loading: false, width: 0 }"
    x-init="
        window.addEventListener('page-loader:start', () => {
            loading = true;
            width = 20;
            setTimeout(() => { if (loading) width = 65; }, 200);
        });
        window.addEventListener('page-loader:stop', () => {
            width = 100;
            setTimeout(() => { loading = false; width = 0; }, 250);
        });
    "
    x-show="loading"
    x-cloak
    class="fixed top-0 left-0 right-0 z-[60] h-0.5 bg-transparent"
>
    <div
        class="h-full bg-blue-600 dark:bg-blue-400 transition-all duration-300 ease-out"
        :style="'width: ' + width + '%'"
    ></div>
</div>
