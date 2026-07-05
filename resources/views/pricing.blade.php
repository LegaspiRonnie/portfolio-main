<x-layout title="Pricing & Engagement — Ronnie Legaspi">
  <nav aria-label="Breadcrumb" class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3">
      <ol class="flex items-center flex-wrap gap-2 text-sm">
        <li class="flex items-center gap-2">
          <a href="{{ route('home') }}" class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Home</a>
          <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </li>
        <li aria-current="page"><span class="text-gray-900 dark:text-white font-medium">Pricing</span></li>
      </ol>
    </div>
  </nav>

  <section class="py-16 bg-white dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
      <div class="max-w-xl mb-4">
        <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ availability ]</p>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Currently accepting new projects</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">I take on a limited number of engagements at a time to keep every project well-supported. Here's the countdown to the next availability review.</p>
      </div>
      <x-ui.countdown :to="now()->endOfMonth()->toIso8601String()" label="Next availability review in" />
    </div>
  </section>

  @include('partials.pricing-table')
  @include('partials.comparison-table')
  @include('partials.faq')
</x-layout>
