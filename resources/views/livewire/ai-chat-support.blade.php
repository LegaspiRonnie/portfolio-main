<div class="fixed bottom-6 right-6 z-40">
    @if (! $open)
        <button
            type="button"
            wire:click="$set('open', true)"
            aria-label="Open chat support"
            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-700 hover:bg-blue-800 text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200"
        >
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.106 0-2.164-.18-3.138-.512L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </button>
    @else
        <div class="w-80 sm:w-96 h-[28rem] rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-2xl flex flex-col overflow-hidden">
            <div class="flex items-center justify-between gap-3 px-4 py-3 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/60">
                <div class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-full bg-blue-700 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.106 0-2.164-.18-3.138-.512L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white leading-tight">Quick chat</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 leading-tight">Ask about services, pricing &amp; more</p>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    @if (count($messages) > 0)
                        <button type="button" wire:click="restart" aria-label="Restart chat" class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                            </svg>
                        </button>
                    @endif
                    <button type="button" wire:click="$set('open', false)" aria-label="Close chat" class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto px-4 py-4 space-y-3" x-data x-init="$watch('$wire.messages', () => $nextTick(() => $el.scrollTop = $el.scrollHeight))">
                <div class="flex">
                    <div class="max-w-[85%] rounded-lg rounded-bl-none bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm px-3.5 py-2.5 leading-relaxed">
                        Hi! I'm a simple chat assistant &mdash; pick a question below or type your own, and I'll do my best to help.
                    </div>
                </div>

                @foreach ($messages as $message)
                    <div class="flex {{ $message['from'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] rounded-lg text-sm px-3.5 py-2.5 leading-relaxed
                            {{ $message['from'] === 'user'
                                ? 'bg-blue-700 text-white rounded-br-none'
                                : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-bl-none' }}"
                        >
                            {{ $message['text'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-gray-200 dark:border-gray-800 px-4 py-3 space-y-2.5">
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($suggestions as $key => $topic)
                        <button
                            type="button"
                            wire:click="ask('{{ $key }}')"
                            class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors"
                        >
                            {{ $topic['question'] }}
                        </button>
                    @endforeach
                </div>

                <form wire:submit="send" class="flex items-center gap-2">
                    <input
                        type="text"
                        wire:model="draft"
                        placeholder="Type a question..."
                        class="flex-1 px-3 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors"
                    >
                    <button
                        type="submit"
                        aria-label="Send"
                        class="shrink-0 inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-colors"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.769 59.769 0 0121.485 12 59.768 59.768 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
