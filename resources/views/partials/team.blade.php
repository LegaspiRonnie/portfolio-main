<!-- File: partials/team.blade.php -->
<section id="team" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ team ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Currently a team of one</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl">
      <div data-reveal class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
        <img
          src="https://ui-avatars.com/api/?name={{ urlencode('Ronnie Legaspi') }}&size=96&background=1d4ed8&color=ffffff&bold=true"
          alt="Ronnie H. Legaspi"
          class="w-16 h-16 rounded-full border border-gray-200 dark:border-gray-800 shrink-0"
          loading="lazy"
        >
        <div>
          <p class="font-medium text-gray-900 dark:text-white">Ronnie H. Legaspi</p>
          <p class="text-sm text-gray-500 dark:text-gray-400">Founder &amp; Full-Stack Developer</p>
        </div>
      </div>

      <div data-reveal style="--reveal-delay:120ms" class="border border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6 flex items-center gap-4">
        <div class="w-16 h-16 rounded-full border border-dashed border-gray-300 dark:border-gray-700 flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
          </svg>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
          Open to collaboration — partnering with designers, QA, or other developers on larger projects.
        </p>
      </div>
    </div>
  </div>
</section>
