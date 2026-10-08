import { Link } from 'react-router-dom';
import caseStudies from '../data/case-studies';
import faqs from '../data/faqs';
import pages from '../data/pages';
import portfolio from '../data/portfolio';
import services from '../data/services';
import testimonials from '../data/testimonials';
import Layout from '../components/Layout';
import Seo from '../components/Seo';
import { Carousel, CaseStudyCard, CtaSection, FaqAccordion, SectionHeader, ServiceImageCard, StarRating, TestimonialCard, WorkGallery } from '../components/ui';
import { asset, track, whatsappLink } from '../lib/site';
import { PageContext } from '../context/PageContext';

const clients = [
  { name: 'Northline', icon: 'bag-heart' },
  { name: 'Urvan Developers', icon: 'buildings' },
  { name: 'Care Wellness', icon: 'heart-pulse' },
  { name: 'Surya Institute', icon: 'mortarboard' },
  { name: 'Raj Niwas', icon: 'house-heart' },
  { name: 'Advika Consulting', icon: 'briefcase' },
  { name: 'CleanShield', icon: 'shield-check' },
  { name: 'Northbeam', icon: 'graph-up' },
];

const stats = [
  ['120+', 'Projects launched'],
  ['4.9★', 'Client rating'],
  ['35+', 'Cities served'],
  ['24/7', 'WhatsApp support'],
];

const featured = ['website-design', 'digital-marketing', 'graphic-design', 'whatsapp-automation', 'seo', 'meta-ads'];

const steps = [
  ['search', 'Discover', 'Goals, audience, offer.'],
  ['vector-pen', 'Design', 'Graphics and UX that convert.'],
  ['code-slash', 'Build', 'Custom, WordPress or Shopify.'],
  ['rocket-takeoff', 'Grow', 'Ads, SEO and WhatsApp.'],
];

export default function Home() {
  const meta = pages.home;
  const homeFaqs = [...faqs.general.slice(0, 3), ...faqs.pricing.slice(0, 2)];
  const [lead, ...restStudies] = caseStudies;
  return (
    <PageContext.Provider value={{ waMessage: meta.whatsapp_message }}>
      <Layout>
        <Seo title={meta.title} description={meta.description} canonical="/" />

        <section className="hero">
          <div className="hero-orbs" aria-hidden="true">
            <span className="orb orb-blue" />
            <span className="orb orb-orange" />
          </div>
          <div className="container-site">
            <div className="row align-items-center g-5">
              <div className="col-lg-6">
                <p className="hero-badge"><span className="pulse-dot" /> Now booking projects for this month</p>
                <h1>Websites that sell. <span>Marketing that scales.</span></h1>
                <p className="lead">Custom, WordPress and Shopify websites with ads, graphics and WhatsApp — built to turn visitors into customers.</p>
                <div className="btn-group">
                  <Link className="btn btn-lg-cta" to="/contact" onClick={() => track('consultation_click', { label: 'hero' })}>Get Free Consultation</Link>
                  <a className="btn btn-whatsapp btn-lg-cta" href={whatsappLink(meta.whatsapp_message, 'hero')} target="_blank" rel="noopener"><i className="bi bi-whatsapp" aria-hidden="true" /> WhatsApp Us</a>
                </div>
                <div className="hero-proof">
                  <div className="hero-avatars" aria-hidden="true">
                    {testimonials.slice(0, 4).map((t) => <img key={t.name} src={asset(t.avatar)} width="36" height="36" alt="" />)}
                  </div>
                  <div>
                    <StarRating value={5} />
                    <span><strong>4.9/5</strong> from 120+ happy clients</span>
                  </div>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="hero-media">
                  <img className="hero-media-main" src={asset('images/photos/pf-shopify.jpg')} width="1152" height="864" alt="Shopify store and mobile site built by Inryth" fetchPriority="high" />
                  <div className="hero-float hero-float-a">
                    <i className="bi bi-graph-up-arrow" aria-hidden="true" />
                    <div><strong>2.4x</strong><span>more orders</span></div>
                  </div>
                  <div className="hero-float hero-float-b">
                    <i className="bi bi-whatsapp" aria-hidden="true" />
                    <div><strong>New lead</strong><span>via WhatsApp · just now</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section className="logo-strip" aria-label="Clients">
          <div className="container-site">
            <p className="logo-strip-label">Trusted by growing brands across India</p>
          </div>
          <div className="logo-marquee">
            <div className="logo-track">
              {[...clients, ...clients].map((c, i) => (
                <span className="client-logo" key={`${c.name}-${i}`} aria-hidden={i >= clients.length}>
                  <i className={`bi bi-${c.icon}`} aria-hidden="true" />
                  {c.name}
                </span>
              ))}
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <div className="section-head-row">
              <SectionHeader kicker="Services" title="Everything to launch and grow online." />
              <Link className="btn btn-secondary" to="/services">All services</Link>
            </div>
            <div className="row g-4">
              {featured.map((slug) => services.find((s) => s.slug === slug)).filter(Boolean).map((service) => (
                <div className="col-md-6 col-lg-4" key={service.slug}><ServiceImageCard service={service} /></div>
              ))}
            </div>
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5 align-items-center">
              <div className="col-lg-6">
                <div className="team-photo">
                  <img src={asset('images/photos/hero-team.jpg')} width="1280" height="720" alt="Inryth team planning a client website in the Lucknow studio" loading="lazy" />
                  <div className="team-photo-badge">
                    <StarRating value={5} />
                    <strong>4.9 / 5</strong>
                    <span>120+ client reviews</span>
                  </div>
                </div>
              </div>
              <div className="col-lg-6">
                <SectionHeader kicker="Why Inryth" title="Design, development and marketing — one team." lead="One brief, one point of contact, one goal: more customers." />
                <div className="stat-grid">
                  {stats.map(([value, label]) => (
                    <div className="stat" key={label}>
                      <strong>{value}</strong>
                      <span>{label}</span>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <div className="section-head-row">
              <SectionHeader kicker="Our work" title="Recent projects." />
              <Link className="btn btn-secondary" to="/portfolio">View portfolio</Link>
            </div>
            <WorkGallery items={portfolio} />
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="section-head-row">
              <SectionHeader kicker="Case studies" title="Real results for real businesses." />
              <Link className="btn btn-secondary" to="/case-studies">All case studies</Link>
            </div>
            <div className="row g-4">
              <div className="col-lg-7"><CaseStudyCard study={lead} featured /></div>
              <div className="col-lg-5 cs-stack">
                {restStudies.slice(0, 2).map((study) => <CaseStudyCard study={study} key={study.slug} />)}
              </div>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <SectionHeader align="center" kicker="How it works" title="From idea to growth in 4 steps." />
            <div className="steps-row">
              {steps.map(([icon, title, text], i) => (
                <div className="step" key={title}>
                  <span className="step-num">0{i + 1}</span>
                  <i className={`bi bi-${icon}`} aria-hidden="true" />
                  <h3>{title}</h3>
                  <p>{text}</p>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="section-head-row">
              <SectionHeader kicker="Reviews" title="Loved by business owners." />
              <div className="rating-summary">
                <strong>4.9</strong>
                <div>
                  <StarRating value={5} />
                  <span>120+ verified reviews</span>
                </div>
              </div>
            </div>
            <Carousel label="Client reviews" autoplay={6000} className="review-carousel">
              {testimonials.map((item) => <TestimonialCard item={item} key={item.name} />)}
            </Carousel>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <Link className="soon-banner" to="/products">
              <span className="coming-soon-badge static">Coming soon</span>
              <strong>Industry WhatsApp bots for ecommerce, clinics and real estate.</strong>
              <span className="svc-card-link">Join waitlist <i className="bi bi-arrow-right" aria-hidden="true" /></span>
            </Link>
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5 align-items-start">
              <div className="col-lg-5">
                <SectionHeader kicker="FAQ" title="Questions? Answered." />
                <div className="faq-media">
                  <img src={asset('images/photos/svc-marketing.jpg')} width="1152" height="864" alt="Inryth strategists planning a campaign" loading="lazy" />
                </div>
              </div>
              <div className="col-lg-7">
                <FaqAccordion faqs={homeFaqs} id="home-faq" />
                <Link className="svc-card-link mt-3 d-inline-flex" to="/faq">More FAQs <i className="bi bi-arrow-right" aria-hidden="true" /></Link>
              </div>
            </div>
          </div>
        </section>

        <CtaSection />
      </Layout>
    </PageContext.Provider>
  );
}
