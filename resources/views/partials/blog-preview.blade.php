<!-- File: partials/blog-preview.blade.php -->
<section id="blog" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ writing ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">From the blog</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      @forelse (($posts ?? []) as $post)
        @php
          $p = (array) $post;
          $slug = data_get($p, 'slug');
          $publishedAt = data_get($p, 'published_at');
          $excerpt = \Illuminate\Support\Str::limit(strip_tags(data_get($p, 'excerpt', '')), 110);
        @endphp
        <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="h-36 overflow-hidden">
            @if (!empty($p['cover_image_url']))
              <img src="{{ $p['cover_image_url'] }}" alt="{{ $p['title'] ?? '' }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
            @else
              <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-gray-900 flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
              </div>
            @endif
          </div>
          <div class="p-5 flex-1 flex flex-col">
            <h3 class="font-medium text-gray-900 dark:text-white mb-2 leading-snug">{{ $p['title'] ?? 'Untitled post' }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4 flex-1">{{ $excerpt }}</p>
            <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 mb-3">
              <span>{{ $publishedAt ? \Illuminate\Support\Carbon::parse($publishedAt)->format('M j, Y') : '' }}</span>
              @if (!empty($p['reading_minutes']))
                <span>{{ $p['reading_minutes'] }} min read</span>
              @endif
            </div>
            <a href="{{ $slug ? route('blog.show', $slug) : '#' }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 dark:text-blue-400 hover:gap-2.5 transition-all duration-200">
              Read more
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </a>
          </div>
        </div>
      @empty
        <div data-reveal class="md:col-span-3 bg-gray-50 dark:bg-gray-900 border border-dashed border-gray-200 dark:border-gray-800 rounded-lg p-8 text-center">
          <p class="text-sm text-gray-500 dark:text-gray-400">No posts published yet — check back soon.</p>
        </div>
      @endforelse
    </div>

    <div class="text-center">
      <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-900 hover:scale-[1.03] active:scale-[0.98]">
        View all posts
      </a>
    </div>
  </div>
</section>
