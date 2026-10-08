import { useEffect } from 'react';
import config from '../config';

function setMeta(attr, key, value) {
  if (!value) return;
  let el = document.head.querySelector(`meta[${attr}="${key}"]`);
  if (!el) {
    el = document.createElement('meta');
    el.setAttribute(attr, key);
    document.head.appendChild(el);
  }
  el.setAttribute('content', value);
}

function setLink(rel, href) {
  let el = document.head.querySelector(`link[rel="${rel}"]`);
  if (!el) {
    el = document.createElement('link');
    el.setAttribute('rel', rel);
    document.head.appendChild(el);
  }
  el.setAttribute('href', href);
}

export default function Seo({ title, description, canonical = '/', image, noindex = false, type = 'website' }) {
  useEffect(() => {
    const name = config.siteName;
    const fullTitle = !title || title.includes(name) ? title || name : `${title} | ${name}`;
    document.title = fullTitle;
    const origin = window.location.origin;
    const url = canonical.startsWith('http') ? canonical : origin + (canonical === '/' ? '/' : canonical.replace(/\/$/, ''));
    const desc = description || config.siteDescription;
    const ogImage = image?.startsWith('http') ? image : `${origin}/assets/${(image || 'images/photos/hero-team.jpg').replace(/^\//, '')}`;

    setMeta('name', 'description', desc);
    setMeta('name', 'robots', noindex ? 'noindex,follow' : 'index,follow');
    setLink('canonical', url);
    setMeta('property', 'og:type', type);
    setMeta('property', 'og:title', fullTitle);
    setMeta('property', 'og:description', desc);
    setMeta('property', 'og:url', url);
    setMeta('property', 'og:image', ogImage);
    setMeta('property', 'og:site_name', name);
    setMeta('name', 'twitter:card', 'summary_large_image');
    setMeta('name', 'twitter:title', fullTitle);
    setMeta('name', 'twitter:description', desc);
    setMeta('name', 'twitter:image', ogImage);
  }, [title, description, canonical, image, noindex, type]);

  return null;
}
