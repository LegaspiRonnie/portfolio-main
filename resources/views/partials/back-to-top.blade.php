<!-- File: partials/back-to-top.blade.php -->
<button
  type="button"
  aria-label="Back to top"
  x-data="{ visible: false }"
  x-init="window.addEventListener('scroll', () => { visible = window.scrollY > 400; })"
  x-show="visible"
  x-cloak
  @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
  class="fixed bottom-6 right-6 p-3 rounded-full bg-blue-700 hover:bg-blue-800 text-white shadow-lg transition-all duration-200 hover:scale-110 z-40"
>
  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
  </svg>
</button>
