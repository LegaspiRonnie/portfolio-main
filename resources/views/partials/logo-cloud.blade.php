<!-- File: partials/logo-cloud.blade.php -->
<section id="stack-logos" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ toolkit ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Technologies I work with</h2>
    </div>

    @php
      $logoStack = ['Laravel', 'React.js', 'Vue.js', 'JavaScript', 'TypeScript', 'MySQL', 'Unity', 'C#', 'Git', 'GitHub', 'Tailwind CSS'];
    @endphp

    <div class="flex flex-wrap items-center gap-x-10 gap-y-8">
      @foreach ($logoStack as $tech)
        @php $logoUrl = \App\Support\TechIcon::url($tech); @endphp
        <div data-reveal style="--reveal-delay:{{ $loop->index * 60 }}ms" class="flex items-center gap-2.5 opacity-70 hover:opacity-100 grayscale hover:grayscale-0 transition-all duration-300">
          @if ($logoUrl)
            <img src="{{ $logoUrl }}" alt="{{ $tech }}" class="w-6 h-6" loading="lazy">
          @else
            <span class="w-6 h-6 rounded bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-700 dark:text-blue-400 text-xs font-mono">{{ mb_substr($tech, 0, 1) }}</span>
          @endif
          <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $tech }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
