<div
    x-data="{ loading: false, width: 0 }"
    x-init="
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({ succeed, fail }) => {
                loading = true;
                width = 20;
                setTimeout(() => { if (loading) width = 65; }, 200);

                succeed(() => { width = 100; setTimeout(() => { loading = false; width = 0; }, 250); });
                fail(() => { width = 100; setTimeout(() => { loading = false; width = 0; }, 250); });
            });
        });
    "
    x-show="loading"
    x-cloak
    class="fixed top-0 left-0 right-0 z-[100] h-0.5 bg-transparent"
>
    <div class="h-full bg-primary-600 transition-all duration-300 ease-out" :style="'width: ' + width + '%'"></div>
</div>
