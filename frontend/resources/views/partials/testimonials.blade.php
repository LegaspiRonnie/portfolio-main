<!-- File: partials/testimonials.blade.php -->
<section id="testimonials" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ testimonials ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">What people say</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @forelse (($testimonials ?? []) as $testimonial)
        @php
          $t = (array) $testimonial;
          $avatarUrl = ($t['avatar'] ?? null) ?: 'https://ui-avatars.com/api/?name='.urlencode($t['name'] ?? 'Anonymous').'&background=1d4ed8&color=ffffff';
        @endphp
        <div data-reveal style="--reveal-delay:{{ $loop->index * 120 }}ms" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
          <div class="flex items-center gap-0.5 mb-4">
            @for ($i = 0; $i < 5; $i++)
              <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.367 2.447a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.367-2.446a1 1 0 00-1.176 0l-3.367 2.446c-.783.57-1.838-.196-1.538-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.113 9.385c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.958z"/>
              </svg>
            @endfor
          </div>
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 flex-1">&ldquo;{{ $t['quote'] ?? '' }}&rdquo;</p>
          <div class="flex items-center gap-3">
            <img src="{{ $avatarUrl }}" alt="{{ $t['name'] ?? 'Anonymous' }}" class="w-10 h-10 rounded-full" loading="lazy">
            <div>
              <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $t['name'] ?? 'Anonymous' }}</p>
              <p class="text-xs text-gray-400 dark:text-gray-500">{{ $t['role'] ?? '' }}</p>
            </div>
          </div>
        </div>
      @empty
        <div data-reveal class="md:col-span-3 bg-white dark:bg-gray-900 border border-dashed border-gray-200 dark:border-gray-800 rounded-lg p-8 text-center">
          <p class="text-sm text-gray-500 dark:text-gray-400">
            Testimonials coming soon — currently gathering feedback from recent collaborators.
          </p>
        </div>
      @endforelse
    </div>
  </div>
</section>
