# Inryth — Agency Website

[![CI](https://github.com/Singh-Anchal/inryth/actions/workflows/ci.yml/badge.svg)](https://github.com/Singh-Anchal/inryth/actions/workflows/ci.yml)
[![Deploy](https://github.com/Singh-Anchal/inryth/actions/workflows/deploy.yml/badge.svg)](https://github.com/Singh-Anchal/inryth/actions/workflows/deploy.yml)

Production website for **Inryth**, a Lucknow digital agency — websites (custom code, WordPress, Shopify), digital marketing, graphic design and WhatsApp automation for Indian businesses.

**Build → Market → Automate → Grow**

---

## Tech stack

| Layer | Tools |
| --- | --- |
| UI | React 19, React Router 7 |
| Build | Vite 7 (code-split routes) |
| Styling | Bootstrap 5 (CDN) + custom CSS (`src/styles/site.css`), Bootstrap Icons |
| Quality | ESLint 9, GitHub Actions CI |
| Hosting | Vercel / Netlify / Apache — SPA fallbacks included |

## Quick start

Requires **Node 22** (see `.nvmrc`).

```bash
git clone https://github.com/Singh-Anchal/inryth.git
cd inryth
npm ci
npm run dev          # http://localhost:5173
```

> **Windows PowerShell:** if `npm run dev -- --port 5173` misbehaves, use `npx vite --port 5173 --strictPort`.

### Scripts

| Command | What it does |
| --- | --- |
| `npm run dev` | Start the dev server with hot reload |
| `npm run lint` | Run ESLint on all React code |
| `npm run build` | Generate `sitemap.xml` + `robots.txt`, then build to `dist/` |
| `npm run preview` | Serve the production build locally |
| `npm run sitemap` | Regenerate sitemap/robots only |

## Environment variables

Copy `.env.example` → `.env.local`. **Never commit `.env` files.**

| Variable | Purpose |
| --- | --- |
| `SITE_URL` | Domain used in sitemap/robots (default `https://inryth.com`) |
| `VITE_LEAD_WEBHOOK_URL` | Optional POST endpoint for contact-form leads. If empty, the form opens WhatsApp with the enquiry pre-filled |
| `VITE_GA_ID`, `VITE_GTM_ID`, `VITE_META_PIXEL_ID` | Optional analytics IDs |

`VITE_*` values end up in public JavaScript — never put private keys there.

## Project structure

```
src/
├── App.jsx              # Routes (lazy-loaded pages)
├── config.js            # Contact details, WhatsApp number, env-driven IDs
├── components/
│   ├── ui.jsx           # Navbar, Footer, cards, Carousel, Lightbox, FAQ, CTA…
│   ├── Layout.jsx       # Page shell + scroll-reveal animations
│   ├── LeadForm.jsx     # Contact / quote forms
│   ├── Chatbot.jsx      # Guided chat assistant
│   └── Seo.jsx          # Title, meta, Open Graph, canonical
├── data/                # All content: services, portfolio, case studies, blog, FAQs…
├── lib/site.js          # Helpers: asset(), whatsappLink(), track(), nav items
├── pages/               # Home, Catalog (portfolio/case studies/blog), Detail, Site pages
└── styles/site.css      # Design system (orange + blue theme)
public/
├── assets/images/       # Photos, logos, favicon
├── _redirects, .htaccess# SPA fallback for Netlify / Apache
scripts/sitemap.js       # Builds sitemap.xml + robots.txt from data
```

Legacy PHP version of the site (`*.php`, `includes/`, `api/`, `storage/`) is kept for reference and is not part of the React build.

## Editing content

Most changes need **no component code** — edit the data files:

| To change | Edit |
| --- | --- |
| Phone, email, WhatsApp | `src/config.js` |
| Services & service pages | `src/data/services.js` |
| Portfolio projects | `src/data/portfolio.js` |
| Case studies | `src/data/case-studies.js` |
| Reviews | `src/data/testimonials.js` |
| FAQs | `src/data/faqs.js` |
| Blog posts | `src/data/blog.js` |
| Navigation | `navItems` in `src/lib/site.js` |

Images go in `public/assets/images/photos/` (JPG, ≤ 1280px wide, ≤ 200 KB) and are referenced as `images/photos/name.jpg`.

**Site rule:** only internal links. External links allowed only for `wa.me`, `tel:` and `mailto:`.

## CI/CD

```
feature branch ──PR──▶ develop ──PR──▶ main ──▶ CI passes ──▶ auto-deploy to production
```

| Workflow | Trigger | Does |
| --- | --- | --- |
| **CI** (`ci.yml`) | Push / PR to `main`, `develop` | `npm ci` → lint → build → verify output → upload `dist` artifact; `npm audit` + secret scan |
| **Deploy** (`deploy.yml`) | CI success on `main`, or manual | Builds and deploys to Vercel production |
| **Dependabot** | Weekly | PRs for npm and Actions updates |

### One-time setup (repo admin)

1. **Secrets** — *Settings → Secrets and variables → Actions*: add `VERCEL_TOKEN`, `VERCEL_ORG_ID`, `VERCEL_PROJECT_ID` (from `vercel link` → `.vercel/project.json`). Without them, deploy is skipped safely.
   *Alternative:* connect the repo in the Vercel dashboard and delete `deploy.yml`.
2. **Variables** — optional `SITE_URL`.
3. **Branch protection** for `main` (*Settings → Branches*):
   - Require a pull request + 1 approval
   - Require status checks: `Lint & build`, `Dependency audit`
   - Require review from Code Owners
   - Block force pushes and deletions
4. **Environment** — *Settings → Environments → production*: add required reviewers if deploys need sign-off.

## Deployment (manual)

```bash
npm run build      # outputs dist/
```

Upload `dist/` to any static host. SPA routing fallbacks: `vercel.json` (Vercel), `public/_redirects` (Netlify), `public/.htaccess` (Apache/cPanel).

## Team workflow

See [CONTRIBUTING.md](CONTRIBUTING.md) for branching, commit messages and PR rules, and [SECURITY.md](SECURITY.md) for reporting vulnerabilities.

---

© Inryth AI Solutions, Lucknow. All rights reserved.
