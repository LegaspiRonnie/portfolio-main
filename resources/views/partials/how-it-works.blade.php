<!-- File: partials/how-it-works.blade.php -->
<section id="how-it-works" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ process ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">How we'd work together</h2>
    </div>

    @php
      $steps = [
        [
          'title' => 'Discover',
          'description' => 'We talk through your goals, requirements, and constraints so the project starts on solid ground.',
        ],
        [
          'title' => 'Plan',
          'description' => 'I scope the work, sketch the architecture, and lay out a realistic timeline before writing a line of code.',
        ],
        [
          'title' => 'Build',
          'description' => 'Iterative development with regular updates, so you always know what is done and what is next.',
        ],
        [
          'title' => 'Launch & Support',
          'description' => 'I deploy the app, monitor it in production, and stay on hand for post-launch fixes and tweaks.',
        ],
      ];
    @endphp

    <div class="relative grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-6">
      <div class="hidden md:block absolute top-6 h-px bg-gray-200 dark:bg-gray-800" style="left:12.5%;right:12.5%;"></div>

      @foreach ($steps as $step)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="relative text-center md:text-left">
          <div class="relative z-10 mx-auto md:mx-0 w-12 h-12 rounded-full bg-blue-700 text-white flex items-center justify-center font-mono font-medium mb-4">
            {{ $loop->iteration }}
          </div>
          <h3 class="font-medium text-gray-900 dark:text-white mb-1.5">{{ $step['title'] }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $step['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
