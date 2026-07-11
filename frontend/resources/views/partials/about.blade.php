<!-- File: partials/about.blade.php -->
<section id="about" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <div data-reveal>
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ about me ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white mb-4">
        BSIT graduate, full-stack developer
      </h2>
      <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
        {{ $profile->about_paragraph_1 }}
      </p>
      <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
        {{ $profile->about_paragraph_2 }}
      </p>
    </div>

    @php
      $educationEntry = $experience->firstWhere('type', 'education');
      $workEntry = $experience->firstWhere('type', 'work');
    @endphp

    <div data-reveal style="--reveal-delay:150ms" class="border border-gray-200 dark:border-gray-800 rounded-lg p-6 bg-white dark:bg-gray-900 transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/60 dark:hover:shadow-none hover:-translate-y-0.5">
      <div class="flex items-center gap-3 mb-4">
        <img
          src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($profile->email))) }}?s=96&d=identicon"
          alt="{{ $profile->name }}"
          class="w-12 h-12 rounded-full border border-gray-200 dark:border-gray-800"
          loading="lazy"
        >
        <div>
          <p class="font-medium text-gray-900 dark:text-white">{{ $profile->name }}</p>
          <p class="text-xs text-gray-400 dark:text-gray-500">Full Stack Developer</p>
        </div>
      </div>

      <dl class="space-y-4 text-sm">
        @if ($educationEntry)
          <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
            <dt class="text-gray-500 dark:text-gray-400">Education</dt>
            <dd class="text-gray-900 dark:text-white font-medium text-right">{{ $educationEntry->title }}, {{ $educationEntry->organization }}</dd>
          </div>
        @endif
        @if ($workEntry)
          <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
            <dt class="text-gray-500 dark:text-gray-400">Experience</dt>
            <dd class="text-gray-900 dark:text-white font-medium text-right">{{ $workEntry->title }}, {{ $workEntry->organization }}</dd>
          </div>
        @endif
        <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
          <dt class="text-gray-500 dark:text-gray-400">Location</dt>
          <dd class="text-gray-900 dark:text-white font-medium text-right">{{ $profile->location }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Email</dt>
          <dd class="text-gray-900 dark:text-white font-medium text-right">{{ $profile->email }}</dd>
        </div>
      </dl>
    </div>

  </div>
</section>
