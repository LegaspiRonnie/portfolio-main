@props([
    'month' => null,
    'year' => null,
    'events' => [],
])

@php
    $month = $month ?? now()->month;
    $year = $year ?? now()->year;

    $firstOfMonth = \Illuminate\Support\Carbon::create($year, $month, 1);
    $daysInMonth = $firstOfMonth->daysInMonth;
    $startOffset = $firstOfMonth->dayOfWeek; // 0 (Sun) - 6 (Sat)

    $eventDates = collect($events)->groupBy('date');
    $today = now()->format('Y-m-d');

    $weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-colors duration-300']) }}>
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $firstOfMonth->format('F Y') }}</h3>
    </div>

    <div class="grid grid-cols-7 gap-1 mb-2">
        @foreach ($weekDays as $day)
            <div class="text-center text-xs font-medium text-gray-400 dark:text-gray-500 py-1">{{ $day }}</div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-1">
        @for ($i = 0; $i < $startOffset; $i++)
            <div></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $isToday = $dateStr === $today;
                $hasEvent = $eventDates->has($dateStr);
            @endphp
            <div class="relative aspect-square flex flex-col items-center justify-center rounded-md text-sm transition-colors duration-300
                {{ $isToday ? 'ring-2 ring-blue-700 dark:ring-blue-400 text-blue-700 dark:text-blue-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}
                {{ !$isToday ? 'hover:bg-gray-50 dark:hover:bg-gray-800' : '' }}"
                @if ($hasEvent) title="{{ $eventDates[$dateStr]->pluck('label')->join(', ') }}" @endif
            >
                <span>{{ $day }}</span>
                @if ($hasEvent)
                    <span class="absolute bottom-1 w-1.5 h-1.5 rounded-full bg-blue-700 dark:bg-blue-400"></span>
                @endif
            </div>
        @endfor
    </div>
</div>
