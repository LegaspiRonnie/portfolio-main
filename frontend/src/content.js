// Static content layer — the frontend is fully static for now (no REST API).
// Once the backend (../app) exposes its API, swap these exports for fetch calls.
import raw from './content.json';
import profilePhotoUrl from './assets/profile/profile.jpg';

// Screenshots are grouped by their immediate folder name under
// src/assets/projects/. Each project's images_dir determines which group it uses.
const projectImages = Object.entries(
  import.meta.glob('./assets/projects/*/*.{png,jpg,jpeg,webp,gif,PNG,JPG,JPEG,WEBP,GIF}', {
    eager: true,
    query: '?url',
    import: 'default',
  }),
)
  .sort(([a], [b]) => a.localeCompare(b))
  .reduce((byFolder, [path, url]) => {
    const folder = path.split('/').at(-2);
    (byFolder[folder] ??= []).push(url);
    return byFolder;
  }, {});

const portfolioShots = Object.entries(
  import.meta.glob('./assets/portfolio/*/*.{png,jpg,jpeg,webp,gif,PNG,JPG,JPEG,WEBP,GIF}', {
    eager: true,
    query: '?url',
    import: 'default',
  }),
).sort(([a], [b]) => a.localeCompare(b));

export const profile = raw.profile;

export { profilePhotoUrl };

// md5(profile email), precomputed for the gravatar avatar in the About card
export const gravatarHash = '0a4dee4529aa4bb4adb0f12a116a2124';

export const projects = raw.projects
  .filter((project) => !project.is_archived)
  .map((project) => {
    const folder = project.images_dir?.split('/').at(-1);
    const images = folder ? (projectImages[folder] ?? []) : [];

    return {
      ...project,
      images,
      image_url: project.image_url ?? (images.length > 0 ? images[0] : null),
    };
  })
  .sort((a, b) => a.sort_order - b.sort_order);

export const projectTags = [...new Set(projects.flatMap((project) => project.tags ?? []))];

export const experience = [...raw.experience].sort((a, b) => a.sort_order - b.sort_order);

// Skills grouped by group_name, preserving sort order
export const skillGroups = [...raw.skills]
  .sort((a, b) => a.sort_order - b.sort_order)
  .reduce((groups, skill) => {
    const group = groups.find((g) => g.name === skill.group_name);
    if (group) group.skills.push(skill.name);
    else groups.push({ name: skill.group_name, skills: [skill.name] });
    return groups;
  }, []);

const blogImages = import.meta.glob('./assets/blog/*.{png,jpg,jpeg,webp,gif,PNG,JPG,JPEG,WEBP,GIF}', {
  eager: true,
  query: '?url',
  import: 'default',
});

export const posts = raw.posts
  .filter((post) => post.published_at && new Date(post.published_at) <= new Date())
  .sort((a, b) => new Date(b.published_at) - new Date(a.published_at))
  .map((post) => ({
    ...post,
    cover_image_url:
      blogImages[`./assets/blog/${post.cover_image_url}`] ?? null,
  }));
export const stats = {
  projects: projects.length,
  months: profile.stats_months_internship ?? 0,
  technologies: profile.stats_technologies ?? 0,
  percent: profile.stats_percent_learning ?? 100,
};

export const coordinates =
  profile.latitude && profile.longitude ? { lat: profile.latitude, lng: profile.longitude } : null;

// Case-study samples: screenshots grouped by folder under src/assets/portfolio/
const sampleMeta = {
  client1: {
    title: 'Personal Portfolio Website',
    url: 'https://ronnie-legaspi.vercel.app',
    description:
      'An earlier build of my personal developer portfolio — designed and deployed on Vercel with a clean, minimal one-page layout.',
  },
};

export const samples = Object.entries(
  portfolioShots.reduce((bySlug, [path, url]) => {
    const slug = path.split('/').at(-2);
    (bySlug[slug] ??= []).push(url);
    return bySlug;
  }, {}),
).map(([slug, images]) => ({
  slug,
  images,
  ...(sampleMeta[slug] ?? { title: slug.replace(/[-_]/g, ' '), url: null, description: null }),
}));

export function formatDate(value) {
  if (!value) return '';
  return new Date(value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

export function limit(text, length) {
  if (!text) return '';
  return text.length > length ? `${text.slice(0, length).trimEnd()}...` : text;
}

// Same curated quote bank the backend's QuoteService uses
export const quotes = [
  { text: 'Talk is cheap. Show me the code.', author: 'Linus Torvalds' },
  { text: 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.', author: 'Martin Fowler' },
  { text: 'First, solve the problem. Then, write the code.', author: 'John Johnson' },
  { text: 'Make it work, make it right, make it fast.', author: 'Kent Beck' },
  { text: 'Programs must be written for people to read, and only incidentally for machines to execute.', author: 'Harold Abelson' },
  { text: 'Premature optimization is the root of all evil.', author: 'Donald Knuth' },
  { text: "It's not a bug – it's an undocumented feature.", author: 'Anonymous' },
  { text: 'Debugging is twice as hard as writing the code in the first place.', author: 'Brian Kernighan' },
  { text: "Code is like humor. When you have to explain it, it's bad.", author: 'Cory House' },
  { text: 'Simplicity is prerequisite for reliability.', author: 'Edsger W. Dijkstra' },
  { text: 'Deleted code is debugged code.', author: 'Jeff Sickel' },
  { text: 'There are only two hard things in Computer Science: cache invalidation and naming things.', author: 'Phil Karlton' },
  { text: 'Walking on water and developing software from a specification are easy if both are frozen.', author: 'Edward V. Berard' },
  { text: 'The most disastrous thing that you can ever learn is your first programming language.', author: 'Alan Kay' },
  { text: 'Truth can only be found in one place: the code.', author: 'Robert C. Martin' },
];

// Maps known technology names to their Simple Icons slug (cdn.simpleicons.org)
const techSlugs = {
  'laravel (php)': 'laravel',
  laravel: 'laravel',
  'react.js': 'react',
  'vue.js': 'vuedotjs',
  javascript: 'javascript',
  typescript: 'typescript',
  html: 'html5',
  css: 'css',
  mysql: 'mysql',
  unity: 'unity',
  'c#': 'dotnet',
  git: 'git',
  github: 'github',
  php: 'php',
  'tailwind css': 'tailwindcss',
  tailwindcss: 'tailwindcss',
  livewire: 'livewire',
  'alpine.js': 'alpinedotjs',
  filament: 'filament',
};

export function techIconUrl(name) {
  const slug = techSlugs[name.toLowerCase().trim()];
  return slug ? `https://cdn.simpleicons.org/${slug}` : null;
}
