import { Link, Navigate, useParams } from 'react-router-dom';
import faqs from '../data/faqs';
import portfolio from '../data/portfolio';
import testimonials from '../data/testimonials';
import Layout from '../components/Layout';
import LeadForm from '../components/LeadForm';
import Seo from '../components/Seo';
import { Breadcrumb, CtaSection, FaqAccordion, ServiceImageCard, StarRating, TestimonialCard, WorkGallery } from '../components/ui';
import { asset, getProduct, getService, relatedServices, serviceImage, track, whatsappLink } from '../lib/site';
import { PageContext } from '../context/PageContext';

const benefitIcons = ['lightning-charge', 'bullseye', 'graph-up-arrow', 'whatsapp', 'shield-check', 'phone'];

function relatedWork(service) {
  const key = service.name.split(/[\s&]/)[0].toLowerCase();
  const matches = portfolio.filter((p) => (p.services || []).some((s) => s.toLowerCase().includes(key)));
  return matches.length >= 3 ? matches : portfolio;
}

export function ServiceDetail() {
  const { slug } = useParams();
  const service = getService(slug);
  if (!service) return <Navigate to="/404" replace />;
  const serviceFaqs = (faqs[service.faq_group] || faqs.general).slice(0, 5);
  const related = relatedServices(service.related || []).slice(0, 3);
  const work = relatedWork(service);
  const review = testimonials[service.slug.length % testimonials.length];
  return (
    <PageContext.Provider value={{ waMessage: service.whatsapp_message }}>
      <Layout>
        <Seo title={service.seo_title} description={service.seo_description} canonical={service.url} image={serviceImage(service.slug)} />

        <section className="svc-hero">
          <div className="container-site">
            <Breadcrumb items={[{ name: 'Home', url: '/' }, { name: 'Services', url: '/services' }, { name: service.name, url: service.url }]} />
            <div className="row g-5 align-items-center">
              <div className="col-lg-6">
                <p className="section-kicker">{service.category}</p>
                <h1>{service.name}</h1>
                <p className="lead">{service.excerpt}</p>
                <ul className="tick-list">
                  {service.benefits.slice(0, 3).map((b) => <li key={b}><i className="bi bi-check-circle-fill" aria-hidden="true" />{b}</li>)}
                </ul>
                <div className="btn-group">
                  <Link className="btn btn-lg-cta" to={service.cta_href} onClick={() => track('consultation_click', { label: `service-${slug}` })}>{service.cta}</Link>
                  <a className="btn btn-whatsapp btn-lg-cta" href={whatsappLink(service.whatsapp_message, 'service-hero')} target="_blank" rel="noopener"><i className="bi bi-whatsapp" aria-hidden="true" /> WhatsApp</a>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="hero-media">
                  <img className="hero-media-main" src={asset(serviceImage(service.slug))} width="1152" height="864" alt={service.name} fetchPriority="high" />
                  <div className="hero-float hero-float-a">
                    <StarRating value={5} />
                    <div><strong>4.9/5</strong><span>client rating</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <div className="section-head center">
              <p className="section-kicker">Why it works</p>
              <h2 className="section-title">Built for results, not just looks.</h2>
            </div>
            <div className="row g-4">
              {service.benefits.slice(0, 4).map((b, i) => (
                <div className="col-sm-6 col-lg-3" key={b}>
                  <div className="benefit-card">
                    <span className="benefit-icon"><i className={`bi bi-${benefitIcons[i % benefitIcons.length]}`} aria-hidden="true" /></span>
                    <p>{b}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5 align-items-center">
              <div className="col-lg-5">
                <p className="section-kicker">What’s included</p>
                <h2 className="section-title">Everything in one package.</h2>
                <div className="include-grid">
                  {service.includes.map((item) => <span className="include-chip" key={item}><i className="bi bi-check2" aria-hidden="true" />{item}</span>)}
                </div>
              </div>
              <div className="col-lg-7">
                <div className="process-rail">
                  {service.process.slice(0, 4).map((step, i) => (
                    <div className="process-rail-step" key={step.title}>
                      <span className="process-rail-num">{i + 1}</span>
                      <div>
                        <h3>{step.title}</h3>
                        <p>{step.text}</p>
                      </div>
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
              <div className="section-head">
                <p className="section-kicker">Related work</p>
                <h2 className="section-title">See what we’ve built.</h2>
              </div>
              <Link className="btn btn-secondary" to="/portfolio">Full portfolio</Link>
            </div>
            <WorkGallery items={work} autoplay={0} />
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5 align-items-start">
              <div className="col-lg-5">
                <p className="section-kicker">FAQ</p>
                <h2 className="section-title">Good questions.</h2>
                {review && <TestimonialCard item={review} />}
              </div>
              <div className="col-lg-7">
                <FaqAccordion faqs={serviceFaqs} id="service-faq" />
              </div>
            </div>
          </div>
        </section>

        {related.length > 0 && (
          <section className="section">
            <div className="container-site">
              <div className="section-head">
                <p className="section-kicker">Pairs well with</p>
                <h2 className="section-title">Related services.</h2>
              </div>
              <div className="row g-4">
                {related.map((item) => <div className="col-md-6 col-lg-4" key={item.slug}><ServiceImageCard service={item} /></div>)}
              </div>
            </div>
          </section>
        )}

        <CtaSection title={`Start your ${service.name.toLowerCase()} project.`} cta={service.cta} ctaHref={service.cta_href} />
      </Layout>
    </PageContext.Provider>
  );
}

export function ProductDetail() {
  const { slug } = useParams();
  const product = getProduct(slug);
  if (!product) return <Navigate to="/404" replace />;
  return (
    <PageContext.Provider value={{ waMessage: product.whatsapp_message }}>
      <Layout>
        <Seo title={product.seo_title} description={product.seo_description} canonical={product.url} image={product.image} />

        <section className="svc-hero">
          <div className="container-site">
            <Breadcrumb items={[{ name: 'Home', url: '/' }, { name: 'Products', url: '/products' }, { name: product.name, url: product.url }]} />
            <div className="row g-5 align-items-center">
              <div className="col-lg-6">
                {product.comingSoon && <span className="coming-soon-badge static">Coming soon</span>}
                <h1>{product.name}</h1>
                <p className="lead">{product.excerpt}</p>
                <ul className="tick-list">
                  {product.features.slice(0, 4).map((f) => <li key={f}><i className="bi bi-check-circle-fill" aria-hidden="true" />{f}</li>)}
                </ul>
                <div className="btn-group">
                  <a className="btn btn-whatsapp btn-lg-cta" href={whatsappLink(product.whatsapp_message, 'product-hero')} target="_blank" rel="noopener"><i className="bi bi-whatsapp" aria-hidden="true" /> {product.comingSoon ? 'Notify me' : 'Enquire'}</a>
                  <Link className="btn btn-secondary btn-lg-cta" to="/contact?service=products">{product.comingSoon ? 'Join waitlist' : 'Book a demo'}</Link>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="hero-media">
                  <img className="hero-media-main" src={asset(product.image)} width="1152" height="864" alt={product.name} fetchPriority="high" />
                </div>
              </div>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container-site">
            <div className="row g-4">
              {product.benefits.map((b, i) => (
                <div className="col-md-4" key={b}>
                  <div className="benefit-card">
                    <span className="benefit-icon"><i className={`bi bi-${benefitIcons[i % benefitIcons.length]}`} aria-hidden="true" /></span>
                    <p>{b}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5 align-items-start">
              <div className="col-lg-5">
                <p className="section-kicker">FAQ</p>
                <h2 className="section-title">Before you join.</h2>
                <div className="card-meta">{product.ideal_for.map((who) => <span className="chip" key={who}>{who}</span>)}</div>
              </div>
              <div className="col-lg-7"><FaqAccordion faqs={product.faq} id="product-faq" /></div>
            </div>
          </div>
        </section>

        <CtaSection
          title={product.comingSoon ? 'Get early access.' : 'See it in action.'}
          lead={product.comingSoon ? 'Join the waitlist — websites, ads and graphics are available today.' : 'Book a 20-minute walkthrough.'}
          cta={product.comingSoon ? 'Join waitlist' : 'Book a demo'}
          ctaHref="/contact?service=products"
        />
      </Layout>
    </PageContext.Provider>
  );
}

export function LandingPage() {
  const { slug } = useParams();
  const service = getService(slug);
  if (!service) return <Navigate to="/404" replace />;
  const serviceFaqs = (faqs[service.faq_group] || faqs.general).slice(0, 4);
  const formType = slug.includes('website') ? 'website' : 'marketing';
  return (
    <PageContext.Provider value={{ waMessage: service.whatsapp_message }}>
      <Layout minimalNav>
        <Seo title={`${service.cta} | ${service.name} for Indian Businesses`} description={service.seo_description} canonical={`/landing/${slug}`} />
        <section className="svc-hero">
          <div className="container-site">
            <div className="row g-5 align-items-center">
              <div className="col-lg-6">
                <p className="section-kicker">{service.name}</p>
                <h1>{service.hero}</h1>
                <ul className="tick-list">
                  {service.benefits.slice(0, 4).map((b) => <li key={b}><i className="bi bi-check-circle-fill" aria-hidden="true" />{b}</li>)}
                </ul>
                <div className="hero-proof">
                  <div className="hero-avatars" aria-hidden="true">
                    {testimonials.slice(0, 4).map((t) => <img key={t.name} src={asset(t.avatar)} width="36" height="36" alt="" />)}
                  </div>
                  <div>
                    <StarRating value={5} />
                    <span><strong>4.9/5</strong> from 120+ clients</span>
                  </div>
                </div>
              </div>
              <div className="col-lg-6" id="lead-form">
                <LeadForm type={formType} prefillService={service.slug} />
              </div>
            </div>
          </div>
        </section>
        <section className="section">
          <div className="container-site">
            <WorkGallery items={relatedWork(service)} autoplay={0} />
          </div>
        </section>
        <section className="section section-light">
          <div className="container-site">
            <div className="row g-5">
              <div className="col-lg-5">
                <h2 className="section-title">Common questions</h2>
                <a className="btn mt-2" href="#lead-form">{service.cta}</a>
              </div>
              <div className="col-lg-7"><FaqAccordion faqs={serviceFaqs} id="landing-faq" /></div>
            </div>
          </div>
        </section>
      </Layout>
    </PageContext.Provider>
  );
}
