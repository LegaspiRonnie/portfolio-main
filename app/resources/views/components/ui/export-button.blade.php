@props([
    'rows' => [],
    'filename' => 'export.csv',
    'label' => 'Export CSV',
])

@php
$csv = '';
if (!empty($rows)) {
    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, array_keys($rows[0]));
    foreach ($rows as $row) {
        fputcsv($handle, $row);
    }
    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);
}
$href = 'data:text/csv;charset=utf-8,' . rawurlencode($csv);
$isEmpty = empty($rows);
@endphp

<a
    href="{{ $href }}"
    download="{{ $filename }}"
    @if ($isEmpty) aria-disabled="true" tabindex="-1" @endif
    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-colors duration-300 {{ $isEmpty ? 'opacity-50 pointer-events-none' : '' }}"
>
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 12m0 0l4.5-4.5M12 12V3"/>
    </svg>
    {{ $label }}
</a>
