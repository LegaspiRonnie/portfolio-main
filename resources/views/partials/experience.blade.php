<!-- File: partials/experience.blade.php -->
<section id="experience" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ experience ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Relevant experience &amp; education</h2>
    </div>

    @php
      $workEntries = $experience->where('type', 'work')->values();
      $otherEntries = $experience->whereIn('type', ['education', 'note'])->values();
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

      <!-- Experience -->
      <div class="relative pl-6" data-reveal>
        <div class="absolute left-[7px] top-1 bottom-1 w-px bg-gray-200 dark:bg-gray-800"></div>

        @foreach ($workEntries as $entry)
          <div class="relative {{ !$loop->last ? 'pb-8' : '' }}">
            <div class="absolute -left-6 top-1 w-3.5 h-3.5 rounded-full bg-blue-700 border-2 border-white dark:border-gray-950"></div>
            @if ($entry->period_label)
              <p class="text-xs text-gray-400 dark:text-gray-500 mb-0.5">{{ $entry->period_label }}</p>
            @endif
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-0.5">{{ $entry->title }}</h3>
            @if ($entry->organization)
              <p class="text-sm text-blue-700 dark:text-blue-400 mb-3">{{ $entry->organization }}</p>
            @endif
            @if ($entry->bullets)
              <ul class="space-y-2.5 text-sm text-gray-600 dark:text-gray-400 leading-relaxed list-disc list-outside ml-4">
                @foreach ($entry->bullets as $bullet)
                  <li>{{ $bullet }}</li>
                @endforeach
              </ul>
            @elseif ($entry->description)
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $entry->description }}</p>
            @endif
          </div>
        @endforeach
      </div>

      <!-- Education & notes -->
      <div class="relative pl-6" data-reveal style="--reveal-delay:150ms">
        <div class="absolute left-[7px] top-1 bottom-1 w-px bg-gray-200 dark:bg-gray-800"></div>

        @foreach ($otherEntries as $entry)
          <div class="relative {{ !$loop->last ? 'pb-8' : '' }}">
            <div class="absolute -left-6 top-1 w-3.5 h-3.5 rounded-full {{ $entry->type === 'education' ? 'bg-blue-700 border-2 border-white dark:border-gray-950' : 'border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950' }}"></div>
            @if ($entry->period_label)
              <p class="text-xs text-gray-400 dark:text-gray-500 mb-0.5">{{ $entry->period_label }}</p>
            @endif
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-0.5">{{ $entry->title }}</h3>
            @if ($entry->organization)
              <p class="text-sm text-blue-700 dark:text-blue-400 mb-3">{{ $entry->organization }}</p>
            @endif
            @if ($entry->description)
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed {{ $entry->organization ? '' : 'mt-2' }}">
                {{ $entry->description }}
              </p>
            @endif
          </div>
        @endforeach
      </div>

    </div>
  </div>
</section>
