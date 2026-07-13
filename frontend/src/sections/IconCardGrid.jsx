// Shared section layout for the Features and Services grids
const colorClasses = {
  blue: 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
  emerald: 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
  violet: 'bg-violet-50 dark:bg-violet-900/30 text-violet-700 dark:text-violet-400',
  amber: 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400',
};

export default function IconCardGrid({ id, kicker, heading, subheading = null, items, iconSize = 'w-10 h-10', children }) {
  return (
    <section id={id} className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ {kicker} ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">{heading}</h2>
          {subheading && <p className="text-sm text-gray-600 dark:text-gray-400 mt-2">{subheading}</p>}
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {items.map((item, i) => (
            <div
              key={item.title}
              data-reveal
              style={{ '--reveal-delay': `${i * 100}ms` }}
              className="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900"
            >
              <div className={`${iconSize} rounded-lg flex items-center justify-center mb-4 ${colorClasses[item.color] ?? colorClasses.blue}`}>
                <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.5">
                  <path strokeLinecap="round" strokeLinejoin="round" d={item.icon} />
                </svg>
              </div>
              <h3 className="font-medium text-gray-900 dark:text-white mb-1.5">{item.title}</h3>
              <p className="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{item.description}</p>
            </div>
          ))}
        </div>

        {children}
      </div>
    </section>
  );
}
