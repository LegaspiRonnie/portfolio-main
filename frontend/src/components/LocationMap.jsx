import { useEffect, useRef } from 'react';

// Loads Leaflet from unpkg on demand (same behavior as the original Blade partial)
export default function LocationMap({ coordinates, label }) {
  const mapEl = useRef(null);

  useEffect(() => {
    if (!coordinates || !mapEl.current) return undefined;

    let map;
    let cancelled = false;

    const init = () => {
      if (cancelled || !window.L || !mapEl.current || mapEl.current._leaflet_id) return;
      map = window.L.map(mapEl.current, { scrollWheelZoom: false }).setView([coordinates.lat, coordinates.lng], 12);
      window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(map);
      window.L.marker([coordinates.lat, coordinates.lng]).addTo(map).bindPopup(label);
    };

    if (!document.getElementById('leaflet-css')) {
      const css = document.createElement('link');
      css.id = 'leaflet-css';
      css.rel = 'stylesheet';
      css.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
      document.head.appendChild(css);
    }

    if (window.L) {
      init();
    } else if (document.getElementById('leaflet-js')) {
      document.getElementById('leaflet-js').addEventListener('load', init);
    } else {
      const script = document.createElement('script');
      script.id = 'leaflet-js';
      script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
      script.addEventListener('load', init);
      document.body.appendChild(script);
    }

    return () => {
      cancelled = true;
      if (map) map.remove();
    };
  }, [coordinates, label]);

  if (!coordinates) return null;

  return (
    <div
      ref={mapEl}
      className="mt-4 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-800"
      style={{ height: '200px' }}
    ></div>
  );
}
