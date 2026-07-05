<!-- File: partials/stats.blade.php -->
<section class="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <div data-reveal style="--reveal-delay:0ms">
        <p class="text-3xl md:text-4xl font-semibold text-blue-700 dark:text-blue-400 counter" data-target="{{ $stats['projects'] ?? 3 }}">0</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Projects shipped</p>
      </div>
      <div data-reveal style="--reveal-delay:80ms">
        <p class="text-3xl md:text-4xl font-semibold text-emerald-600 dark:text-emerald-400 counter" data-target="{{ $stats['months'] ?? 5 }}">0</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Months of internship</p>
      </div>
      <div data-reveal style="--reveal-delay:160ms">
        <p class="text-3xl md:text-4xl font-semibold text-violet-600 dark:text-violet-400 counter" data-target="{{ $stats['technologies'] ?? 8 }}">0</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Technologies used</p>
      </div>
      <div data-reveal style="--reveal-delay:240ms">
        <p class="text-3xl md:text-4xl font-semibold text-amber-600 dark:text-amber-400 counter" data-target="{{ $stats['percent'] ?? 100 }}">0</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">% committed to learning</p>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    const counters = document.querySelectorAll('.counter');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));

    function animateCounter(el) {
      const target = parseInt(el.dataset.target, 10);
      const duration = 1000;
      const start = performance.now();

      function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        el.textContent = Math.floor(progress * target);
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target;
      }
      requestAnimationFrame(step);
    }
  })();
</script>
