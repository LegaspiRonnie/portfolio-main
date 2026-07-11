<!-- File: partials/partners.blade.php -->
<section id="partners" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ affiliations ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Where I've worked and studied</h2>
    </div>

    @php
      $affiliations = [
        [
          'name' => 'AeonSprint Solutions Inc.',
          'role' => 'Full Stack Developer Intern, 2026',
          'icon' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21',
        ],
        [
          'name' => 'University of Eastern Pangasinan',
          'role' => 'BSIT, 2022 - 2026',
          'icon' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443',
        ],
      ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      @foreach ($affiliations as $affiliation)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="flex items-center gap-4 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="shrink-0 w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="{{ $affiliation['icon'] }}"/>
            </svg>
          </div>
          <div>
            <p class="font-medium text-gray-900 dark:text-white">{{ $affiliation['name'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $affiliation['role'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
