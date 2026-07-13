import { profile, experience, gravatarHash } from '../content.js';

export default function About() {
  const educationEntry = experience.find((e) => e.type === 'education');
  const workEntry = experience.find((e) => e.type === 'work');

  return (
    <section id="about" className="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div data-reveal>
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ about me ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white mb-4">
            BSIT graduate, full-stack developer
          </h2>
          <p className="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">{profile.about_paragraph_1}</p>
          <p className="text-gray-600 dark:text-gray-400 leading-relaxed">{profile.about_paragraph_2}</p>
        </div>

        <div data-reveal style={{ '--reveal-delay': '150ms' }} className="border border-gray-200 dark:border-gray-800 rounded-lg p-6 bg-white dark:bg-gray-900 transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/60 dark:hover:shadow-none hover:-translate-y-0.5">
          <div className="flex items-center gap-3 mb-4">
            <img
              src={`https://www.gravatar.com/avatar/${gravatarHash}?s=96&d=identicon`}
              alt={profile.name}
              className="w-12 h-12 rounded-full border border-gray-200 dark:border-gray-800"
              loading="lazy"
            />
            <div>
              <p className="font-medium text-gray-900 dark:text-white">{profile.name}</p>
              <p className="text-xs text-gray-400 dark:text-gray-500">Full Stack Developer</p>
            </div>
          </div>

          <dl className="space-y-4 text-sm">
            {educationEntry && (
              <div className="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
                <dt className="text-gray-500 dark:text-gray-400">Education</dt>
                <dd className="text-gray-900 dark:text-white font-medium text-right">
                  {educationEntry.title}, {educationEntry.organization}
                </dd>
              </div>
            )}
            {workEntry && (
              <div className="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
                <dt className="text-gray-500 dark:text-gray-400">Experience</dt>
                <dd className="text-gray-900 dark:text-white font-medium text-right">
                  {workEntry.title}, {workEntry.organization}
                </dd>
              </div>
            )}
            <div className="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
              <dt className="text-gray-500 dark:text-gray-400">Location</dt>
              <dd className="text-gray-900 dark:text-white font-medium text-right">{profile.location}</dd>
            </div>
            <div className="flex justify-between">
              <dt className="text-gray-500 dark:text-gray-400">Email</dt>
              <dd className="text-gray-900 dark:text-white font-medium text-right">{profile.email}</dd>
            </div>
          </dl>
        </div>
      </div>
    </section>
  );
}
