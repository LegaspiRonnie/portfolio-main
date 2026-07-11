<!-- File: partials/faq.blade.php -->
<section id="faq" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ faq ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Frequently asked questions</h2>
    </div>

    @php
      $faqs = [
        [
          'question' => 'Are you available for full-time roles or only freelance/contract?',
          'answer' => "I'm open to both. As a recent BSIT graduate, I'm actively looking for full-time full-stack roles, while also taking on freelance and contract projects in the meantime.",
        ],
        [
          'question' => "What's your typical response time?",
          'answer' => 'I usually reply to emails and messages within 24 hours on weekdays. For active engagements, I share regular progress updates rather than going quiet between milestones.',
        ],
        [
          'question' => 'Do you work with existing codebases or only greenfield projects?',
          'answer' => "Both. I'm comfortable jumping into an existing Laravel, React, or Vue.js codebase to fix bugs, add features, or clean up technical debt, not just building from scratch.",
        ],
        [
          'question' => 'What technologies do you specialize in?',
          'answer' => 'Mainly Laravel and PHP on the backend, React.js and Vue.js on the frontend, MySQL for data, and Tailwind CSS for styling. I also have hands-on experience with Unity and C# from my capstone project.',
        ],
        [
          'question' => 'Do you offer post-launch support?',
          'answer' => 'Yes. Every build includes a support window after launch to handle bug fixes, and I offer ongoing retainer arrangements for projects that need continued attention.',
        ],
        [
          'question' => 'How do we get started?',
          'answer' => "Reach out through the contact section with a short description of your project. We'll set up a quick call to talk through goals, scope, and timeline before anything is agreed on.",
        ],
      ];
    @endphp

    <div x-data="{ openIndex: null }" class="max-w-3xl border border-gray-200 dark:border-gray-800 rounded-lg divide-y divide-gray-200 dark:divide-gray-800 bg-white dark:bg-gray-900">
      @foreach ($faqs as $faq)
        <div data-reveal style="--reveal-delay:{{ $loop->index * 60 }}ms">
          <button
            type="button"
            @click="openIndex = openIndex === {{ $loop->index }} ? null : {{ $loop->index }}"
            class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors"
            :aria-expanded="openIndex === {{ $loop->index }}"
          >
            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $faq['question'] }}</span>
            <svg
              class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0 transition-transform duration-200"
              :class="openIndex === {{ $loop->index }} ? 'rotate-180' : ''"
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>
          <div
            x-show="openIndex === {{ $loop->index }}"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="px-5 pb-4"
          >
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $faq['answer'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
