<!-- File: partials/footer.blade.php -->
<footer class="border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

      <div class="md:col-span-2">
        <a href="{{ route('home') }}" class="flex items-center gap-1.5 font-semibold text-lg tracking-tight text-gray-900 dark:text-white">
          <span class="text-blue-600 dark:text-blue-400 font-mono">&lt;/&gt;</span>
          <span>Ronnie<span class="text-blue-700 dark:text-blue-500">.dev</span></span>
        </a>
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 max-w-sm leading-relaxed">
          BSIT graduate building web and software applications with Laravel, React.js, PHP, and MySQL —
          eager to grow a career in software development.
        </p>
      </div>

      <div>
        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-4">Navigate</h3>
        <ul class="space-y-2.5 text-sm text-gray-600 dark:text-gray-400">
          <li><a href="{{ route('home') }}#about" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">About</a></li>
          <li><a href="{{ route('home') }}#projects" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Projects</a></li>
          <li><a href="{{ route('gallery') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Gallery</a></li>
          <li><a href="{{ route('pricing') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Pricing</a></li>
          <li><a href="{{ route('blog.index') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Blog</a></li>
          <li><a href="{{ route('home') }}#contact" class="hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Contact</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-4">Connect</h3>
        <ul class="space-y-2.5 text-sm text-gray-600 dark:text-gray-400">
          <li>
            <a href="mailto:{{ $profile->email ?? 'ronnielegaspi98@gmail.com' }}" class="inline-flex items-center gap-2 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              Email
            </a>
          </li>
          @if ($profile->phone ?? null)
            <li>
              <a href="tel:{{ $profile->phone }}" class="inline-flex items-center gap-2 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $profile->phone }}
              </a>
            </li>
          @endif
          @if ($profile->website_url ?? null)
            <li>
              <a href="{{ $profile->website_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM3.6 9h16.8M3.6 15h16.8M12 3a15 15 0 010 18 15 15 0 010-18z"/></svg>
                {{ preg_replace('#^https?://#', '', $profile->website_url) }}
              </a>
            </li>
          @endif
        </ul>
      </div>

    </div>

    <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-500">
      <p>&copy; <span id="footer-year">2026</span> {{ $profile->name ?? 'Ronnie H. Legaspi' }}. All rights reserved.</p>
      <p class="text-gray-400 dark:text-gray-600">{{ $profile->location ?? '' }}</p>
    </div>

  </div>
</footer>

<script>
  document.getElementById('footer-year').textContent = new Date().getFullYear();
</script>
