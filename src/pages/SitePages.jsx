import { useState } from 'react';
import { useLocation, useSearchParams, Navigate } from 'react-router-dom';
import config from '../config';
import faqs from '../data/faqs';
import industries from '../data/industries';
import legal from '../data/legal';
import pages from '../data/pages';
import services from '../data/services';
import Layout from '../components/Layout';
import LeadForm from '../components/LeadForm';
import Seo from '../components/Seo';
import { CtaSection, FaqAccordion, PageHero, SectionHeader, ServiceImageCard, StarRating } from '../components/ui';
import { asset, iconName, whatsappLink } from '../lib/site';
import { PageContext } from '../context/PageContext';

function Shell({ pageKey, children, extra = {} }) {
  const meta = { ...(pages[pageKey] || {}), ...extra };
  return (
    <PageContext.Provider value={{ waMessage: meta.whatsapp_message || 'Hi, I would like to discuss digital growth for my business.' }}>
      <Layout hideSticky={meta.hide_sticky_bar}>
        <Seo title={meta.title} description={meta.description} canonical={meta.canonical} noindex={String(meta.robots || '').includes('noindex')} />
        {children}
      </Layout>
    </PageContext.Provider>
  );
}

export function About() {
  return (
    <Shell pageKey="about">
      <PageHero kicker="About us" title="One team for web, marketing and growth." lead="A Lucknow studio helping Indian brands get found, get leads and close faster." breadcrumbs={pages.about.breadcrumbs} />
      <section className="section">
        <div className="container-site">
          <div className="row g-5 align-items-center">
            <div className="col-lg-6">
              <div className="team-photo">
                <img src={asset('images/photos/hero-team.jpg')} width="1280" height="720" alt="Inryth team at the Lucknow studio" loading="lazy" />
              </div>
            </div>
            <div className="col-lg-6">
              <SectionHeader kicker="Our story" title="Build. Market. Automate. Grow." lead="Websites, ads, graphics and WhatsApp — designed together, so every rupee you spend has a clear path to a customer." />
              <div className="stat-grid">
                {[['120+', 'Projects'], ['4.9★', 'Rating'], ['35+', 'Cities'], ['24/7', 'Support']].map(([v, l]) => (
                  <div className="stat" key={l}><strong>{v}</strong><span>{l}</span></div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>
      <section className="section section-light">
        <div className="container-site">
          <div className="row g-4">
            {[
              ['gem', 'Expertise', 'Custom, WordPress, Shopify, ads, SEO and graphics.'],
              ['bullseye', 'Approach', 'Fix the real bottleneck first.'],
              ['buildings', 'Industries', 'Real estate, health, education, retail and more.'],
              ['geo-alt', 'Studio', 'Lucknow — serving clients across India.'],
            ].map(([icon, title, text]) => (
              <div className="col-sm-6 col-lg-3" key={title}>
                <div className="benefit-card">
                  <span className="benefit-icon"><i className={`bi bi-${icon}`} aria-hidden="true" /></span>
                  <h3>{title}</h3>
                  <p>{text}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
      <CtaSection title="Let’s build your growth system." />
    </Shell>
  );
}

export function Contact() {
  const [params] = useSearchParams();
  const type = ['enquiry', 'website', 'marketing'].includes(params.get('form')) ? params.get('form') : 'enquiry';
  return (
    <Shell pageKey="contact">
      <PageHero
        kicker="Contact"
        title="Let’s talk about your project."
        lead="Share a short brief — we reply within a few hours."
        breadcrumbs={pages.contact.breadcrumbs}
        actions={[{ label: 'WhatsApp Us', href: whatsappLink(pages.contact.whatsapp_message, 'contact-hero'), className: 'btn-whatsapp', external: true }]}
      />
      <section className="section">
        <div className="container-site">
          <div className="row g-5 align-items-start">
            <div className="col-lg-7">
              <LeadForm type={type} prefillService={params.get('service') || ''} />
            </div>
            <div className="col-lg-5">
              <aside className="contact-aside">
                <a className="contact-method contact-method-wa" href={whatsappLink(pages.contact.whatsapp_message, 'contact-aside')} target="_blank" rel="noopener">
                  <span className="contact-method-icon"><i className="bi bi-whatsapp" aria-hidden="true" /></span>
                  <span><strong>WhatsApp</strong><small>Fastest reply · {config.businessHours}</small></span>
                  <i className="bi bi-arrow-up-right contact-method-go" aria-hidden="true" />
                </a>
                <a className="contact-method" href={`tel:${config.phone.replace(/\s+/g, '')}`}>
                  <span className="contact-method-icon"><i className="bi bi-telephone" aria-hidden="true" /></span>
                  <span><strong>{config.phone}</strong><small>Call us directly</small></span>
                  <i className="bi bi-arrow-up-right contact-method-go" aria-hidden="true" />
                </a>
                <a className="contact-method" href={`mailto:${config.email}`}>
                  <span className="contact-method-icon"><i className="bi bi-envelope" aria-hidden="true" /></span>
                  <span><strong>{config.email}</strong><small>For briefs and documents</small></span>
                  <i className="bi bi-arrow-up-right contact-method-go" aria-hidden="true" />
                </a>
                <div className="contact-method">
                  <span className="contact-method-icon"><i className="bi bi-geo-alt" aria-hidden="true" /></span>
                  <span><strong>{config.address}</strong><small>Serving clients across {config.serviceArea}</small></span>
                </div>
                <div className="contact-promise">
                  <StarRating value={5} />
                  <p>“Quick replies, clear pricing and a team that actually delivers.”</p>
                  <ul className="tick-list mb-0">
                    <li><i className="bi bi-check-circle-fill" aria-hidden="true" />Free 20-minute consultation</li>
                    <li><i className="bi bi-check-circle-fill" aria-hidden="true" />Fixed quote, no hidden costs</li>
                    <li><i className="bi bi-check-circle-fill" aria-hidden="true" />Reply within a few hours</li>
                  </ul>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </section>
      <section className="section section-light">
        <div className="container-site">
          <div className="row g-5">
            <div className="col-lg-4"><SectionHeader kicker="FAQ" title="Before you write." /></div>
            <div className="col-lg-8"><FaqAccordion faqs={faqs.general.slice(0, 5)} id="contact-faq" /></div>
          </div>
        </div>
      </section>
    </Shell>
  );
}

export function FaqPage() {
  const labels = {
    general: 'General',
    'digital-marketing': 'Digital Marketing',
    website: 'Website Development',
    seo: 'SEO',
    'google-ads': 'Google Ads',
    'meta-ads': 'Meta Ads',
    whatsapp: 'WhatsApp Automation',
    pricing: 'Pricing',
    process: 'Process',
    support: 'Support',
    leads: 'Lead Management',
    automation: 'AI Automation',
    creative: 'Creative',
  };
  const [tab, setTab] = useState('general');
  return (
    <Shell pageKey="faq">
      <PageHero kicker="FAQ" title="Questions? Answered." lead="Can’t find it? Ask us on WhatsApp." breadcrumbs={pages.faq.breadcrumbs} />
      <section className="section">
        <div className="container-site faq-page">
          <div className="filter-bar" role="tablist" aria-label="FAQ topics">
            {Object.keys(faqs).map((key) => (
              <button key={key} type="button" role="tab" aria-selected={tab === key} className={`filter-btn ${tab === key ? 'active' : ''}`} onClick={() => setTab(key)}>{labels[key] || key}</button>
            ))}
          </div>
          <FaqAccordion faqs={faqs[tab]} id={`faq-${tab}`} key={tab} />
        </div>
      </section>
      <CtaSection title="Still have questions?" />
    </Shell>
  );
}

export function Industries() {
  const meta = pages.industries || {
    title: 'Industries | Digital Growth for Indian Businesses',
    description: 'Inryth works with real estate, healthcare, education, hospitality, local businesses, startups and personal brands across India.',
    canonical: '/industries',
    breadcrumbs: [{ name: 'Home', url: '/' }, { name: 'Industries', url: '/industries' }],
    whatsapp_message: 'Hi, I would like to discuss digital growth for my industry.',
  };
  return (
    <PageContext.Provider value={{ waMessage: meta.whatsapp_message }}>
      <Layout>
        <Seo title={meta.title} description={meta.description} canonical="/industries" />
        <PageHero kicker="Industries" title="Industries we help grow." lead="Tailored websites and campaigns for your market." breadcrumbs={meta.breadcrumbs} />
        <section className="section">
          <div className="container-site">
            <div className="row g-3">
              {industries.map((industry) => (
                <div className="col-md-6 col-lg-4" key={industry.slug}>
                  <article className="card-premium" id={industry.slug}>
                    <div className="icon-wrap"><i className={`bi bi-${iconName(industry.icon)}`} /></div>
                    <h2 className="h4">{industry.name}</h2>
                    <p>{industry.excerpt}</p>
                    <div className="card-meta">{industry.needs.map((need) => <span className="chip" key={need}>{need}</span>)}</div>
                  </article>
                </div>
              ))}
            </div>
          </div>
        </section>
        <CtaSection title="Don’t see your industry? Let’s talk." />
      </Layout>
    </PageContext.Provider>
  );
}

export function ThankYou() {
  return (
    <Shell pageKey="thank-you">
      <PageHero
        title="Thank you! We got your enquiry."
        lead="We’ll get back to you shortly. Want a faster reply? Continue on WhatsApp."
        actions={[
          { label: 'Continue on WhatsApp', href: whatsappLink(pages['thank-you'].whatsapp_message, 'thank-you'), className: 'btn-whatsapp', external: true },
          { label: 'Explore Services', href: '/services', className: 'btn-secondary' },
          { label: 'View Portfolio', href: '/portfolio' },
        ]}
      />
    </Shell>
  );
}

export function NotFound() {
  return (
    <Shell pageKey="404" extra={{ canonical: '/404' }}>
      <PageHero
        title="Page not found."
        lead="This link may be outdated. Try one of these instead."
        actions={[
          { label: 'Go Home', href: '/' },
          { label: 'Explore Services', href: '/services', className: 'btn-secondary' },
          { label: 'WhatsApp Us', href: whatsappLink(pages['404'].whatsapp_message, '404'), className: 'btn-whatsapp', external: true },
        ]}
      />
      <section className="section">
        <div className="container-site">
          <div className="row g-3">
            {services.slice(0, 3).map((s) => (
              <div className="col-md-4" key={s.slug}><ServiceImageCard service={s} /></div>
            ))}
          </div>
        </div>
      </section>
    </Shell>
  );
}

export function LegalPage() {
  const location = useLocation();
  const slug = location.pathname.replace(/^\//, '');
  const doc = legal[slug];
  const meta = pages[slug];
  if (!doc || !meta) return <Navigate to="/404" replace />;
  return (
    <Shell pageKey={slug}>
      <PageHero title={doc.title} lead={doc.lead} breadcrumbs={meta.breadcrumbs} />
      <section className="section">
        <div className="container-site prose" style={{ maxWidth: 760 }}>
          <div dangerouslySetInnerHTML={{ __html: doc.html }} />
          <p className="small text-muted mt-5">This page is a professional placeholder and should be reviewed by a qualified advisor before relying on it as legal advice.</p>
        </div>
      </section>
    </Shell>
  );
}

export function ServicesIndex() {
  const groups = ['All', ...new Set(services.map((s) => s.category))];
  const [group, setGroup] = useState('All');
  const list = services.filter((s) => group === 'All' || s.category === group);
  return (
    <Shell pageKey="services">
      <PageHero
        kicker="Services"
        title="Everything you need to grow online."
        lead="Websites, marketing, graphics and WhatsApp — under one roof."
        breadcrumbs={pages.services.breadcrumbs}
        actions={[
          { label: 'Get Free Consultation', href: '/contact' },
          { label: 'WhatsApp Us', href: whatsappLink(pages.services.whatsapp_message, 'services-index'), className: 'btn-whatsapp', external: true },
        ]}
      />
      <section className="section">
        <div className="container-site">
          <div className="filter-bar" role="toolbar" aria-label="Filter services">
            {groups.map((g) => (
              <button key={g} type="button" className={`filter-btn ${group === g ? 'active' : ''}`} onClick={() => setGroup(g)}>{g}</button>
            ))}
          </div>
          <div className="row g-4">
            {list.map((service) => (
              <div className="col-md-6 col-lg-4" key={service.slug}><ServiceImageCard service={service} /></div>
            ))}
          </div>
        </div>
      </section>
      <section className="section section-light">
        <div className="container-site">
          <div className="steps-row">
            {[['patch-check', 'Fixed quotes', 'No hidden costs.'], ['clock-history', 'Fast delivery', 'Most sites in 2–4 weeks.'], ['whatsapp', '24/7 WhatsApp', 'Real people, quick replies.'], ['graph-up-arrow', 'Results first', 'Tracked from click to lead.']].map(([icon, title, text]) => (
              <div className="step" key={title}>
                <i className={`bi bi-${icon}`} aria-hidden="true" />
                <h3>{title}</h3>
                <p>{text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
      <CtaSection title="Not sure where to start? Let’s talk." />
    </Shell>
  );
}
