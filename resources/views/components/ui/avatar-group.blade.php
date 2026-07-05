@props([
    'users' => [],
    'max' => 4,
    'size' => 'md',
])

@php
    $visible = array_slice($users, 0, $max);
    $overflow = max(count($users) - $max, 0);

    $sizeClasses = match ($size) {
        'sm' => 'w-8 h-8 text-xs',
        'lg' => 'w-16 h-16 text-base',
        'xl' => 'w-24 h-24 text-lg',
        default => 'w-12 h-12 text-sm',
    };
@endphp

<div {{ $attributes->merge(['class' => '-space-x-3 flex items-center']) }}>
    @foreach ($visible as $user)
        <x-ui.avatar
            :name="$user['name'] ?? 'User'"
            :src="$user['src'] ?? null"
            :size="$size"
            ring
        />
    @endforeach

    @if ($overflow > 0)
        <div class="{{ $sizeClasses }} rounded-full ring-2 ring-white dark:ring-gray-900 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 font-medium flex items-center justify-center shrink-0 transition-colors duration-300">
            +{{ $overflow }}
        </div>
    @endif
</div>
