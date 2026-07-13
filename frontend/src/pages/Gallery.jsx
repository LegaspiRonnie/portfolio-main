import { useState } from 'react';
import { useReveal, usePageTitle } from '../hooks.js';
import Breadcrumb from '../components/Breadcrumb.jsx';
import Badge from '../components/Badge.jsx';
import Modal from '../components/Modal.jsx';
import ShareButtons from '../components/ShareButtons.jsx';
import EmptyState from '../components/EmptyState.jsx';
import ProjectImageLoop from '../components/ProjectImageLoop.jsx';
import { projects, projectTags, limit } from '../content.js';

export default function Gallery() {
  usePageTitle('Project Gallery — Ronnie Legaspi');
  useReveal();

  const [view, setView] = useState('grid');
  const [activeTag, setActiveTag] = useState('all');

  const visible = projects.filter((p) => activeTag === 'all' || (p.tags ?? []).includes(activeTag));

  const tagButton = (tag, label) => (
    <button
      key={tag}
      type="button"
      onClick={() => setActiveTag(tag)}
      className={`px-3 py-1.5 rounded-full text-xs font-medium transition-colors duration-200 ${
        activeTag === tag
          ? 'bg-blue-700 text-white'
          : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700'
      }`}
    >
      {label}
    </button>
  );

  const viewButton = (name, path) => (
    <button
      type="button"
      onClick={() => setView(name)}
      className={`p-1.5 rounded-md transition-colors duration-300 ${
        view === name
          ? 'bg-white dark:bg-gray-900 text-blue-700 dark:text-blue-400 shadow-sm'
          : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'
      }`}
      aria-label={`${name} view`}
    >
      <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
        <path strokeLinecap="round" strokeLinejoin="round" d={path} />
      </svg>
    </button>
  );

  return (
    <>
      <Breadcrumb items={[{ label: 'Project Gallery' }]} />

      <section className="py-16 bg-white dark:bg-gray-950 transition-colors duration-300">
        <div className="max-w-6xl mx-auto px-6 lg:px-8">
          <div className="max-w-xl mb-10">
            <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ full gallery ]</p>
            <h1 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Every project, in detail</h1>
            <p className="text-sm text-gray-600 dark:text-gray-400 mt-2">
              Browse, filter, and preview all {projects.length} projects — switch between grid and list view.
            </p>
          </div>

          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div className="flex flex-wrap items-center gap-2">
              {tagButton('all', 'All')}
              {projectTags.map((tag) => tagButton(tag, tag))}
            </div>

            <div className="inline-flex items-center gap-1 p-1 rounded-lg bg-gray-100 dark:bg-gray-800 self-start">
              {viewButton('grid', 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z')}
              {viewButton('list', 'M4 6h16M4 12h16M4 18h16')}
            </div>
          </div>

          <div className={view === 'grid' ? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6' : 'flex flex-col gap-4'}>
            {visible.length === 0 && (
              <EmptyState title="No projects yet" message="Projects will show up here once they're added." className="md:col-span-3" />
            )}

            {visible.map((project) => {
              const fallback = `https://picsum.photos/seed/project-${project.id}/800/500`;
              return (
                <div
                  key={project.id}
                  className={`group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900 ${
                    view === 'list' ? 'flex flex-col sm:flex-row' : 'flex flex-col'
                  }`}
                >
                  <Modal
                    id={`project-${project.id}`}
                    title={project.title}
                    maxWidth="2xl"
                    trigger={
                      <div className={`overflow-hidden cursor-zoom-in ${view === 'list' ? 'sm:w-64 shrink-0 h-44 sm:h-full' : 'h-44 w-full'}`}>
                        {project.images.length > 1 ? (
                          <ProjectImageLoop images={project.images} alt={project.title} />
                        ) : (
                          <img
                            src={project.image_url ?? fallback}
                            alt={project.title}
                            loading="lazy"
                            className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                          />
                        )}
                      </div>
                    }
                  >
                    <img src={project.image_url ?? fallback} alt={project.title} className="w-full rounded-lg mb-4" />
                    <p className="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{project.description}</p>
                  </Modal>

                  <div className="p-5 flex-1 flex flex-col">
                    <div className="flex items-start justify-between gap-3 mb-1.5">
                      <h3 className="font-medium text-gray-900 dark:text-white">{project.title}</h3>
                      {project.featured && <Badge label="Featured" color="blue" />}
                    </div>
                    {project.subtitle && <p className="text-xs text-gray-400 dark:text-gray-500 mb-2">{project.subtitle}</p>}
                    <p className="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-3 flex-1">
                      {limit(project.description, 140)}
                    </p>

                    {project.tags && (
                      <div className="flex flex-wrap gap-1.5 mb-4">
                        {project.tags.map((tag) => (
                          <Badge key={tag} label={tag} color="gray" />
                        ))}
                      </div>
                    )}

                    <div className="mt-auto flex items-center gap-3 text-sm">
                      {project.demo_url && (
                        <a href={project.demo_url} target="_blank" rel="noopener noreferrer" className="text-blue-700 dark:text-blue-400 font-medium hover:underline">Live demo</a>
                      )}
                      {project.repo_url && (
                        <a href={project.repo_url} target="_blank" rel="noopener noreferrer" className="text-gray-500 dark:text-gray-400 hover:text-blue-700 dark:hover:text-blue-400">Source</a>
                      )}
                      <ShareButtons url={`${window.location.origin}/gallery#project-${project.id}`} title={project.title} />
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>
    </>
  );
}
