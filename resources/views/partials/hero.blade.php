<!-- File: partials/hero.blade.php -->
<section id="home" class="relative overflow-hidden bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 py-24 lg:py-32">
    <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-16">
      <div class="max-w-2xl">
        <p class="font-mono text-sm text-blue-700 dark:text-blue-400 mb-4 animate-fade-in" style="animation-delay:0ms">&lt;/&gt; hello, world</p>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-gray-900 dark:text-white leading-tight mb-6 animate-fade-in" style="animation-delay:100ms">
          {{ $profile->hero_heading }}
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed mb-8 max-w-xl animate-fade-in" style="animation-delay:220ms">
          {{ $profile->hero_subheading }}
        </p>
        <div class="flex flex-wrap items-center gap-3 animate-fade-in" style="animation-delay:340ms">
          <a href="#projects" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 hover:scale-[1.03] active:scale-[0.98] hover:shadow-lg hover:shadow-blue-700/20">
            View my work
            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
          </a>
          <a href="#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-900 hover:scale-[1.03] active:scale-[0.98]">
            Get in touch
          </a>
        </div>
      </div>

      <div class="relative shrink-0 animate-fade-in" style="animation-delay:450ms">
        <div class="absolute inset-0 rounded-full bg-blue-500/20 dark:bg-blue-400/20 blur-2xl animate-pulse"></div>
        <div class="absolute -inset-3 rounded-full border-2 border-blue-100 dark:border-blue-900/60 animate-pulse"></div>

        <img
          src="https://ui-avatars.com/api/?name={{ urlencode($profile->name ?? 'Ronnie Legaspi') }}&size=320&background=1d4ed8&color=ffffff&bold=true"
          alt="{{ $profile->name ?? 'Ronnie Legaspi' }}"
          class="relative w-48 h-48 lg:w-72 lg:h-72 rounded-full object-cover border-4 border-white dark:border-gray-900 shadow-xl animate-float-slow"
        >
      </div>
    </div>
  </div>

  <!-- Subtle code-inspired background accent -->
  <div class="absolute inset-0 -z-10 opacity-[0.03] dark:opacity-[0.05] font-mono text-xs leading-relaxed text-blue-900 dark:text-blue-300 select-none pointer-events-none overflow-hidden hidden lg:block">
    <pre class="absolute right-10 top-10 animate-float-slow">const developer = {
  name: "Ronnie Legaspi",
  stack: ["Laravel", "React.js", "MySQL", "C#"],
  focus: "full-stack development",
  learning: true,
};</pre>
  </div>
</section>
