@props([
    'value' => '',
    'size' => 160,
])

<div class="inline-flex flex-col items-center gap-3 p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg transition-colors duration-300">
    <img
        src="https://api.qrserver.com/v1/create-qr-code/?size={{ $size }}x{{ $size }}&data={{ urlencode($value) }}"
        alt="QR code"
        loading="lazy"
        width="{{ $size }}"
        height="{{ $size }}"
        class="rounded-lg border border-gray-200 dark:border-gray-800"
    >
    @if (trim((string) ($slot ?? '')) !== '')
        <p class="text-xs text-gray-400 dark:text-gray-500 text-center">{{ $slot }}</p>
    @endif
</div>
