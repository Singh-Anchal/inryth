import config from '../config';
import services from '../data/services';
import products from '../data/products';
import portfolio from '../data/portfolio';
import caseStudies from '../data/case-studies';
import blog from '../data/blog';

export function asset(path) {
  return `/assets/${String(path).replace(/^\//, '')}`;
}

export function whatsappLink(message, source = 'website') {
  const raw = String(config.whatsappNumber || '');
  const number = raw.replace(/\D+/g, '');
  const text = `${message || 'Hi, I would like to discuss digital growth for my business.'}\n\nSource: ${source}`;
  const query = `text=${encodeURIComponent(text)}`;
  if (!number || raw.toUpperCase().includes('YOUR_')) {
    return `https://wa.me/?${query}`;
  }
  return `https://wa.me/${number}?${query}`;
}

export function track(eventName, params = {}) {
  try {
    if (typeof window.gtag === 'function') window.gtag('event', eventName, params);
    if (window.dataLayer) window.dataLayer.push({ event: eventName, ...params });
    if (typeof window.fbq === 'function' && eventName === 'form_submit') window.fbq('track', 'Lead', params);
    if (typeof window.fbq === 'function' && eventName === 'whatsapp_click') window.fbq('trackCustom', 'WhatsAppClick', params);
  } catch {
    /* tracking must never break UX */
  }
}

export function findBySlug(items, slug) {
  return items.find((item) => item.slug === slug) || null;
}

export const getService = (slug) => findBySlug(services, slug);
export const getProduct = (slug) => findBySlug(products, slug);
export const getPortfolio = (slug) => findBySlug(portfolio, slug);
export const getCaseStudy = (slug) => findBySlug(caseStudies, slug);
export const getArticle = (slug) => findBySlug(blog, slug);

export function relatedServices(slugs = []) {
  return slugs.map(getService).filter(Boolean);
}

export function relatedProducts(slugs = []) {
  return slugs.map(getProduct).filter(Boolean);
}

const serviceMedia = {
  'digital-marketing': 'svc-marketing.jpg',
  'google-ads': 'svc-search.jpg',
  'meta-ads': 'svc-social.jpg',
  seo: 'pf-localseo.jpg',
  'website-design': 'pf-shopify.jpg',
  'graphic-design': 'pf-graphics.jpg',
  'whatsapp-automation': 'pf-whatsapp.jpg',
  'lead-management': 'bot-wordpress.jpg',
  'ai-automation': 'svc-automation.jpg',
};

export function serviceImage(slug) {
  return `images/photos/${serviceMedia[slug] || 'hero-team.jpg'}`;
}

export function iconName(name) {
  if (name === 'google') return 'search';
  if (name === 'meta') return 'badge-ad';
  return name || 'grid';
}

export function markdownLite(text) {
  const lines = String(text || '').replace(/\r\n/g, '\n').trim().split('\n');
  let html = '';
  let para = [];
  let list = [];
  const flushPara = () => {
    if (para.length) {
      html += `<p>${escapeHtml(para.join(' '))}</p>`;
      para = [];
    }
  };
  const flushList = () => {
    if (list.length) {
      html += `<ul>${list.map((item) => `<li>${escapeHtml(item)}</li>`).join('')}</ul>`;
      list = [];
    }
  };
  lines.forEach((line) => {
    const trimmed = line.trimEnd();
    if (!trimmed) {
      flushPara();
      flushList();
      return;
    }
    if (trimmed.startsWith('## ')) {
      flushPara();
      flushList();
      html += `<h2>${escapeHtml(trimmed.slice(3))}</h2>`;
      return;
    }
    if (trimmed.startsWith('- ')) {
      flushPara();
      list.push(trimmed.slice(2));
      return;
    }
    flushList();
    para.push(trimmed);
  });
  flushPara();
  flushList();
  return html;
}

export function escapeHtml(value) {
  return String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

export const budgetRanges = [
  ['', 'Select a range'],
  ['under-25k', 'Under ₹25,000'],
  ['25k-75k', '₹25,000 – ₹75,000'],
  ['75k-2l', '₹75,000 – ₹2,00,000'],
  ['2l-5l', '₹2,00,000 – ₹5,00,000'],
  ['5l-plus', '₹5,00,000+'],
  ['not-sure', 'Not sure yet'],
];

export const serviceOptions = [
  ['', 'Select a service'],
  ...services.map((s) => [s.slug, s.name]),
  ['products', 'Digital products'],
  ['not-sure', 'Not sure yet'],
];

export const navItems = [
  { label: 'Home', href: '/' },
  { label: 'About', href: '/about' },
  {
    label: 'Services',
    href: '/services',
    children: [
      { label: 'All services', href: '/services' },
      ...services.map((s) => ({ label: s.nav || s.name, href: s.url })),
    ],
  },
  { label: 'Work', href: '/portfolio' },
  { label: 'Case Studies', href: '/case-studies' },
  { label: 'Products', href: '/products' },
  { label: 'Contact', href: '/contact' },
];
