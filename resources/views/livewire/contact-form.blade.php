<div>
    @if ($submitted)
        <div class="mb-4 px-4 py-3 rounded-lg text-sm bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-900">
            Thanks for reaching out — I'll get back to you soon.
        </div>
    @endif

    <form wire:submit="submit" class="space-y-4 {{ $submitted ? 'hidden' : '' }}">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="contact-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                <input type="text" id="contact-name" wire:model.blur="name" placeholder="Your name"
                    class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" />
                @error('name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="contact-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" id="contact-email" wire:model.blur="email" placeholder="you@example.com"
                    class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" />
                @error('email')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label for="contact-message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message</label>
            <textarea id="contact-message" wire:model.blur="message" rows="4" placeholder="Tell me about your opportunity or project..."
                class="w-full px-3.5 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors resize-none"></textarea>
            @error('message')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
        </div>
        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100">
            <span wire:loading.remove wire:target="submit">Send message</span>
            <span wire:loading wire:target="submit">Sending…</span>
        </button>
    </form>
</div>
