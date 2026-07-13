import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';

// Scroll-reveal for [data-reveal] elements; call once per page component
export function useReveal() {
  const { pathname } = useLocation();

  useEffect(() => {
    const els = document.querySelectorAll('[data-reveal]:not(.in-view)');
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 },
    );
    els.forEach((el) => observer.observe(el));

    return () => observer.disconnect();
  }, [pathname]);
}

export function usePageTitle(title) {
  useEffect(() => {
    document.title = title;
  }, [title]);
}
