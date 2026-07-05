<!-- File: partials/comparison-table.blade.php -->
<section id="comparison" class="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-xl mb-14">
      <p class="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ compare ]</p>
      <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Freelance developer vs. agency vs. DIY</h2>
    </div>

    @php
      $checkIcon = '<svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
      $xIcon = '<svg class="w-4 h-4 text-gray-300 dark:text-gray-700 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';

      $rows = [
        ['label' => 'Cost', 'ronnie' => 'Affordable, project-based', 'agency' => 'Higher overhead and rates', 'diy' => 'Cheapest upfront'],
        ['label' => 'Communication', 'ronnie' => $checkIcon.' Direct with the developer', 'agency' => 'Through account managers', 'diy' => $xIcon.' None'],
        ['label' => 'Turnaround time', 'ronnie' => 'Fast, focused execution', 'agency' => 'Slower, multi-client queue', 'diy' => 'Fast, but DIY-limited'],
        ['label' => 'Code ownership', 'ronnie' => $checkIcon.' Full ownership, yours to keep', 'agency' => 'Often yours, varies by contract', 'diy' => $xIcon.' Locked into the platform'],
        ['label' => 'Customization', 'ronnie' => $checkIcon.' Fully custom to your needs', 'agency' => $checkIcon.' Fully custom', 'diy' => $xIcon.' Limited to templates'],
        ['label' => 'Post-launch support', 'ronnie' => $checkIcon.' Included / retainer available', 'agency' => 'Usually a paid add-on', 'diy' => $xIcon.' Self-serve only'],
      ];
    @endphp

    <div data-reveal class="overflow-x-auto border border-gray-200 dark:border-gray-800 rounded-lg">
      <table class="w-full text-sm min-w-[640px]">
        <thead class="bg-gray-50 dark:bg-gray-900 sticky top-0">
          <tr>
            <th class="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Criteria</th>
            <th class="text-left font-medium text-blue-700 dark:text-blue-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Hiring Ronnie</th>
            <th class="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Hiring an agency</th>
            <th class="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">DIY / no-code</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($rows as $row)
            <tr class="{{ $loop->last ? '' : 'border-b border-gray-100 dark:border-gray-800/60' }}">
              <td class="px-5 py-3.5 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $row['label'] }}</td>
              <td class="px-5 py-3.5 text-gray-700 dark:text-gray-300 bg-blue-50/50 dark:bg-blue-900/10">{!! $row['ronnie'] !!}</td>
              <td class="px-5 py-3.5 text-gray-600 dark:text-gray-400">{!! $row['agency'] !!}</td>
              <td class="px-5 py-3.5 text-gray-600 dark:text-gray-400">{!! $row['diy'] !!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
