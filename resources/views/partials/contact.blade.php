<!-- File: partials/contact.blade.php -->
@php
  $vcard = "BEGIN:VCARD\r\nVERSION:3.0\r\nFN:{$profile->name}\r\nEMAIL:{$profile->email}\r\n"
    .($profile->phone ? "TEL:{$profile->phone}\r\n" : '')
    .($profile->website_url ? "URL:{$profile->website_url}\r\n" : '')
    ."END:VCARD";
  $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data='.urlencode($vcard);
@endphp
<section id="contact" class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12">

    <div data-reveal>
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ contact ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white mb-4">Let's talk</h2>
      <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-8 max-w-sm">
        Have an opportunity, a project, or just want to connect? Send a message and I'll get back to you.
      </p>

      <div class="space-y-3 text-sm">
        <a href="mailto:{{ $profile->email }}" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
          <svg class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          {{ $profile->email }}
        </a>
        @if ($profile->phone)
          <a href="tel:{{ $profile->phone }}" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            {{ $profile->phone }}
          </a>
        @endif
        @if ($profile->location)
          <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $profile->location }}
            @if ($weather)
              <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                <span class="text-sm leading-none">{{ $weather['icon'] ?? '🌡️' }}</span>
                {{ $weather['temperature'] }}°C · {{ $weather['description'] }}
              </span>
            @endif
          </div>
        @endif
        @if ($profile->website_url)
          <a href="{{ $profile->website_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4 text-blue-700 dark:text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM3.6 9h16.8M3.6 15h16.8M12 3a15 15 0 010 18 15 15 0 010-18z"/></svg>
            {{ preg_replace('#^https?://#', '', $profile->website_url) }}
          </a>
        @endif
      </div>

      @include('partials.location-map')

      <div class="mt-4 flex items-center gap-4 border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
        <img src="{{ $qrCodeUrl }}" alt="QR code to save {{ $profile->name }}'s contact" width="80" height="80" class="rounded-md shrink-0" loading="lazy">
        <div>
          <p class="text-sm font-medium text-gray-900 dark:text-white">Scan to save my contact</p>
          <p class="text-xs text-gray-400 dark:text-gray-500">Adds my name, email, phone, and site as a contact card.</p>
        </div>
      </div>
    </div>

    <div data-reveal style="--reveal-delay:150ms">
      <livewire:contact-form />
    </div>

  </div>
</section>
