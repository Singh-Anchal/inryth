import { writeFileSync } from 'node:fs';
import blog from '../src/data/blog.js';
import caseStudies from '../src/data/case-studies.js';
import portfolio from '../src/data/portfolio.js';
import products from '../src/data/products.js';
import services from '../src/data/services.js';

const origin = (process.env.SITE_URL || 'https://inryth.com').replace(/\/$/, '');
const today = new Date().toISOString().slice(0, 10);

const staticRoutes = [
  ['/', '1.0'],
  ['/services', '0.9'],
  ['/portfolio', '0.8'],
  ['/case-studies', '0.8'],
  ['/products', '0.7'],
  ['/about', '0.7'],
  ['/contact', '0.8'],
  ['/faq', '0.6'],
  ['/industries', '0.6'],
  ['/blog', '0.6'],
  ['/privacy-policy', '0.3'],
  ['/terms-and-conditions', '0.3'],
  ['/cookie-policy', '0.3'],
  ['/disclaimer', '0.3'],
];

const dynamicRoutes = [
  ...services.map((s) => [s.url, '0.9']),
  ...caseStudies.map((c) => [c.url, '0.7']),
  ...portfolio.map((p) => [p.url, '0.6']),
  ...products.map((p) => [p.url, '0.5']),
  ...blog.map((a) => [a.url, '0.5']),
];

const urls = [...staticRoutes, ...dynamicRoutes]
  .map(([path, priority]) => `  <url><loc>${origin}${path}</loc><lastmod>${today}</lastmod><priority>${priority}</priority></url>`)
  .join('\n');

writeFileSync(new URL('../public/sitemap.xml', import.meta.url), `<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n${urls}\n</urlset>\n`);
writeFileSync(new URL('../public/robots.txt', import.meta.url), `User-agent: *\nAllow: /\nDisallow: /thank-you\nDisallow: /landing/\n\nSitemap: ${origin}/sitemap.xml\n`);
console.log(`sitemap.xml: ${staticRoutes.length + dynamicRoutes.length} URLs`);
