<!-- File: partials/newsletter.blade.php -->
<section id="newsletter" class="py-20 bg-blue-700 dark:bg-blue-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div data-reveal class="max-w-2xl mx-auto text-center">
      <h2 class="text-2xl md:text-3xl font-semibold text-white mb-3">Get occasional updates</h2>
      <p class="text-blue-100 dark:text-blue-200/80 leading-relaxed mb-8">
        New projects, blog posts, and things I'm learning — no spam.
      </p>

      {{-- Static newsletter form — backend implementing soon --}}
      <form onsubmit="return underConstruction(event)" class="flex flex-col sm:flex-row items-stretch sm:items-start gap-3 max-w-md mx-auto">
        <div class="flex-1 text-left">
          <label for="newsletter-email" class="sr-only">Email address</label>
          <input
            id="newsletter-email"
            type="email"
            name="email"
            required
            placeholder="you@example.com"
            class="w-full px-4 py-2.5 rounded-lg border border-white/20 bg-white text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-white/60"
          >
          @error('email')
            <p class="mt-1.5 text-xs text-blue-50 bg-red-500/90 rounded px-2 py-1 inline-block">{{ $message }}</p>
          @enderror
        </div>
        <button
          type="submit"
          class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-gray-900 hover:bg-black text-white text-sm font-medium transition-all duration-200 hover:scale-[1.03] active:scale-[0.98] shrink-0"
        >
          Subscribe
        </button>
      </form>
    </div>
  </div>
</section>
