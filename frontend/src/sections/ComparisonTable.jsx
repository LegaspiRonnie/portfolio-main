const Check = () => (
  <svg className="w-4 h-4 text-emerald-600 dark:text-emerald-400 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
    <path strokeLinecap="round" strokeLinejoin="round" d="M4.5 12.75l6 6 9-13.5" />
  </svg>
);

const Cross = () => (
  <svg className="w-4 h-4 text-gray-300 dark:text-gray-700 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
    <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
  </svg>
);

const rows = [
  { label: 'Cost', ronnie: 'Affordable, project-based', agency: 'Higher overhead and rates', diy: 'Cheapest upfront' },
  { label: 'Communication', ronnie: <><Check /> Direct with the developer</>, agency: 'Through account managers', diy: <><Cross /> None</> },
  { label: 'Turnaround time', ronnie: 'Fast, focused execution', agency: 'Slower, multi-client queue', diy: 'Fast, but DIY-limited' },
  { label: 'Code ownership', ronnie: <><Check /> Full ownership, yours to keep</>, agency: 'Often yours, varies by contract', diy: <><Cross /> Locked into the platform</> },
  { label: 'Customization', ronnie: <><Check /> Fully custom to your needs</>, agency: <><Check /> Fully custom</>, diy: <><Cross /> Limited to templates</> },
  { label: 'Post-launch support', ronnie: <><Check /> Included / retainer available</>, agency: 'Usually a paid add-on', diy: <><Cross /> Self-serve only</> },
];

export default function ComparisonTable() {
  return (
    <section id="comparison" className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ compare ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Freelance developer vs. agency vs. DIY</h2>
        </div>

        <div data-reveal className="overflow-x-auto border border-gray-200 dark:border-gray-800 rounded-lg">
          <table className="w-full text-sm min-w-[640px]">
            <thead className="bg-gray-50 dark:bg-gray-900 sticky top-0">
              <tr>
                <th className="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Criteria</th>
                <th className="text-left font-medium text-blue-700 dark:text-blue-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Hiring Ronnie</th>
                <th className="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">Hiring an agency</th>
                <th className="text-left font-medium text-gray-500 dark:text-gray-400 px-5 py-3 border-b border-gray-200 dark:border-gray-800">DIY / no-code</th>
              </tr>
            </thead>
            <tbody>
              {rows.map((row, i) => (
                <tr key={row.label} className={i === rows.length - 1 ? '' : 'border-b border-gray-100 dark:border-gray-800/60'}>
                  <td className="px-5 py-3.5 font-medium text-gray-900 dark:text-white whitespace-nowrap">{row.label}</td>
                  <td className="px-5 py-3.5 text-gray-700 dark:text-gray-300 bg-blue-50/50 dark:bg-blue-900/10">{row.ronnie}</td>
                  <td className="px-5 py-3.5 text-gray-600 dark:text-gray-400">{row.agency}</td>
                  <td className="px-5 py-3.5 text-gray-600 dark:text-gray-400">{row.diy}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  );
}
