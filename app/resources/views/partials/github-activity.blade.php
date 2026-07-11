<!-- File: partials/github-activity.blade.php -->
@if ($github)
<section id="github" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-14" data-reveal>
      <div class="max-w-xl">
        <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ github ]</p>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Recent GitHub activity</h2>
      </div>
      <a href="{{ $github['profile_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 dark:text-blue-400 hover:underline">
        {{ '@'.$github['username'] }} on GitHub
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div data-reveal class="md:col-span-1 border border-gray-200 dark:border-gray-800 rounded-lg p-6 bg-white dark:bg-gray-900 flex flex-col items-center text-center">
        <img src="{{ $github['avatar_url'] }}" alt="{{ $github['username'] }}" class="w-16 h-16 rounded-full mb-3" loading="lazy">
        <p class="font-medium text-gray-900 dark:text-white">{{ $github['username'] }}</p>
        <div class="flex gap-4 mt-3 text-sm text-gray-500 dark:text-gray-400">
          <div><span class="block text-lg font-semibold text-gray-900 dark:text-white">{{ $github['public_repos'] }}</span>Repos</div>
          <div><span class="block text-lg font-semibold text-gray-900 dark:text-white">{{ $github['followers'] }}</span>Followers</div>
        </div>
      </div>

      <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-4">
        @forelse ($github['repos'] as $repo)
          <a href="{{ $repo['url'] }}" target="_blank" rel="noopener" data-reveal style="--reveal-delay:{{ $loop->index * 100 }}ms"
             class="block border border-gray-200 dark:border-gray-800 rounded-lg p-5 bg-white dark:bg-gray-900 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-blue-200 dark:hover:border-blue-900">
            <p class="font-medium text-gray-900 dark:text-white mb-1.5 truncate">{{ $repo['name'] }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-2 mb-3 min-h-[2.5rem]">{{ $repo['description'] ?? 'No description provided.' }}</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 dark:text-gray-500">
              @if ($repo['language'])
                <span class="inline-flex items-center gap-1">
                  <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                  {{ $repo['language'] }}
                </span>
              @endif
              <span class="inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.367-2.447a1 1 0 00-1.176 0l-3.367 2.447c-.783.57-1.838-.196-1.538-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.063 9.385c-.784-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.285-3.958z"/></svg>
                {{ $repo['stars'] }}
              </span>
            </div>
          </a>
        @empty
          <p class="sm:col-span-3 text-sm text-gray-400 dark:text-gray-500">No public repositories yet.</p>
        @endforelse
      </div>
    </div>
  </div>
</section>
@endif
