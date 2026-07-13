export default function Testimonials() {
  return (
    <section id="testimonials" className="py-20 bg-gray-50 dark:bg-gray-900/40 transition-colors duration-300">
      <div className="max-w-6xl mx-auto px-6 lg:px-8">
        <div className="max-w-xl mb-14">
          <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ testimonials ]</p>
          <h2 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">What people say</h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div data-reveal className="md:col-span-3 bg-white dark:bg-gray-900 border border-dashed border-gray-200 dark:border-gray-800 rounded-lg p-8 text-center">
            <p className="text-sm text-gray-500 dark:text-gray-400">
              Testimonials coming soon — currently gathering feedback from recent collaborators.
            </p>
          </div>
        </div>
      </div>
    </section>
  );
}
