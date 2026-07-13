import { Link } from 'react-router-dom';
import { posts, formatDate, limit } from '../content.js';

export default function BlogPreview() {
  const preview = posts.slice(0, 3);

  return (
    <section id="blog" className="py-20 bg-white dark:bg-gray-950 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ writing ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">From the blog</h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
          {preview.length === 0 && (
            <div data-reveal className="md:col-span-3 bg-gray-50 dark:bg-gray-900 border border-dashed border-gray-200 dark:border-gray-800 rounded-lg p-8 text-center">
              <p className="text-sm text-gray-500 dark:text-gray-400">No posts published yet — check back soon.</p>
            </div>
          )}

          {preview.map((post, i) => (
            <div key={post.id} data-reveal style={{ '--reveal-delay': `${i * 120}ms` }} className="group bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
              <div className="h-36 overflow-hidden">
                {post.cover_image_url ? (
                  <img src={post.cover_image_url} alt={post.title} className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" />
                ) : (
                  <div className="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-gray-900"></div>
                )}
              </div>
              <div className="p-5 flex-1 flex flex-col">
                <h3 className="font-medium text-gray-900 dark:text-white mb-2 leading-snug">{post.title}</h3>
                <p className="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4 flex-1">{limit(post.excerpt, 110)}</p>
                <div className="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 mb-3">
                  <span>{formatDate(post.published_at)}</span>
                  {post.reading_minutes && <span>{post.reading_minutes} min read</span>}
                </div>
                <Link to={`/blog/${post.slug}`} className="inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 dark:text-blue-400 hover:gap-2.5 transition-all duration-200">
                  Read more
                  <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </Link>
              </div>
            </div>
          ))}
        </div>

        <div className="text-center">
          <Link to="/blog" className="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-900 hover:scale-[1.03] active:scale-[0.98]">
            View all posts
          </Link>
        </div>
      </div>
    </section>
  );
}
