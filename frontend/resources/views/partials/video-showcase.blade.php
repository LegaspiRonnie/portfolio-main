<!-- File: partials/video-showcase.blade.php -->
<section id="video-showcase" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ demo reel ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">See it in action</h2>
    </div>

    @if (!empty($videoUrl))
      <div data-reveal class="aspect-video w-full rounded-lg overflow-hidden border border-gray-200 dark:border-gray-800">
        <iframe
          src="{{ $videoUrl }}"
          title="Project walkthrough video"
          class="w-full h-full"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
    @else
      <div data-reveal x-data="{ hovering: false }" class="relative rounded-lg bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 aspect-video w-full flex flex-col items-center justify-center text-center px-6">
        <button
          type="button"
          @click="hovering = !hovering"
          @mouseenter="hovering = true"
          @mouseleave="hovering = false"
          aria-label="Play project walkthrough (coming soon)"
          class="w-16 h-16 rounded-full bg-blue-700 text-white flex items-center justify-center mb-5 transition-transform duration-300"
          :class="hovering ? 'scale-110' : ''"
        >
          <svg class="w-6 h-6 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z"/>
          </svg>
        </button>
        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-sm mb-5">
          Project walkthrough videos coming soon — in the meantime, check the live project demos below.
        </p>
        <a href="#projects" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all duration-200 hover:bg-white dark:hover:bg-gray-950 hover:scale-[1.03] active:scale-[0.98]">
          View projects
        </a>
      </div>
    @endif
  </div>
</section>
