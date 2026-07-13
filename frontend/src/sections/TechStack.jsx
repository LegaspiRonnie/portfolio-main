import { skillGroups, techIconUrl } from '../content.js';

export default function TechStack() {
  return (
    <section id="tech-stack" className="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ tech stack ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Technical expertise</h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {skillGroups.map((group, i) => (
            <div
              key={group.name}
              data-reveal
              style={{ '--reveal-delay': `${i * 90}ms` }}
              className="border border-gray-200 dark:border-gray-800 rounded-lg p-6 bg-white dark:bg-gray-900 transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/60 dark:hover:shadow-none hover:-translate-y-0.5"
            >
              <h3 className="font-medium text-gray-900 dark:text-white mb-3">{group.name}</h3>
              <div className="flex flex-wrap items-center gap-2">
                {group.skills.map((skill) => {
                  const iconUrl = techIconUrl(skill);
                  return (
                    <span key={skill} className="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 transition-transform duration-150 hover:scale-110 cursor-default">
                      {iconUrl && <img src={iconUrl} alt="" className="w-3.5 h-3.5" loading="lazy" />}
                      {skill}
                    </span>
                  );
                })}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
