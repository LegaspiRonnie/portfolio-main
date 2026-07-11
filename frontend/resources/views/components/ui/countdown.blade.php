@props([
    'to' => null,
    'label' => null,
])

<div
    x-data="{
        target: new Date(@js($to)).getTime(),
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0,
        tick() {
            const diff = this.target - Date.now();
            if (isNaN(this.target) || diff <= 0) {
                this.days = this.hours = this.minutes = this.seconds = 0;
                return;
            }
            const totalSeconds = Math.floor(diff / 1000);
            this.days = Math.floor(totalSeconds / 86400);
            this.hours = Math.floor((totalSeconds % 86400) / 3600);
            this.minutes = Math.floor((totalSeconds % 3600) / 60);
            this.seconds = totalSeconds % 60;
        },
    }"
    x-init="tick(); setInterval(() => tick(), 1000)"
>
    @if ($label)
        <p class="font-mono text-sm text-blue-700 dark:text-blue-400 mb-3">{{ $label }}</p>
    @endif
    <div class="grid grid-cols-4 gap-3">
        <div class="flex flex-col items-center justify-center border border-gray-200 dark:border-gray-800 rounded-lg py-3 bg-white dark:bg-gray-900 transition-colors duration-300">
            <span class="font-mono text-2xl tabular-nums font-semibold text-gray-900 dark:text-white" x-text="String(days).padStart(2, '0')"></span>
            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Days</span>
        </div>
        <div class="flex flex-col items-center justify-center border border-gray-200 dark:border-gray-800 rounded-lg py-3 bg-white dark:bg-gray-900 transition-colors duration-300">
            <span class="font-mono text-2xl tabular-nums font-semibold text-gray-900 dark:text-white" x-text="String(hours).padStart(2, '0')"></span>
            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Hours</span>
        </div>
        <div class="flex flex-col items-center justify-center border border-gray-200 dark:border-gray-800 rounded-lg py-3 bg-white dark:bg-gray-900 transition-colors duration-300">
            <span class="font-mono text-2xl tabular-nums font-semibold text-gray-900 dark:text-white" x-text="String(minutes).padStart(2, '0')"></span>
            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Min</span>
        </div>
        <div class="flex flex-col items-center justify-center border border-gray-200 dark:border-gray-800 rounded-lg py-3 bg-white dark:bg-gray-900 transition-colors duration-300">
            <span class="font-mono text-2xl tabular-nums font-semibold text-gray-900 dark:text-white" x-text="String(seconds).padStart(2, '0')"></span>
            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Sec</span>
        </div>
    </div>
</div>
