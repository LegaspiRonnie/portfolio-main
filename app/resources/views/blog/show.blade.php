<x-layout :title="$post->title.' — Ronnie Legaspi'">
  <nav aria-label="Breadcrumb" class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3">
      <ol class="flex items-center flex-wrap gap-2 text-sm">
        <li class="flex items-center gap-2">
          <a href="{{ route('home') }}" wire:navigate class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Home</a>
          <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </li>
        <li class="flex items-center gap-2">
          <a href="{{ route('blog.index') }}" wire:navigate class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Blog</a>
          <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </li>
        <li aria-current="page"><span class="text-gray-900 dark:text-white font-medium">{{ Illuminate\Support\Str::limit($post->title, 40) }}</span></li>
      </ol>
    </div>
  </nav>

  <article class="py-16 bg-white dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
      @if ($post->tags)
        <div class="flex flex-wrap gap-1.5 mb-4">
          @foreach ($post->tags as $tag)
            <x-ui.badge :label="$tag" color="blue" />
          @endforeach
        </div>
      @endif

      <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white mb-3">{{ $post->title }}</h1>

      <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-8">
        <x-ui.avatar name="Ronnie Legaspi" size="sm" />
        <span>{{ $profile->name ?? 'Ronnie Legaspi' }}</span>
        <span>&middot;</span>
        <span>{{ $post->published_at?->format('M j, Y') }}</span>
        <span>&middot;</span>
        <span>{{ $post->reading_minutes }} min read</span>
      </div>

      @if ($post->cover_image_url)
        <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="w-full rounded-lg mb-10">
      @endif

      <div class="prose-like text-gray-700 dark:text-gray-300 leading-relaxed space-y-5 mb-12">
        @foreach (explode("\n\n", $post->body) as $paragraph)
          <p>{{ $paragraph }}</p>
        @endforeach
      </div>

      <div class="flex flex-wrap items-center justify-between gap-4 py-6 border-y border-gray-200 dark:border-gray-800 mb-14">
        <x-ui.share-buttons :url="url()->current()" :title="$post->title" />
        <div class="flex items-center gap-2">
          <x-ui.copy-button :text="url()->current()" label="Copy link" />
          <x-ui.print-button />
        </div>
      </div>

      @if ($related->isNotEmpty())
        <div>
          <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">More posts</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @foreach ($related as $item)
              <a href="{{ route('blog.show', $item->slug) }}" wire:navigate class="group block bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
                <h3 class="font-medium text-gray-900 dark:text-white mb-1.5 group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">{{ $item->title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ Illuminate\Support\Str::limit($item->excerpt, 90) }}</p>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </article>
</x-layout>
