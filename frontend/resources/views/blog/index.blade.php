<x-layout title="Blog — Ronnie Legaspi">
  <nav aria-label="Breadcrumb" class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3">
      <ol class="flex items-center flex-wrap gap-2 text-sm">
        <li class="flex items-center gap-2">
          <a href="{{ route('home') }}" wire:navigate class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Home</a>
          <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </li>
        <li aria-current="page"><span class="text-gray-900 dark:text-white font-medium">Blog</span></li>
      </ol>
    </div>
  </nav>

  <section class="py-16 bg-white dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
      <div class="max-w-xl mb-12">
        <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ writing ]</p>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">All posts</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Notes on Laravel, React, and things I pick up building real projects.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @forelse ($posts as $post)
          <a href="{{ route('blog.show', $post->slug) }}" wire:navigate class="group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
            <div class="h-40 overflow-hidden">
              @if ($post->cover_image_url)
                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
              @else
                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-gray-900"></div>
              @endif
            </div>
            <div class="p-5 flex-1 flex flex-col">
              @if ($post->tags)
                <div class="flex flex-wrap gap-1.5 mb-2">
                  @foreach (array_slice($post->tags, 0, 2) as $tag)
                    <x-ui.badge :label="$tag" color="blue" />
                  @endforeach
                </div>
              @endif
              <h3 class="font-medium text-gray-900 dark:text-white mb-2 leading-snug">{{ $post->title }}</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4 flex-1">{{ $post->excerpt }}</p>
              <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500">
                <span>{{ $post->published_at?->format('M j, Y') }}</span>
                <span>{{ $post->reading_minutes }} min read</span>
              </div>
            </div>
          </a>
        @empty
          <x-ui.empty-state title="No posts yet" message="Check back soon for new writing." class="md:col-span-3" />
        @endforelse
      </div>

      {{ $posts->links() }}
    </div>
  </section>
</x-layout>
