import { useEffect, useState } from 'react';

function parts(target) {
  const diff = target - Date.now();
  if (Number.isNaN(target) || diff <= 0) return { days: 0, hours: 0, minutes: 0, seconds: 0 };
  const totalSeconds = Math.floor(diff / 1000);
  return {
    days: Math.floor(totalSeconds / 86400),
    hours: Math.floor((totalSeconds % 86400) / 3600),
    minutes: Math.floor((totalSeconds % 3600) / 60),
    seconds: totalSeconds % 60,
  };
}

export default function Countdown({ to, label = null }) {
  const target = new Date(to).getTime();
  const [time, setTime] = useState(() => parts(target));

  useEffect(() => {
    const timer = setInterval(() => setTime(parts(target)), 1000);
    return () => clearInterval(timer);
  }, [target]);

  const cells = [
    ['Days', time.days],
    ['Hours', time.hours],
    ['Min', time.minutes],
    ['Sec', time.seconds],
  ];

  return (
    <div className="max-w-md">
      {label && <p className="text-sm text-gray-500 dark:text-gray-400 mb-3">{label}</p>}
      <div className="grid grid-cols-4 gap-3">
        {cells.map(([name, value]) => (
          <div key={name} className="flex flex-col items-center justify-center border border-gray-200 dark:border-gray-800 rounded-lg py-3 bg-white dark:bg-gray-900 transition-colors duration-300">
            <span className="font-mono text-2xl tabular-nums font-semibold text-gray-900 dark:text-white">
              {String(value).padStart(2, '0')}
            </span>
            <span className="text-xs text-gray-400 dark:text-gray-500 mt-1">{name}</span>
          </div>
        ))}
      </div>
    </div>
  );
}
