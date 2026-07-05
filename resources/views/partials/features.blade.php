<!-- File: partials/features.blade.php -->
<section id="features" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ what i do ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">What I bring to the table</h2>
    </div>

    @php
      $features = [
        [
          'title' => 'Full-Stack Development',
          'description' => 'End-to-end web apps with Laravel on the backend and React or Vue.js on the frontend, from database to deployed UI.',
          'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 8l-4 4 4 4',
          'color' => 'blue',
        ],
        [
          'title' => 'Database Design',
          'description' => 'MySQL schema design, normalization, and query optimization so the app stays fast as data and traffic grow.',
          'icon' => 'M4 7v10c0 1.657 3.582 3 8 3s8-1.343 8-3V7M4 7c0 1.657 3.582 3 8 3s8-1.343 8-3M4 7c0-1.657 3.582-3 8-3s8 1.343 8 3',
          'color' => 'emerald',
        ],
        [
          'title' => 'API Integration',
          'description' => 'Designing clean REST APIs and integrating third-party services so your systems talk to each other reliably.',
          'icon' => 'M13.5 10.5L21 3m0 0h-5.25M21 3v5.25M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5',
          'color' => 'violet',
        ],
        [
          'title' => 'Responsive & Accessible UI',
          'description' => 'Mobile-first interfaces built with Tailwind CSS, with full dark mode support and accessibility in mind from the start.',
          'icon' => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
          'color' => 'amber',
        ],
      ];

      $featureColorClasses = fn (string $color) => match ($color) {
        'emerald' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
        'violet' => 'bg-violet-50 dark:bg-violet-900/30 text-violet-700 dark:text-violet-400',
        'amber' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400',
        default => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
      };
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach ($features as $feature)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 100 }}ms" class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4 {{ $featureColorClasses($feature['color']) }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
            </svg>
          </div>
          <h3 class="font-medium text-gray-900 dark:text-white mb-1.5">{{ $feature['title'] }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $feature['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
