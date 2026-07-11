<!-- File: partials/samples.blade.php -->
<section id="samples" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ case studies ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Sample work &amp; screenshots</h2>
      <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">A closer look at real, deployed work — click any screenshot to view it full-size.</p>
    </div>

    @forelse (($samples ?? []) as $sample)
      <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 {{ $loop->last ? '' : 'mb-6' }}">
        <div class="flex flex-wrap items-start justify-between gap-3 mb-5">
          <div>
            <h3 class="font-medium text-gray-900 dark:text-white mb-1">{{ $sample['title'] }}</h3>
            @if (!empty($sample['description']))
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed max-w-xl">{{ $sample['description'] }}</p>
            @endif
          </div>
          @if (!empty($sample['url']))
            <a href="{{ $sample['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 shrink-0 text-sm font-medium text-blue-700 dark:text-blue-400 hover:gap-2.5 transition-all duration-200">
              Visit live site
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
              </svg>
            </a>
          @endif
        </div>

        @if (!empty($sample['images']))
          <x-ui.lightbox :images="collect($sample['images'])->map(fn ($src, $i) => ['src' => $src, 'alt' => $sample['title'].' — screenshot '.($i + 1)])->all()" />
        @else
          <x-ui.empty-state title="Screenshots coming soon" message="I'm still uploading previews for this project." />
        @endif
      </div>
    @empty
      <x-ui.empty-state title="No samples yet" message="Screenshots of past work will show up here soon." />
    @endforelse
  </div>
</section>
