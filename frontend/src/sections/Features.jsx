import IconCardGrid from './IconCardGrid.jsx';

const features = [
  {
    title: 'Full-Stack Development',
    description: 'End-to-end web apps with Laravel on the backend and React or Vue.js on the frontend, from database to deployed UI.',
    icon: 'M10 20l4-16m4 4l4 4-4 4M6 8l-4 4 4 4',
    color: 'blue',
  },
  {
    title: 'Database Design',
    description: 'MySQL schema design, normalization, and query optimization so the app stays fast as data and traffic grow.',
    icon: 'M4 7v10c0 1.657 3.582 3 8 3s8-1.343 8-3V7M4 7c0 1.657 3.582 3 8 3s8-1.343 8-3M4 7c0-1.657 3.582-3 8-3s8 1.343 8 3',
    color: 'emerald',
  },
  {
    title: 'API Integration',
    description: 'Designing clean REST APIs and integrating third-party services so your systems talk to each other reliably.',
    icon: 'M13.5 10.5L21 3m0 0h-5.25M21 3v5.25M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5',
    color: 'violet',
  },
  {
    title: 'Responsive & Accessible UI',
    description: 'Mobile-first interfaces built with Tailwind CSS, with full dark mode support and accessibility in mind from the start.',
    icon: 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
    color: 'amber',
  },
];

export default function Features() {
  return <IconCardGrid id="features" kicker="what i do" heading="What I bring to the table" items={features} />;
}
