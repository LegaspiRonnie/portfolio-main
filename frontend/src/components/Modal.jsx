import { useEffect, useState } from 'react';

const maxWidths = {
  sm: 'max-w-sm',
  md: 'max-w-md',
  lg: 'max-w-lg',
  xl: 'max-w-xl',
  '2xl': 'max-w-2xl',
};

// Click the trigger to open a titled modal (same look as the Blade x-ui.modal)
export default function Modal({ id, title, maxWidth = 'md', trigger, children }) {
  const [open, setOpen] = useState(false);

  useEffect(() => {
    if (!open) return undefined;
    const onKey = (e) => e.key === 'Escape' && setOpen(false);
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, [open]);

  return (
    <div>
      <div onClick={() => setOpen(true)}>{trigger}</div>

      {open && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby={`${id}-title`}>
          <div onClick={() => setOpen(false)} className="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

          <div className={`relative w-full ${maxWidths[maxWidth] ?? maxWidths.md} bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow-xl transition-colors duration-300`}>
            <div className="flex items-center justify-between gap-4 px-5 py-4 border-b border-gray-200 dark:border-gray-800">
              <h3 id={`${id}-title`} className="font-semibold text-gray-900 dark:text-white">{title}</h3>
              <button
                type="button"
                onClick={() => setOpen(false)}
                aria-label="Close modal"
                className="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300"
              >
                <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div className="p-5">{children}</div>
          </div>
        </div>
      )}
    </div>
  );
}
