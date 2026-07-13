import { useEffect, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';

const SunIcon = (
  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
    <path strokeLinecap="round" strokeLinejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364-6.364l-1.06 1.06M6.696 17.304l-1.06 1.06m12.728 0l-1.06-1.06M6.696 6.696L5.636 5.636M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
  </svg>
);

const MoonIcon = (
  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
    <path strokeLinecap="round" strokeLinejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
  </svg>
);

export default function Navbar() {
  const [dark, setDark] = useState(() => localStorage.getItem('theme') === 'dark');
  const [menuOpen, setMenuOpen] = useState(false);
  const [activeSection, setActiveSection] = useState('');
  const { pathname } = useLocation();

  useEffect(() => {
    document.documentElement.classList.toggle('dark', dark);
    localStorage.setItem('theme', dark ? 'dark' : 'light');
  }, [dark]);

  // Scrollspy for home-page sections
  useEffect(() => {
    setActiveSection('');
    if (pathname !== '/') return undefined;

    const sections = ['about', 'services', 'projects', 'contact']
      .map((id) => document.getElementById(id))
      .filter(Boolean);
    if (sections.length === 0) return undefined;

    const spy = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) setActiveSection(entry.target.id);
        });
      },
      { rootMargin: '-45% 0px -50% 0px', threshold: 0 },
    );
    sections.forEach((section) => spy.observe(section));

    return () => spy.disconnect();
  }, [pathname]);

  const sectionClass = (id) =>
    activeSection === id
      ? 'text-blue-700 dark:text-blue-400 font-semibold'
      : 'hover:text-blue-700 dark:hover:text-blue-400';

  const pageClass = (path) =>
    pathname === path || (path === '/blog' && pathname.startsWith('/blog'))
      ? 'text-blue-700 dark:text-blue-400 font-semibold'
      : 'hover:text-blue-700 dark:hover:text-blue-400';

  const mobileSectionClass = (id) =>
    `block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors ${
      activeSection === id ? 'text-blue-700 dark:text-blue-400 bg-blue-50 dark:bg-gray-900' : ''
    }`;

  const mobilePageClass = (path) =>
    `block px-3 py-2.5 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-400 transition-colors ${
      pathname === path || (path === '/blog' && pathname.startsWith('/blog'))
        ? 'text-blue-700 dark:text-blue-400 bg-blue-50 dark:bg-gray-900'
        : ''
    }`;

  const closeMenu = () => setMenuOpen(false);

  const themeButton = (extra = '') => (
    <button
      type="button"
      onClick={() => setDark((d) => !d)}
      aria-label="Toggle dark mode"
      className={`p-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 ${extra}`}
    >
      {dark ? MoonIcon : SunIcon}
    </button>
  );

  return (
    <header className="fixed top-0 left-0 w-full z-50 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md transition-colors duration-300">
      <nav className="max-w-6xl mx-auto px-6 lg:px-8" aria-label="Main navigation">
        <div className="flex items-center justify-between h-16">
          <Link to="/" className="flex items-center gap-1.5 font-semibold text-lg tracking-tight text-gray-900 dark:text-white shrink-0">
            <span className="text-blue-600 dark:text-blue-400 font-mono">&lt;/&gt;</span>
            <span>
              Ronnie<span className="text-blue-700 dark:text-blue-500">.dev</span>
            </span>
          </Link>

          <ul className="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600 dark:text-gray-300">
            <li><Link to="/#about" className={`transition-colors ${sectionClass('about')}`}>About</Link></li>
            <li><Link to="/#services" className={`transition-colors ${sectionClass('services')}`}>Services</Link></li>
            <li><Link to="/#projects" className={`transition-colors ${sectionClass('projects')}`}>Projects</Link></li>
            <li><Link to="/gallery" className={`transition-colors ${pageClass('/gallery')}`}>Gallery</Link></li>
            <li><Link to="/pricing" className={`transition-colors ${pageClass('/pricing')}`}>Pricing</Link></li>
            <li><Link to="/blog" className={`transition-colors ${pageClass('/blog')}`}>Blog</Link></li>
            <li><Link to="/#contact" className={`transition-colors ${sectionClass('contact')}`}>Contact</Link></li>
          </ul>

          <div className="hidden md:flex items-center gap-3">
            {themeButton('hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 transition-colors')}
            <Link
              to="/#contact"
              className="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-colors"
            >
              Hire me
              <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                <path strokeLinecap="round" strokeLinejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </Link>
          </div>

          <div className="flex items-center gap-2 md:hidden">
            {themeButton()}
            <button
              type="button"
              onClick={() => setMenuOpen((o) => !o)}
              aria-label="Toggle navigation menu"
              aria-expanded={menuOpen}
              className="p-2 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200"
            >
              {menuOpen ? (
                <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              ) : (
                <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              )}
            </button>
          </div>
        </div>

        {menuOpen && (
          <div className="md:hidden pb-6">
            <ul className="flex flex-col gap-1 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
              <li><Link to="/#about" onClick={closeMenu} className={mobileSectionClass('about')}>About</Link></li>
              <li><Link to="/#services" onClick={closeMenu} className={mobileSectionClass('services')}>Services</Link></li>
              <li><Link to="/#projects" onClick={closeMenu} className={mobileSectionClass('projects')}>Projects</Link></li>
              <li><Link to="/gallery" onClick={closeMenu} className={mobilePageClass('/gallery')}>Gallery</Link></li>
              <li><Link to="/pricing" onClick={closeMenu} className={mobilePageClass('/pricing')}>Pricing</Link></li>
              <li><Link to="/blog" onClick={closeMenu} className={mobilePageClass('/blog')}>Blog</Link></li>
              <li><Link to="/#contact" onClick={closeMenu} className={mobileSectionClass('contact')}>Contact</Link></li>
              <li className="pt-2">
                <Link to="/#contact" onClick={closeMenu} className="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-colors">
                  Hire me
                </Link>
              </li>
            </ul>
          </div>
        )}
      </nav>
    </header>
  );
}
