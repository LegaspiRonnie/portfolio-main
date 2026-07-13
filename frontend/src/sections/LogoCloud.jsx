import { techIconUrl } from '../content.js';

const logoStack = ['Laravel', 'React.js', 'Vue.js', 'JavaScript', 'TypeScript', 'MySQL', 'Unity', 'C#', 'Git', 'GitHub', 'Tailwind CSS'];

export default function LogoCloud() {
  return (
    <section id="stack-logos" className="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ toolkit ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Technologies I work with</h2>
        </div>

        <div className="flex flex-wrap items-center gap-x-10 gap-y-8">
          {logoStack.map((tech, i) => {
            const logoUrl = techIconUrl(tech);
            return (
              <div key={tech} data-reveal style={{ '--reveal-delay': `${i * 60}ms` }} className="flex items-center gap-2.5 opacity-70 hover:opacity-100 grayscale hover:grayscale-0 transition-all duration-300">
                {logoUrl ? (
                  <img src={logoUrl} alt={tech} className="w-6 h-6" loading="lazy" />
                ) : (
                  <span className="w-6 h-6 rounded bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-700 dark:text-blue-400 text-xs font-mono">
                    {tech.charAt(0)}
                  </span>
                )}
                <span className="text-sm font-medium text-gray-600 dark:text-gray-400">{tech}</span>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
