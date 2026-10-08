# Security Policy

## Reporting a vulnerability

Please **do not open a public issue**. Email **info@inryth.com** with:

- Affected page / file
- Steps to reproduce
- Impact

We aim to respond within 72 hours.

## Practices in this repo

- No secrets in source. Configuration comes from environment variables (`.env.example`); `.env*` files are git-ignored.
- `VITE_*` variables are public — never store private keys in them.
- Deploy credentials live only in GitHub Actions secrets.
- CI runs `npm audit` (high severity, production deps) and a basic secret scan on every push and PR.
- Dependabot opens weekly dependency update PRs.
- `main` is protected: PR review + passing checks required.
