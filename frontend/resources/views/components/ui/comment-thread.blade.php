@props([
    'comments' => [],
])

<div {{ $attributes->merge(['class' => 'space-y-4']) }}>
    @foreach ($comments as $comment)
        <div>
            <div class="flex items-start gap-3">
                <x-ui.avatar :name="$comment['author'] ?? 'Anonymous'" :src="$comment['avatar'] ?? null" size="sm" />
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment['author'] ?? 'Anonymous' }}</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $comment['time'] ?? '' }}</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">{{ $comment['body'] ?? '' }}</p>
                </div>
            </div>

            @if (!empty($comment['replies']))
                <div class="ml-10 mt-4 space-y-4 border-l border-gray-200 dark:border-gray-800 pl-4">
                    <x-ui.comment-thread :comments="$comment['replies']" />
                </div>
            @endif
        </div>
    @endforeach
</div>
