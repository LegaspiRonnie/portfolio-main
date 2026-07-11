<div class="fixed bottom-6 left-6 z-40">
    @if (! $open)
        <button
            type="button"
            wire:click="$set('open', true)"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200"
        >
            <svg class="w-4 h-4 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.106 0-2.164-.18-3.138-.512L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Feedback
        </button>
    @else
        <div class="w-80 sm:w-96 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-medium text-gray-900 dark:text-white text-sm">Share your feedback</h3>
                <button type="button" wire:click="reopen" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            @if ($submitted)
                <div class="px-3 py-3 rounded-lg text-sm bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-900">
                    Thanks for the feedback — it helps me improve this site.
                </div>
            @else
                <form wire:submit="submit" class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1.5">How would you rate this site?</p>
                        <div class="flex items-center gap-1" x-data="{ hover: 0 }">
                            @for ($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    wire:click="setRating({{ $i }})"
                                    @mouseenter="hover = {{ $i }}"
                                    @mouseleave="hover = 0"
                                    class="p-0.5"
                                >
                                    <svg
                                        class="w-6 h-6 transition-colors"
                                        :class="(hover || {{ $rating }}) >= {{ $i }} ? 'text-blue-600 dark:text-blue-400' : 'text-gray-300 dark:text-gray-700'"
                                        fill="currentColor" viewBox="0 0 20 20"
                                    >
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.447a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.368-2.447a1 1 0 00-1.176 0l-3.368 2.447c-.783.57-1.838-.196-1.538-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.062 9.385c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.287-3.958z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rating')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <textarea wire:model.blur="message" rows="3" placeholder="What's on your mind?"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors resize-none"></textarea>
                        @error('message')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" wire:model.blur="name" placeholder="Name (optional)"
                            class="px-3 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors">
                        <input type="email" wire:model.blur="email" placeholder="Email (optional)"
                            class="px-3 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors">
                    </div>

                    <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                        class="w-full px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 disabled:opacity-60">
                        <span wire:loading.remove wire:target="submit">Send feedback</span>
                        <span wire:loading wire:target="submit">Sending…</span>
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>
