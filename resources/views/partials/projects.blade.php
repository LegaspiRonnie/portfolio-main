<!-- File: partials/projects.blade.php -->
<section id="projects" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-14">
      <div class="max-w-xl">
        <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ projects ]</p>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Selected work</h2>
      </div>
      <a href="{{ route('gallery') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 dark:text-blue-400 hover:gap-2.5 transition-all duration-200">
        View full gallery
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
    </div>

    @php
      $projectIcons = [
        'M9 4.5v15m6-15v15M4.5 9h15M4.5 15h15M6 4.5h12A1.5 1.5 0 0119.5 6v12a1.5 1.5 0 01-1.5 1.5H6A1.5 1.5 0 014.5 18V6A1.5 1.5 0 016 4.5z',
        'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        'M4 6a2 2 0 012-2h12a2 2 0 012 2v2H4V6zm0 4h16v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8z',
      ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @foreach ($projects as $project)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="h-40 overflow-hidden relative">
            @if ($project->image_url)
              <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            @else
              <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-gray-900 flex items-center justify-center">
                <svg class="w-10 h-10 text-blue-700 dark:text-blue-400 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="{{ $projectIcons[$loop->index % count($projectIcons)] }}"/>
                </svg>
              </div>
            @endif
            @if ($project->featured)
              <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-blue-700/90 text-white text-xs font-medium">Featured</span>
            @endif
          </div>
          <div class="p-5 flex-1 flex flex-col">
            <h3 class="font-medium text-gray-900 dark:text-white mb-1.5">{{ $project->title }}</h3>
            @if ($project->subtitle)
              <p class="text-xs text-gray-400 dark:text-gray-500 mb-2">{{ $project->subtitle }}</p>
            @endif
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-3">
              {{ $project->description }}
            </p>

            @if ($project->rating)
              <div class="flex items-center gap-2 mb-3">
                <x-ui.rating-stars :value="$project->rating" size="sm" />
                <span class="text-xs text-gray-400 dark:text-gray-500">{{ number_format($project->rating, 1) }}</span>
              </div>
            @endif

            @if ($project->tags)
              <div class="flex flex-wrap gap-1.5 pt-2">
                @foreach ($project->tags as $tag)
                  @php $tagIconUrl = \App\Support\TechIcon::url($tag); @endphp
                  <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                    @if ($tagIconUrl)
                      <img src="{{ $tagIconUrl }}" alt="" class="w-3 h-3" loading="lazy">
                    @endif
                    {{ $tag }}
                  </span>
                @endforeach
              </div>
            @endif

            @if ($project->demo_url || $project->repo_url)
              <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-800 flex items-center gap-4 text-sm">
                @if ($project->demo_url)
                  <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="text-blue-700 dark:text-blue-400 font-medium hover:underline">Live demo</a>
                @endif
                @if ($project->repo_url)
                  <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400">Source</a>
                @endif
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
