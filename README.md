# Ronnie Legaspi — Portfolio

Monorepo with a separated frontend and backend.

```
portfolio/
├── app/        # Laravel backend (API — implementing soon). Filament admin, DB, services.
└── frontend/   # Laravel frontend (static for now) — deployed to Vercel.
```

## frontend/

Fully static for now: all content is hardcoded (no REST API calls yet). Interactive
features (contact form, newsletter, chat, feedback) show an "under construction" modal.

```bash
cd frontend
composer install
npm install && npm run build
php artisan serve
```

Deployed to Vercel via `frontend/vercel.json` (vercel-php runtime).

### Deploying to Vercel

1. In Vercel, create a project with **Root Directory = `frontend`** (framework preset: Other).
2. Add an `APP_KEY` environment variable in the Vercel dashboard (copy it from
   `frontend/.env`, e.g. `base64:...`) — everything else is set in `vercel.json`.
3. Deploy. All pages are static content; no database is required.

### SBIRS project images

Drop screenshots into `frontend/public/images/projects/sbirs/` — they are picked up
automatically and shown as an auto-looping slideshow on the project card (no code
changes needed).

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
