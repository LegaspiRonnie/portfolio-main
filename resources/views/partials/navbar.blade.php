<!-- File: partials/navbar.blade.php -->
<header
  id="site-header"
  x-data="{
      dark: localStorage.getItem('theme') === 'dark',
      menuOpen: false,
  }"
  x-init="$watch('dark', value => {
      document.documentElement.classList.toggle('dark', value);
      localStorage.setItem('theme', value ? 'dark' : 'light');
  }); document.documentElement.classList.toggle('dark', dark);"
  class="fixed top-0 left-0 w-full z-50 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md transition-colors duration-300"
>
  <nav class="max-w-6xl mx-auto px-6 lg:px-8" aria-label="Main navigation">
    <div class="flex items-center justify-between h-16">

      <a href="#home" class="flex items-center gap-1.5 font-semibold text-lg tracking-tight text-gray-900 dark:text-white">
        <span class="text-blue-600 dark:text-blue-400 font-mono">&lt;/&gt;</span>
        <span>Ronnie<span class="text-blue-700 dark:text-blue-500">.dev</span></span>
      </a>

      <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600 dark:text-gray-300">
        <li><a href="#about" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">About</a></li>
        <li><a href="#experience" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Experience</a></li>
        <li><a href="#tech-stack" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Tech Stack</a></li>
        <li><a href="#projects" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Projects</a></li>
        <li><a href="#contact" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Contact</a></li>
      </ul>

      <div class="hidden md:flex items-center gap-3">
        <button
          type="button"
          @click="dark = !dark"
          aria-label="Toggle dark mode"
          class="p-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 transition-colors"
        >
          <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364-6.364l-1.06 1.06M6.696 17.304l-1.06 1.06m12.728 0l-1.06-1.06M6.696 6.696L5.636 5.636M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/>
          </svg>
          <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
          </svg>
        </button>

        <a
          href="#contact"
          class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-colors"
        >
          Hire me
          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>

      <div class="flex items-center gap-2 md:hidden">
        <button
          type="button"
          @click="dark = !dark"
          aria-label="Toggle dark mode"
          class="p-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300"
        >
          <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364-6.364l-1.06 1.06M6.696 17.304l-1.06 1.06m12.728 0l-1.06-1.06M6.696 6.696L5.636 5.636M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/>
          </svg>
          <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
          </svg>
        </button>

        <button
          type="button"
          @click="menuOpen = !menuOpen"
          aria-label="Toggle navigation menu"
          :aria-expanded="menuOpen"
          class="p-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200"
        >
          <svg x-show="!menuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg x-show="menuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>

    <div x-show="menuOpen" x-cloak x-transition class="md:hidden pb-6">
      <ul class="flex flex-col gap-1 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
        <li><a href="#about" @click="menuOpen = false" class="block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">About</a></li>
        <li><a href="#experience" @click="menuOpen = false" class="block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Experience</a></li>
        <li><a href="#tech-stack" @click="menuOpen = false" class="block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Tech Stack</a></li>
        <li><a href="#projects" @click="menuOpen = false" class="block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Projects</a></li>
        <li><a href="#contact" @click="menuOpen = false" class="block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Contact</a></li>
        <li class="pt-2">
          <a href="#contact" @click="menuOpen = false" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-colors">
            Hire me
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
