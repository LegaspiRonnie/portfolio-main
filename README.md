# Ronnie Legaspi — Portfolio

Monorepo with a separated frontend and backend.

```
portfolio/
├── app/        # Laravel backend (API — implementing soon). Filament admin, DB, services.
└── frontend/   # React (Vite) frontend — fully static for now, deployed to Vercel.
```

## frontend/ (React + Vite)

Fully static for now: all content lives in `src/content.json` + `src/content.js`
(no REST API calls yet). Interactive features (contact form, newsletter, pricing
requests, chat, feedback) show an "under construction — backend implementing soon" modal.

```bash
cd frontend
npm install
npm run dev       # local dev server
npm run build     # production build to dist/
```

Pages (React Router): `/`, `/gallery`, `/pricing`, `/blog`, `/blog/:slug`.

### Deploying to Vercel

1. In Vercel, create a project with **Root Directory = `frontend`** (framework preset: **Vite**).
2. Deploy — no environment variables or database needed. `vercel.json` rewrites all
   routes to `index.html` so React Router handles them.

### SBIRS project images

Drop screenshots into `frontend/src/assets/projects/sbirs/` — they are bundled
automatically on the next build and shown as an auto-looping slideshow (3.5s per
image) on the "Smart Barangay Incident Reporting System" project card, on both the
home page and the gallery. No code changes needed.

### Editing content

- Profile, projects, experience, skills, blog posts → `frontend/src/content.json`
- Quotes, tech icons, sample-work metadata → `frontend/src/content.js`
- Section copy (features, services, FAQ, pricing tiers, …) → `frontend/src/sections/*.jsx`

## app/ (backend)

The original full Laravel application (Filament admin, SQLite, Livewire widgets).
Will be converted into a REST API that the frontend consumes.

```bash
cd app
composer install
npm install && npm run build
php artisan migrate
php artisan serve
```
