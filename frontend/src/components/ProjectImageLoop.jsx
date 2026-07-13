import { useEffect, useState } from 'react';

// Auto-looping slideshow for project screenshots (e.g. SBIRS images
// dropped into src/assets/projects/sbirs/)
export default function ProjectImageLoop({ images, alt }) {
  const [index, setIndex] = useState(0);

  useEffect(() => {
    if (images.length < 2) return undefined;
    const timer = setInterval(() => setIndex((i) => (i + 1) % images.length), 3500);
    return () => clearInterval(timer);
  }, [images.length]);

  return (
    <div className="w-full h-full relative">
      {images.map((src, i) => (
        <img
          key={src}
          src={src}
          alt={alt}
          loading="lazy"
          className={`absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ${i === index ? 'opacity-100' : 'opacity-0'}`}
        />
      ))}
    </div>
  );
}
