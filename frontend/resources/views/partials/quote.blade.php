<!-- File: partials/quote.blade.php -->
<section class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div
    class="max-w-3xl mx-auto px-6 lg:px-8 text-center"
    x-data="{
      quotes: {{ \Illuminate\Support\Js::from($quotes) }},
      index: {{ array_rand($quotes) }},
      visible: true,
      next() {
        this.visible = false;
        setTimeout(() => {
          let newIndex = this.index;
          if (this.quotes.length > 1) {
            while (newIndex === this.index) {
              newIndex = Math.floor(Math.random() * this.quotes.length);
            }
          }
          this.index = newIndex;
          this.visible = true;
        }, 300);
      }
    }"
    x-init="setInterval(() => next(), 10000)"
  >
    <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-8" data-reveal>[ words to code by ]</p>

    <div class="relative min-h-[9rem] flex flex-col items-center justify-center">
      <svg class="w-10 h-10 text-blue-100 dark:text-blue-900/60 mb-2 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
      </svg>

      <div class="transition-opacity duration-300" :class="visible ? 'opacity-100' : 'opacity-0'">
        <p class="text-xl md:text-2xl font-medium text-gray-900 dark:text-white leading-relaxed" x-text="quotes[index].text"></p>
        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 font-mono" x-text="'— ' + quotes[index].author"></p>
      </div>
    </div>

    <button
      type="button"
      @click="next()"
      class="mt-8 inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium hover:bg-white dark:hover:bg-gray-900 transition-all duration-200 hover:scale-[1.03] active:scale-[0.98]"
    >
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      Another one
    </button>
  </div>
</section>
