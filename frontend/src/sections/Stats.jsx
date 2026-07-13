import Counter from '../components/Counter.jsx';
import { stats } from '../content.js';

const items = [
  { value: stats.projects, label: 'Projects shipped', color: 'text-blue-700 dark:text-blue-400' },
  { value: stats.months, label: 'Months of internship', color: 'text-emerald-600 dark:text-emerald-400' },
  { value: stats.technologies, label: 'Technologies used', color: 'text-violet-600 dark:text-violet-400' },
  { value: stats.percent, label: '% committed to learning', color: 'text-amber-600 dark:text-amber-400' },
];

export default function Stats() {
  return (
    <section className="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          {items.map((item, i) => (
            <div key={item.label} data-reveal style={{ '--reveal-delay': `${i * 80}ms` }}>
              <Counter target={item.value} className={`text-3xl md:text-4xl font-semibold ${item.color}`} />
              <p className="text-sm text-gray-500 dark:text-gray-400 mt-1">{item.label}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
