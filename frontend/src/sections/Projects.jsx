import { Link } from 'react-router-dom';
import ProjectCard from '../components/ProjectCard.jsx';
import { projects } from '../content.js';

const projectIcons = [
  'M9 4.5v15m6-15v15M4.5 9h15M4.5 15h15M6 4.5h12A1.5 1.5 0 0119.5 6v12a1.5 1.5 0 01-1.5 1.5H6A1.5 1.5 0 014.5 18V6A1.5 1.5 0 016 4.5z',
  'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
  'M4 6a2 2 0 012-2h12a2 2 0 012 2v2H4V6zm0 4h16v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8z',
];

export default function Projects() {
  return (
    <section id="projects" className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="flex flex-wrap items-end justify-between gap-4 mb-14">
          <div className="max-w-xl">
            <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ projects ]</p>
            <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Selected work</h2>
            <p className="text-sm text-gray-600 dark:text-gray-400 mt-2">
              Click a thumbnail to switch screenshots, or hit View for fullscreen.
            </p>
          </div>
          <Link to="/gallery" className="inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 dark:text-blue-400 hover:gap-2.5 transition-all duration-200">
            View full gallery
            <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
              <path strokeLinecap="round" strokeLinejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </Link>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {projects.map((project, i) => (
            <ProjectCard
              key={project.id}
              project={project}
              iconPath={projectIcons[i % projectIcons.length]}
              revealDelay={`${i * 120}ms`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
