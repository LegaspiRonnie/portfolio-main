import { useEffect, useRef, useState } from "react";

export default function VideoShowcase() {
  const sectionRef = useRef(null);
  const [playVideo, setPlayVideo] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setPlayVideo(true);
        }
      },
      {
        threshold: 0.6, // Start when about 60% of the section is visible
      }
    );

    if (sectionRef.current) {
      observer.observe(sectionRef.current);
    }

    return () => observer.disconnect();
  }, []);

  return (
    <section
      id="video-showcase"
      ref={sectionRef}
      className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300"
    >
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">
            [ demo reel ]
          </p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">
            See it in action
          </h2>
        </div>

        <div
          data-reveal
          className="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-800 aspect-video"
        >
          {playVideo ? (
            <iframe
              className="w-full h-full"
              src="https://www.youtube.com/embed/XVlfLsdsafs?autoplay=1&mute=1&playsinline=1&rel=0"
              title="Project Showcase"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
              allowFullScreen
            />
          ) : (
            <div className="w-full h-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center">
              <svg
                className="w-16 h-16 text-blue-700 dark:text-blue-400"
                fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path d="M8 5v14l11-7z" />
              </svg>
            </div>
          )}
        </div>
      </div>
    </section>
  );
}