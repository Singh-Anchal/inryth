# Contributing

## Branches

| Branch | Purpose |
| --- | --- |
| `main` | Production. Protected — only merged via PR. Every merge deploys. |
| `develop` | Integration / staging. |
| `feature/<short-name>` | New pages, sections, features |
| `fix/<short-name>` | Bug fixes |
| `content/<short-name>` | Copy, images, data-file changes |

Never push directly to `main`.

## Workflow

```bash
git checkout develop && git pull
git checkout -b feature/pricing-section

# work…
npm run lint && npm run build

git add -A
git commit -m "feat(home): add pricing section"
git push -u origin feature/pricing-section
```

Open a PR into `develop`, fill in the template, attach desktop + mobile screenshots for UI changes. After review and green CI, **squash and merge**. Release to production with a PR `develop → main`.

## Commit messages

[Conventional Commits](https://www.conventionalcommits.org/):

```
<type>(<scope>): <summary>
```

| Type | Use for |
| --- | --- |
| `feat` | New feature / section / page |
| `fix` | Bug fix |
| `style` | CSS / visual only |
| `content` | Copy, images, data files |
| `refactor` | Code change without behaviour change |
| `perf` | Performance |
| `docs` | README / docs |
| `ci` | Workflows |
| `chore` | Deps, config |

Examples: `fix(contact): stop sidebar overlapping FAQ`, `content(portfolio): add clinic project`.

## Code guidelines

- Match existing patterns in `src/components/ui.jsx` and `src/styles/site.css`.
- Content belongs in `src/data/*`, not hard-coded in components.
- Use `asset()` for images and `whatsappLink()` for WhatsApp URLs.
- Only internal links (`<Link to="/…">`). External: `wa.me`, `tel:`, `mailto:` only.
- Images: compressed JPG, include `width`, `height`, `alt`, and `loading="lazy"` below the fold.
- Check 360px, 768px and 1366px widths before opening a PR.
- No secrets in code. Use `.env.local` (see `.env.example`).

## Review checklist

- CI green (`Lint & build`, `Dependency audit`)
- No horizontal scroll on mobile
- No console errors
- Copy is short and conversion-focused
