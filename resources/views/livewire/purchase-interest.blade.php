<div>
    @if ($open)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-data
            @keydown.escape.window="$wire.close()"
        >
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="close"></div>

            <div class="relative w-full max-w-md rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-2xl p-6">
                <button type="button" wire:click="close" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                @if ($submitted)
                    <div class="text-center py-4">
                        <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-white mb-1.5">Request received</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Thanks for your interest in the {{ $plan }} package — I'll follow up by email shortly to confirm scope and pricing.</p>
                        <button type="button" wire:click="close" class="mt-5 px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-colors">Close</button>
                    </div>
                @else
                    <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-1">[ {{ $plan ?: 'engagement' }} ]</p>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Request this package</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-5">Note: this sends a request to discuss scope and pricing — no payment is collected here. I'll reply by email to confirm the final quote.</p>

                    <form wire:submit="submit" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                            <input type="text" wire:model.blur="name" placeholder="Your name"
                                class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors">
                            @error('name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" wire:model.blur="email" placeholder="you@example.com"
                                class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors">
                            @error('email')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project details (optional)</label>
                            <textarea wire:model.blur="message" rows="3" placeholder="Tell me a bit about what you need..."
                                class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors resize-none"></textarea>
                        </div>
                        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                            class="w-full px-4 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 disabled:opacity-60">
                            <span wire:loading.remove wire:target="submit">Send request</span>
                            <span wire:loading wire:target="submit">Sending…</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
