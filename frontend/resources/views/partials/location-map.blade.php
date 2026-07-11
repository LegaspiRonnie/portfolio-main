<!-- File: partials/location-map.blade.php -->
@if ($coordinates)
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <div id="location-map" class="mt-4 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-800" style="height: 200px;"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const mapEl = document.getElementById('location-map');
      if (!mapEl || typeof L === 'undefined') return;

      const map = L.map(mapEl, { scrollWheelZoom: false }).setView([{{ $coordinates['lat'] }}, {{ $coordinates['lng'] }}], 12);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(map);

      L.marker([{{ $coordinates['lat'] }}, {{ $coordinates['lng'] }}]).addTo(map)
        .bindPopup(@json($profile->location));
    });
  </script>
@endif
