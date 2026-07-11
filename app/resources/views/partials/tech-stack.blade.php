<!-- File: partials/tech-stack.blade.php -->
<section id="tech-stack" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ tech stack ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Technical expertise</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      @foreach ($skills as $groupName => $groupSkills)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 90 }}ms" class="border border-gray-200 dark:border-gray-800 rounded-lg p-6 bg-white dark:bg-gray-900 transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/60 dark:hover:shadow-none hover:-translate-y-0.5">
          <h3 class="font-medium text-gray-900 dark:text-white mb-3">{{ $groupName }}</h3>
          <div class="flex flex-wrap items-center gap-2">
            @foreach ($groupSkills as $skill)
              @php $iconUrl = \App\Support\TechIcon::url($skill->name); @endphp
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 transition-transform duration-150 hover:scale-110 cursor-default">
                @if ($iconUrl)
                  <img src="{{ $iconUrl }}" alt="" class="w-3.5 h-3.5" loading="lazy">
                @endif
                {{ $skill->name }}
              </span>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
