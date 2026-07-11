<!-- File: partials/breadcrumb.blade.php -->
<nav aria-label="Breadcrumb" class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3">
    <ol class="flex items-center flex-wrap gap-2 text-sm">
      <li class="flex items-center gap-2">
        <a href="{{ route('home') }}" wire:navigate class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Home</a>
        <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </li>
      <li aria-current="page">
        <span class="text-gray-900 dark:text-white font-medium">{{ $profile->name ?? 'Portfolio' }}</span>
      </li>
    </ol>
  </div>
</nav>
