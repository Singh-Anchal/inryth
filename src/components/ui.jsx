import { Link, NavLink } from 'react-router-dom';
import { Children, useCallback, useEffect, useRef, useState } from 'react';
import config from '../config';
import { asset, iconName, navItems, serviceImage, track, whatsappLink } from '../lib/site';
import { usePage } from '../context/PageContext';

export function SectionHeader({ kicker, title, lead, align = '' }) {
  return (
    <div className={`section-head ${align}`}>
      {kicker && <p className="section-kicker">{kicker}</p>}
      <h2 className="section-title">{title}</h2>
      {lead && <p className="section-lead">{lead}</p>}
    </div>
  );
}

export function Breadcrumb({ items = [] }) {
  if (!items.length) return null;
  return (
    <nav aria-label="Breadcrumb">
      <ol className="breadcrumb">
        {items.map((crumb, i) => {
          const last = i === items.length - 1;
          return (
            <li key={crumb.url} className={`breadcrumb-item ${last ? 'active' : ''}`} aria-current={last ? 'page' : undefined}>
              {last ? crumb.name : <Link to={crumb.url}>{crumb.name}</Link>}
            </li>
          );
        })}
      </ol>
    </nav>
  );
}

export function PageHero({ title, lead, kicker, actions = [], breadcrumbs = [] }) {
  return (
    <section className="page-hero">
      <div className="container-site">
        <Breadcrumb items={breadcrumbs} />
        {kicker && <p className="section-kicker">{kicker}</p>}
        <h1 className="page-hero-title">{title}</h1>
        {lead && <p className="section-lead">{lead}</p>}
        {actions.length > 0 && (
          <div className="btn-group mt-4">
            {actions.map((action) =>
              action.external ? (
                <a key={action.label} className={`btn ${action.className || ''}`} href={action.href} target="_blank" rel="noopener">{action.label}</a>
              ) : (
                <Link key={action.label} className={`btn ${action.className || ''}`} to={action.href}>{action.label}</Link>
              )
            )}
          </div>
        )}
      </div>
    </section>
  );
}

export function CtaSection({
  title = 'Ready to grow? Let’s talk.',
  lead = 'Free 20-minute consultation. Clear plan, no generic pitch.',
  cta = 'Get Free Consultation',
  ctaHref = '/contact',
  wa = 'WhatsApp Us',
}) {
  const { waMessage } = usePage();
  return (
    <section className="cta-band">
      <div className="container-site">
        <div className="cta-band-inner">
          <div>
            <h2>{title}</h2>
            <p>{lead}</p>
          </div>
          <div className="btn-group">
            <Link className="btn btn-light-solid" to={ctaHref} onClick={() => track('consultation_click', { label: 'cta-section' })}>{cta}</Link>
            <a className="btn btn-ghost" href={whatsappLink(waMessage, 'cta-section')} target="_blank" rel="noopener" onClick={() => track('whatsapp_click', { label: 'cta-section' })}><i className="bi bi-whatsapp" aria-hidden="true" /> {wa}</a>
          </div>
        </div>
      </div>
    </section>
  );
}

export function FaqAccordion({ faqs = [], id = 'faq' }) {
  const [open, setOpen] = useState(0);
  if (!faqs.length) return null;
  return (
    <div className="faq-list" id={id}>
      {faqs.map((faq, i) => {
        const isOpen = open === i;
        return (
          <div className={`faq-item ${isOpen ? 'open' : ''}`} key={`${id}-${i}`}>
            <h3 className="faq-q">
              <button type="button" aria-expanded={isOpen} aria-controls={`${id}-a-${i}`} onClick={() => setOpen(isOpen ? -1 : i)}>
                <span>{faq.q}</span>
                <i className="bi bi-plus-lg" aria-hidden="true" />
              </button>
            </h3>
            <div className="faq-a" id={`${id}-a-${i}`} role="region">
              <div><p>{faq.a}</p></div>
            </div>
          </div>
        );
      })}
    </div>
  );
}

export function Carousel({ children, label = 'Carousel', autoplay = 0, className = '' }) {
  const trackRef = useRef(null);
  const [index, setIndex] = useState(0);
  const [pages, setPages] = useState(1);
  const [paused, setPaused] = useState(false);
  const slides = Children.toArray(children);

  const measure = useCallback(() => {
    const el = trackRef.current;
    const first = el?.children[0];
    if (!el || !first) return;
    const step = first.getBoundingClientRect().width + parseFloat(getComputedStyle(el).columnGap || 0);
    const visible = Math.max(1, Math.round((el.clientWidth + 1) / step));
    setPages(Math.max(1, slides.length - visible + 1));
    setIndex(Math.min(slides.length - 1, Math.round(el.scrollLeft / step)));
  }, [slides.length]);

  const go = useCallback((i) => {
    const el = trackRef.current;
    if (!el) return;
    const target = ((i % pages) + pages) % pages;
    const slide = el.children[target];
    if (slide) el.scrollTo({ left: slide.offsetLeft, behavior: 'smooth' });
  }, [pages]);

  useEffect(() => {
    const el = trackRef.current;
    if (!el) return undefined;
    measure();
    el.addEventListener('scroll', measure, { passive: true });
    const ro = new ResizeObserver(measure);
    ro.observe(el);
    return () => { el.removeEventListener('scroll', measure); ro.disconnect(); };
  }, [measure]);

  useEffect(() => {
    if (!autoplay || paused || pages < 2) return undefined;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return undefined;
    const t = setInterval(() => go(index + 1), autoplay);
    return () => clearInterval(t);
  }, [autoplay, paused, pages, index, go]);

  return (
    <div
      className={`carousel-x ${className}`}
      role="region"
      aria-roledescription="carousel"
      aria-label={label}
      onMouseEnter={() => setPaused(true)}
      onMouseLeave={() => setPaused(false)}
      onFocusCapture={() => setPaused(true)}
      onBlurCapture={() => setPaused(false)}
    >
      <div className="carousel-track" ref={trackRef}>
        {slides.map((slide, i) => (
          <div className="carousel-slide" key={i} role="group" aria-roledescription="slide" aria-label={`${i + 1} of ${slides.length}`}>{slide}</div>
        ))}
      </div>
      {pages > 1 && (
        <div className="carousel-controls">
          <div className="carousel-dots">
            {Array.from({ length: pages }, (_, i) => (
              <button key={i} type="button" className={i === Math.min(index, pages - 1) ? 'active' : ''} aria-label={`Go to slide ${i + 1}`} onClick={() => go(i)} />
            ))}
          </div>
          <div className="carousel-arrows">
            <button type="button" aria-label="Previous" onClick={() => go(index - 1)}><i className="bi bi-arrow-left" /></button>
            <button type="button" aria-label="Next" onClick={() => go(index + 1)}><i className="bi bi-arrow-right" /></button>
          </div>
        </div>
      )}
    </div>
  );
}

export function Lightbox({ items, index, onClose, onIndex }) {
  useEffect(() => {
    if (index < 0) return undefined;
    const onKey = (e) => {
      if (e.key === 'Escape') onClose();
      if (e.key === 'ArrowRight') onIndex((index + 1) % items.length);
      if (e.key === 'ArrowLeft') onIndex((index - 1 + items.length) % items.length);
    };
    document.addEventListener('keydown', onKey);
    document.body.classList.add('menu-open');
    return () => { document.removeEventListener('keydown', onKey); document.body.classList.remove('menu-open'); };
  }, [index, items.length, onClose, onIndex]);
  if (index < 0) return null;
  const item = items[index];
  return (
    <div className="lightbox" role="dialog" aria-modal="true" aria-label={item.name} onClick={onClose}>
      <button className="lightbox-close" type="button" aria-label="Close" onClick={onClose}><i className="bi bi-x-lg" /></button>
      <button className="lightbox-nav prev" type="button" aria-label="Previous" onClick={(e) => { e.stopPropagation(); onIndex((index - 1 + items.length) % items.length); }}><i className="bi bi-chevron-left" /></button>
      <figure onClick={(e) => e.stopPropagation()}>
        <img src={asset(item.image)} alt={item.name} />
        <figcaption>
          <div>
            <strong>{item.name}</strong>
            <span>{item.industry}</span>
          </div>
          {item.url && <Link className="btn" to={item.url} onClick={onClose}>View project</Link>}
        </figcaption>
      </figure>
      <button className="lightbox-nav next" type="button" aria-label="Next" onClick={(e) => { e.stopPropagation(); onIndex((index + 1) % items.length); }}><i className="bi bi-chevron-right" /></button>
    </div>
  );
}

export function WorkGallery({ items, autoplay = 4500 }) {
  const [open, setOpen] = useState(-1);
  const close = useCallback(() => setOpen(-1), []);
  return (
    <>
      <Carousel label="Recent work" autoplay={autoplay} className="work-carousel">
        {items.map((item, i) => (
          <button className="work-tile" type="button" key={item.slug} onClick={() => setOpen(i)}>
            <img src={asset(item.image)} width="640" height="480" alt={item.name} loading="lazy" />
            <span className="work-tile-overlay">
              <span className="chip">{item.industry}</span>
              <strong>{item.name}</strong>
              <span className="work-tile-tags">{(item.services || []).join(' · ')}</span>
            </span>
            <span className="work-tile-zoom" aria-hidden="true"><i className="bi bi-arrows-angle-expand" /></span>
          </button>
        ))}
      </Carousel>
      <Lightbox items={items} index={open} onClose={close} onIndex={setOpen} />
    </>
  );
}

export function ServiceImageCard({ service }) {
  return (
    <Link className="svc-card" to={service.url}>
      <div className="svc-card-media">
        <img src={asset(serviceImage(service.slug))} width="640" height="480" alt="" loading="lazy" />
        <span className="svc-card-icon"><i className={`bi bi-${iconName(service.icon)}`} aria-hidden="true" /></span>
      </div>
      <div className="svc-card-body">
        <h3>{service.name}</h3>
        <p>{service.excerpt}</p>
        <span className="svc-card-link">Explore <i className="bi bi-arrow-right" aria-hidden="true" /></span>
      </div>
    </Link>
  );
}

export function ProductCard({ product }) {
  return (
    <article className="card-premium">
      <div className="product-thumb">
        <img src={asset(product.image)} width="640" height="400" alt={product.name} loading="lazy" />
        {product.comingSoon && <span className="coming-soon-badge">Coming soon</span>}
      </div>
      <span className="chip">{product.category}</span>
      <h3 className="mt-3">{product.name}</h3>
      <p>{product.excerpt}</p>
      <div className="btn-group mt-3">
        <Link className="btn" to={product.url} onClick={() => track('product_view', { label: product.slug })}>
          {product.comingSoon ? 'Notify me' : 'View Details'}
        </Link>
        <a className="btn btn-whatsapp" href={whatsappLink(product.whatsapp_message, 'product-card')} target="_blank" rel="noopener" onClick={() => track('product_enquiry', { label: product.slug })}>Enquire on WhatsApp</a>
      </div>
    </article>
  );
}

export function PortfolioCard({ item }) {
  return (
    <Link className="pf-card" to={item.url} onClick={() => track('portfolio_view', { label: item.slug })}>
      <div className="pf-card-media">
        <img src={asset(item.image)} width="640" height="480" alt={item.name} loading="lazy" />
        <span className="pf-card-view">View project <i className="bi bi-arrow-up-right" aria-hidden="true" /></span>
      </div>
      <div className="pf-card-body">
        <span className="pf-card-industry">{item.industry}</span>
        <h3>{item.name}</h3>
        <span className="pf-card-tags">{(item.services || []).join(' · ')}</span>
      </div>
    </Link>
  );
}

export function CaseStudyCard({ study, featured = false }) {
  return (
    <Link className={`cs-card ${featured ? 'cs-card-featured' : ''}`} to={study.url}>
      <div className="cs-card-media">
        <img src={asset(study.image)} width="960" height="720" alt={study.name} loading="lazy" />
        <span className="chip">{study.industry}</span>
      </div>
      <div className="cs-card-body">
        <p className="cs-card-client">{study.client}{study.duration ? ` · ${study.duration}` : ''}</p>
        <h3>{study.name}</h3>
        {featured && <p className="cs-card-summary">{study.summary}</p>}
        {study.metrics && (
          <div className="cs-metrics">
            {study.metrics.slice(0, featured ? 3 : 2).map((m) => (
              <div key={m.label}><strong>{m.value}</strong><span>{m.label}</span></div>
            ))}
          </div>
        )}
        <span className="svc-card-link">Read case study <i className="bi bi-arrow-right" aria-hidden="true" /></span>
      </div>
    </Link>
  );
}

export function StarRating({ value = 5 }) {
  const count = Math.max(0, Math.min(5, Number(value) || 5));
  return (
    <div className="star-row" aria-label={`${count} out of 5 stars`}>
      {Array.from({ length: 5 }, (_, i) => (
        <i className={`bi ${i < count ? 'bi-star-fill' : 'bi-star'}`} key={i} />
      ))}
    </div>
  );
}

export function TestimonialCard({ item }) {
  return (
    <blockquote className="card-premium testimonial-card">
      <div className="d-flex justify-content-between align-items-center">
        <StarRating value={item.rating || 5} />
        <i className="bi bi-quote testimonial-quote" aria-hidden="true" />
      </div>
      <p>“{item.quote}”</p>
      <footer className="testimonial-author">
        {item.avatar && <img src={asset(item.avatar)} width="52" height="52" alt={item.name} loading="lazy" />}
        <div>
          <strong>{item.name}</strong>
          <div className="text-muted small">{item.role ? `${item.role}, ` : ''}{item.company}</div>
          <div className="small testimonial-meta"><i className="bi bi-patch-check-fill" aria-hidden="true" /> Verified client · {item.industry}</div>
        </div>
      </footer>
    </blockquote>
  );
}

export function Navbar() {
  const [open, setOpen] = useState(false);
  const [servicesOpen, setServicesOpen] = useState(false);
  const { waMessage } = usePage();
  useEffect(() => {
    document.body.classList.toggle('menu-open', open);
    return () => document.body.classList.remove('menu-open');
  }, [open]);
  return (
    <>
    <header className="site-header">
      <nav className="navbar navbar-expand-lg navbar-inryth" aria-label="Primary">
        <div className="container-site d-flex align-items-center justify-content-between">
          <Link className="brand" to="/">
            <img className="brand-mark" src={`${asset('images/logo.svg')}?v=2`} width="34" height="34" alt="" />
            <span>Inryth</span>
          </Link>
          <div className="d-none d-lg-flex align-items-center gap-1">
            {navItems.map((item) =>
              item.children ? (
                <div className="dropdown" key={item.href}>
                  <NavLink className={({ isActive }) => `nav-link-inryth dropdown-toggle ${isActive ? 'active' : ''}`} to={item.href}>{item.label}</NavLink>
                  <ul className="dropdown-menu show-on-hover">
                    {item.children.map((child) => (
                      <li key={child.href}><Link className="dropdown-item" to={child.href}>{child.label}</Link></li>
                    ))}
                  </ul>
                </div>
              ) : (
                <NavLink key={item.href} className={({ isActive }) => `nav-link-inryth ${isActive ? 'active' : ''}`} to={item.href} end={item.href === '/'}>{item.label}</NavLink>
              )
            )}
          </div>
          <div className="nav-cta nav-cta-desktop">
            <a className="btn btn-whatsapp" href={whatsappLink(waMessage, 'navbar')} target="_blank" rel="noopener" onClick={() => track('whatsapp_click', { label: 'navbar' })}>WhatsApp Us</a>
            <Link className="btn" to="/contact" onClick={() => track('consultation_click', { label: 'navbar' })}>Get Free Consultation</Link>
          </div>
          <button className="nav-toggle d-lg-none" type="button" aria-expanded={open} aria-label="Open menu" onClick={() => setOpen(true)}>
            <i className="bi bi-list" aria-hidden="true" />
          </button>
        </div>
      </nav>
    </header>
    <div className={`mobile-nav d-lg-none ${open ? 'open' : ''}`} aria-hidden={!open}>
      <div className="mobile-nav-head">
        <Link className="brand" to="/" onClick={() => setOpen(false)}>
          <img className="brand-mark" src={`${asset('images/logo.svg')}?v=2`} width="34" height="34" alt="" />
          <span>Inryth</span>
        </Link>
        <button className="nav-toggle" type="button" aria-label="Close menu" onClick={() => setOpen(false)}><i className="bi bi-x-lg" /></button>
      </div>
      {navItems.map((item) => (
        <div className="mobile-nav-group" key={item.href}>
          {item.children ? (
            <>
              <button className="mobile-nav-link mobile-nav-parent" type="button" aria-expanded={servicesOpen} onClick={() => setServicesOpen((v) => !v)}>
                {item.label}
                <i className={`bi bi-chevron-${servicesOpen ? 'up' : 'down'}`} aria-hidden="true" />
              </button>
              {servicesOpen && (
                <div className="mobile-nav-sub">
                  {item.children.map((child) => (
                    <Link key={child.href} to={child.href} onClick={() => setOpen(false)}>{child.label}</Link>
                  ))}
                </div>
              )}
            </>
          ) : (
            <Link className="mobile-nav-link" to={item.href} onClick={() => setOpen(false)}>{item.label}</Link>
          )}
        </div>
      ))}
      <div className="mobile-nav-cta">
        <Link className="btn" to="/contact" onClick={() => setOpen(false)}>Get Free Consultation</Link>
        <a className="btn btn-whatsapp" href={whatsappLink(waMessage, 'mobile-nav')} target="_blank" rel="noopener">WhatsApp Us</a>
      </div>
      <p className="mobile-nav-contact">
        <a href={`tel:${config.phone.replace(/\s+/g, '')}`}>{config.phone}</a>
        <a href={`mailto:${config.email}`}>{config.email}</a>
      </p>
    </div>
    </>
  );
}

export function LandingNav() {
  const { waMessage } = usePage();
  return (
    <nav className="landing-nav">
      <div className="container-site d-flex justify-content-between align-items-center">
        <Link className="brand" to="/">
          <img className="brand-mark" src={`${asset('images/logo.svg')}?v=2`} width="34" height="34" alt="" />
          <span>Inryth</span>
        </Link>
        <div className="d-flex gap-2">
          <a className="btn btn-whatsapp" href={whatsappLink(waMessage, 'landing-nav')} target="_blank" rel="noopener">WhatsApp</a>
          <a className="btn d-none d-sm-inline-flex" href="#lead-form">Get a plan</a>
        </div>
      </div>
    </nav>
  );
}

export function Footer() {
  const { waMessage } = usePage();
  return (
    <footer className="site-footer">
      <div className="container-site">
        <div className="row g-4">
          <div className="col-12 col-lg-4">
            <Link className="brand footer-brand" to="/">
              <img className="brand-mark" src={`${asset('images/logo.svg')}?v=2`} width="34" height="34" alt="" />
              <span>Inryth</span>
            </Link>
            <p className="footer-about">Websites, digital marketing, graphics and WhatsApp — built to convert. Lucknow, India.</p>
            <div className="footer-social">
              <a href={whatsappLink(waMessage, 'footer-icon')} target="_blank" rel="noopener" aria-label="WhatsApp"><i className="bi bi-whatsapp" /></a>
              <a href={`tel:${config.phone.replace(/\s+/g, '')}`} aria-label="Call"><i className="bi bi-telephone" /></a>
              <a href={`mailto:${config.email}`} aria-label="Email"><i className="bi bi-envelope" /></a>
            </div>
          </div>
          <div className="col-6 col-lg-2">
            <h3 className="h6 text-uppercase" style={{ letterSpacing: '.08em' }}>Company</h3>
            <ul className="footer-links">
              <li><Link to="/about">About</Link></li>
              <li><Link to="/portfolio">Portfolio</Link></li>
              <li><Link to="/case-studies">Case Studies</Link></li>
              <li><Link to="/industries">Industries</Link></li>
              <li><Link to="/blog">Blog</Link></li>
              <li><Link to="/faq">FAQs</Link></li>
              <li><Link to="/contact">Contact</Link></li>
            </ul>
          </div>
          <div className="col-6 col-lg-3">
            <h3 className="h6 text-uppercase" style={{ letterSpacing: '.08em' }}>Services</h3>
            <ul className="footer-links">
              <li><Link to="/services/seo">SEO</Link></li>
              <li><Link to="/services/google-ads">Google Ads</Link></li>
              <li><Link to="/services/meta-ads">Meta Ads</Link></li>
              <li><Link to="/services/website-design">Website Design</Link></li>
              <li><Link to="/services/graphic-design">Graphic Design</Link></li>
              <li><Link to="/services/whatsapp-automation">WhatsApp Automation</Link></li>
              <li><Link to="/products">WhatsApp Bots <span className="footer-soon">Soon</span></Link></li>
            </ul>
          </div>
          <div className="col-12 col-sm-6 col-lg-3">
            <h3 className="h6 text-uppercase" style={{ letterSpacing: '.08em' }}>Contact</h3>
            <ul className="footer-links">
              <li><a href={`tel:${config.phone.replace(/\s+/g, '')}`}>{config.phone}</a></li>
              <li><a href={`mailto:${config.email}`}>{config.email}</a></li>
              <li><a href={whatsappLink(waMessage, 'footer-contact')} target="_blank" rel="noopener">24/7 WhatsApp Chat</a></li>
              <li>{config.address}</li>
            </ul>
          </div>
        </div>
        <div className="footer-bottom d-lg-flex justify-content-between">
          <p className="mb-2 mb-lg-0">&copy; {new Date().getFullYear()} Inryth AI Solutions. All rights reserved.</p>
          <p className="mb-0"><Link to="/privacy-policy">Privacy</Link> · <Link to="/terms-and-conditions">Terms</Link> · <Link to="/cookie-policy">Cookies</Link> · <Link to="/disclaimer">Disclaimer</Link></p>
        </div>
      </div>
    </footer>
  );
}

export function MobileSticky() {
  const { waMessage } = usePage();
  return (
    <div className="mobile-sticky" role="navigation" aria-label="Quick actions">
      <a className="btn btn-whatsapp" href={whatsappLink(waMessage, 'mobile-sticky')} target="_blank" rel="noopener">WhatsApp</a>
      <Link className="btn" to="/contact">Get Quote</Link>
    </div>
  );
}

export function WhatsAppFloat() {
  const { waMessage } = usePage();
  return (
    <a className="float-wa" href={whatsappLink(waMessage, 'float')} target="_blank" rel="noopener" aria-label="Chat on WhatsApp" onClick={() => track('whatsapp_click', { label: 'float' })}>
      <i className="bi bi-whatsapp" aria-hidden="true" />
    </a>
  );
}
