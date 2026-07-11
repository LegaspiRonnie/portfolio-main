<!-- File: partials/pricing-table.blade.php -->
<section id="pricing" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ engagement options ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Ways we can work together</h2>
    </div>

    @php
      $tiers = [
        [
          'name' => 'Starter',
          'price' => 'From ₱15,000',
          'description' => 'A focused landing page or a single well-defined feature.',
          'features' => [
            'One landing page or feature build',
            'Responsive, mobile-first layout',
            'Basic SEO and performance pass',
            '1 round of revisions',
            '2 weeks of post-launch fixes',
          ],
          'highlighted' => false,
        ],
        [
          'name' => 'Professional',
          'price' => 'From ₱45,000',
          'description' => 'A full web app build from database to deployed UI.',
          'features' => [
            'Full-stack app (Laravel + React/Vue)',
            'Database design and API integration',
            'Authentication and admin tooling',
            'Deployment and environment setup',
            '30 days of post-launch support',
          ],
          'highlighted' => true,
        ],
        [
          'name' => 'Custom / Retainer',
          'price' => "Let's talk",
          'description' => 'Ongoing collaboration for ongoing product needs.',
          'features' => [
            'Monthly hours reserved on your project',
            'Priority response time',
            'Feature roadmap collaboration',
            'Flexible scope month to month',
            'Direct line to the developer',
          ],
          'highlighted' => false,
        ],
      ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
      @foreach ($tiers as $tier)
        <div
          data-reveal
          style="--reveal-delay:{{ $loop->index * 120 }}ms"
          class="relative bg-white dark:bg-gray-900 rounded-lg p-6 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none
          {{ $tier['highlighted'] ? 'border-2 border-blue-600 ring-1 ring-blue-600/20 md:-translate-y-2' : 'border border-gray-200 dark:border-gray-800 hover:border-blue-200 dark:hover:border-blue-900' }}"
        >
          @if ($tier['highlighted'])
            <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-blue-700 text-white text-xs font-medium">Most popular</span>
          @endif

          <h3 class="font-medium text-gray-900 dark:text-white mb-1">{{ $tier['name'] }}</h3>
          <p class="text-2xl font-semibold text-blue-700 dark:text-blue-400 mb-2">{{ $tier['price'] }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-5">{{ $tier['description'] }}</p>

          <ul class="space-y-2.5 mb-6 flex-1">
            @foreach ($tier['features'] as $item)
              <li class="flex items-start gap-2.5 text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                {{ $item }}
              </li>
            @endforeach
          </ul>

          <button
            type="button"
            onclick="Livewire.dispatch('open-purchase-modal', { plan: '{{ $tier['name'] }}' })"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-[1.03] active:scale-[0.98]
            {{ $tier['highlighted'] ? 'bg-blue-700 hover:bg-blue-800 text-white' : 'border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900' }}"
          >
            Request this package
          </button>
        </div>
      @endforeach
    </div>

    <p class="text-xs text-gray-400 dark:text-gray-500 mt-8 text-center">
      Prices are estimates and vary by project scope — final quotes are confirmed after a discovery call.
    </p>
  </div>
</section>
