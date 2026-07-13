import { useState } from 'react';

export default function CookieConsent() {
  const [show, setShow] = useState(() => !localStorage.getItem('cookie-consent'));

  const answer = (value) => {
    localStorage.setItem('cookie-consent', value);
    setShow(false);
  };

  if (!show) return null;

  return (
    <div className="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
      <div className="max-w-4xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center gap-4">
        <p className="text-sm text-gray-600 dark:text-gray-400 flex-1">
          This site uses cookies — including a first-party visitor cookie used for basic visit analytics — to improve
          your browsing experience. By continuing, you agree to our use of cookies.
        </p>
        <div className="flex items-center gap-3 shrink-0">
          <button
            type="button"
            onClick={() => answer('declined')}
            className="px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
          >
            Decline
          </button>
          <button
            type="button"
            onClick={() => answer('accepted')}
            className="px-4 py-2 text-sm font-medium rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
          >
            Accept
          </button>
        </div>
      </div>
    </div>
  );
}
