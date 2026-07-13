const benefits = [
  { title: 'Direct communication', description: 'No account managers or middlemen — you talk directly to the developer building your project.' },
  { title: 'Clean, maintainable code', description: 'Code that is organized and documented well enough for another developer to pick up later.' },
  { title: 'Realistic timelines', description: 'Estimates that account for testing and revisions, not just the happy path — fewer surprises for you.' },
  { title: 'Post-launch support included', description: 'Launch day is not the finish line. I stick around to fix issues and support early usage.' },
  { title: 'Transparent progress updates', description: 'Regular check-ins on what has shipped, what is in progress, and what is coming next.' },
];

export default function Benefits() {
  return (
    <section id="benefits" className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ why work with me ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Built for reliability and clear communication</h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
          {benefits.map((benefit, i) => (
            <div key={benefit.title} data-reveal style={{ '--reveal-delay': `${i * 90}ms` }} className="flex items-start gap-4">
              <div className="shrink-0 w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center mt-0.5">
                <svg className="w-4 h-4 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
              </div>
              <div>
                <h3 className="font-medium text-gray-900 dark:text-white mb-1">{benefit.title}</h3>
                <p className="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{benefit.description}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
