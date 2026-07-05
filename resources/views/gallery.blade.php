<x-layout title="Project Gallery — Ronnie Legaspi">
  <nav aria-label="Breadcrumb" class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3">
      <ol class="flex items-center flex-wrap gap-2 text-sm">
        <li class="flex items-center gap-2">
          <a href="{{ route('home') }}" class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Home</a>
          <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </li>
        <li aria-current="page"><span class="text-gray-900 dark:text-white font-medium">Project Gallery</span></li>
      </ol>
    </div>
  </nav>

  <section class="py-16 bg-white dark:bg-gray-950 transition-colors duration-300" x-data="{ view: 'grid', activeTag: 'all' }">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
      <div class="max-w-xl mb-10">
        <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ full gallery ]</p>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Every project, in detail</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Browse, filter, and preview all {{ $projects->count() }} projects — switch between grid and list view.</p>
      </div>

      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div class="flex flex-wrap items-center gap-2">
          <button
            type="button"
            @click="activeTag = 'all'"
            :class="activeTag === 'all' ? 'bg-blue-700 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700'"
            class="px-3 py-1.5 rounded-full text-xs font-medium transition-colors duration-200"
          >All</button>
          @foreach ($tags as $tag)
            <button
              type="button"
              @click="activeTag = '{{ $tag }}'"
              :class="activeTag === '{{ $tag }}' ? 'bg-blue-700 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700'"
              class="px-3 py-1.5 rounded-full text-xs font-medium transition-colors duration-200"
            >{{ $tag }}</button>
          @endforeach
        </div>

        <x-ui.grid-list-toggle x-on:view-changed.window="view = $event.detail" />
      </div>

      <div
        :class="view === 'grid' ? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6' : 'flex flex-col gap-4'"
      >
        @forelse ($projects as $project)
          @php $projectTags = $project->tags ?? []; @endphp
          <div
            x-show="activeTag === 'all' || {{ \Illuminate\Support\Js::from($projectTags) }}.includes(activeTag)"
            :class="view === 'list' ? 'flex flex-col sm:flex-row' : 'flex flex-col'"
            class="group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900"
          >
            <x-ui.modal :id="'project-'.$project->id" :title="$project->title" maxWidth="2xl">
              <x-slot:trigger>
                <div :class="view === 'list' ? 'sm:w-64 shrink-0 h-44 sm:h-full' : 'h-44 w-full'" class="overflow-hidden cursor-zoom-in">
                  <img
                    src="{{ $project->image_url ?? 'https://picsum.photos/seed/project-'.$project->id.'/800/500' }}"
                    alt="{{ $project->title }}"
                    loading="lazy"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                  >
                </div>
              </x-slot:trigger>

              <img
                src="{{ $project->image_url ?? 'https://picsum.photos/seed/project-'.$project->id.'/1200/750' }}"
                alt="{{ $project->title }}"
                class="w-full rounded-lg mb-4"
              >
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $project->description }}</p>
            </x-ui.modal>

            <div class="p-5 flex-1 flex flex-col">
              <div class="flex items-start justify-between gap-3 mb-1.5">
                <h3 class="font-medium text-gray-900 dark:text-white">{{ $project->title }}</h3>
                @if ($project->featured)
                  <x-ui.badge label="Featured" color="blue" />
                @endif
              </div>
              @if ($project->subtitle)
                <p class="text-xs text-gray-400 dark:text-gray-500 mb-2">{{ $project->subtitle }}</p>
              @endif
              <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-3 {{ $project->rating ? '' : 'flex-1' }}">
                {{ Illuminate\Support\Str::limit($project->description, 140) }}
              </p>

              @if ($project->rating)
                <div class="flex items-center gap-2 mb-3">
                  <x-ui.rating-stars :value="$project->rating" size="sm" />
                  <span class="text-xs text-gray-400 dark:text-gray-500">{{ number_format($project->rating, 1) }}</span>
                </div>
              @endif

              @if ($projectTags)
                <div class="flex flex-wrap gap-1.5 mb-4">
                  @foreach ($projectTags as $tag)
                    <x-ui.badge :label="$tag" color="gray" />
                  @endforeach
                </div>
              @endif

              <div class="mt-auto flex items-center gap-3 text-sm">
                @if ($project->demo_url)
                  <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="text-blue-700 dark:text-blue-400 font-medium hover:underline">Live demo</a>
                @endif
                @if ($project->repo_url)
                  <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400">Source</a>
                @endif
                <x-ui.share-buttons :url="url('/gallery#project-'.$project->id)" :title="$project->title" />
              </div>
            </div>
          </div>
        @empty
          <x-ui.empty-state
            title="No projects yet"
            message="Projects will show up here once they're added."
            class="md:col-span-3"
          />
        @endforelse
      </div>
    </div>
  </section>
</x-layout>
