import { useReveal, usePageTitle } from '../hooks.js';
import Breadcrumb from '../components/Breadcrumb.jsx';
import Countdown from '../components/Countdown.jsx';
import PricingTable from '../sections/PricingTable.jsx';
import ComparisonTable from '../sections/ComparisonTable.jsx';
import Faq from '../sections/Faq.jsx';

// End of the current month — same as the backend's now()->endOfMonth()
function endOfMonth() {
  const now = new Date();
  return new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59);
}

export default function Pricing() {
  usePageTitle('Pricing & Engagement — Ronnie Legaspi');
  useReveal();

  return (
    <>
      <Breadcrumb items={[{ label: 'Pricing' }]} />

      <section className="py-16 bg-white dark:bg-gray-950 transition-colors duration-300">
        <div className="max-w-6xl mx-auto px-6 lg:px-8">
          <div className="max-w-xl mb-4">
            <p className="text-sm font-mono text-blue-700 dark:text-blue-400 mb-2">[ availability ]</p>
            <h1 className="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Currently accepting new projects</h1>
            <p className="text-sm text-gray-600 dark:text-gray-400 mt-2">
              I take on a limited number of engagements at a time to keep every project well-supported. Here's the
              countdown to the next availability review.
            </p>
          </div>
          <Countdown to={endOfMonth().toISOString()} label="Next availability review in" />
        </div>
      </section>

      <PricingTable />
      <ComparisonTable />
      <Faq />
    </>
  );
}
