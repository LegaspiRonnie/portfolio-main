<!-- File: partials/services.blade.php -->
<section id="services" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ services ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">What I can build for you</h2>
      <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">From a single landing page to a full custom system — here's what I take on.</p>
    </div>

    @php
      $services = [
        [
          'title' => 'Websites',
          'description' => 'Marketing sites, landing pages, and business websites — responsive, fast, and built to convert visitors.',
          'icon' => 'M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c-1.657 0-3-4.03-3-9s1.343-9 3-9 3 4.03 3 9-1.343 9-3 9zM3.6 9h16.8M3.6 15h16.8',
          'color' => 'blue',
        ],
        [
          'title' => 'Portfolio sites',
          'description' => 'Personal or professional portfolios that showcase your work clearly, like the one you\'re looking at right now.',
          'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
          'color' => 'violet',
        ],
        [
          'title' => 'POS systems',
          'description' => 'Point-of-sale systems for small businesses — order entry, inventory tracking, receipts, and sales reporting.',
          'icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a1.5 1.5 0 001.5-1.5V6.75a1.5 1.5 0 00-1.5-1.5h-15a1.5 1.5 0 00-1.5 1.5v10.5a1.5 1.5 0 001.5 1.5z',
          'color' => 'emerald',
        ],
        [
          'title' => 'Custom systems',
          'description' => 'Purpose-built web applications — internal tools, dashboards, and workflows tailored to how your business runs.',
          'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a7.688 7.688 0 010-.255c.007-.378-.138-.75-.43-.991l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.213-1.28z',
          'color' => 'amber',
        ],
      ];

      $serviceColorClasses = fn (string $color) => match ($color) {
        'violet' => 'bg-violet-50 dark:bg-violet-900/30 text-violet-700 dark:text-violet-400',
        'emerald' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
        'amber' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400',
        default => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
      };
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach ($services as $service)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 100 }}ms" class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="w-11 h-11 rounded-lg flex items-center justify-center mb-4 {{ $serviceColorClasses($service['color']) }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/>
            </svg>
          </div>
          <h3 class="font-medium text-gray-900 dark:text-white mb-1.5">{{ $service['title'] }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service['description'] }}</p>
        </div>
      @endforeach
    </div>

    <div class="mt-8 text-center">
      <a href="{{ route('pricing') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 hover:scale-[1.03] active:scale-[0.98]">
        See pricing &amp; packages
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
    </div>
  </div>
</section>
