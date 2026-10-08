import { useCallback, useState } from 'react';
import { Link, useParams, Navigate } from 'react-router-dom';
import blog from '../data/blog';
import caseStudies from '../data/case-studies';
import pages from '../data/pages';
import portfolio from '../data/portfolio';
import products from '../data/products';
import Layout from '../components/Layout';
import Seo from '../components/Seo';
import { Breadcrumb, Carousel, CaseStudyCard, CtaSection, Lightbox, PageHero, PortfolioCard, ProductCard, ServiceImageCard, StarRating } from '../components/ui';
import { asset, getArticle, getCaseStudy, getPortfolio, markdownLite, relatedServices, track, whatsappLink } from '../lib/site';
import { PageContext } from '../context/PageContext';

function Shell({ meta, children, hideSticky }) {
  return (
    <PageContext.Provider value={{ waMessage: meta.whatsapp_message || 'Hi, I would like to discuss digital growth for my business.' }}>
      <Layout hideSticky={hideSticky}>
        <Seo title={meta.title} description={meta.description} canonical={meta.canonical} image={meta.image} type={meta.type} />
        {children}
      </Layout>
    </PageContext.Provider>
  );
}

function DetailHero({ crumbs, kicker, title, lead, image, children }) {
  return (
    <section className="detail-hero">
      <img className="detail-hero-bg" src={asset(image)} alt="" fetchPriority="high" />
      <div className="container-site">
        <Breadcrumb items={crumbs} />
        {kicker && <span className="chip chip-light">{kicker}</span>}
        <h1>{title}</h1>
        {lead && <p className="lead">{lead}</p>}
        {children}
      </div>
    </section>
  );
}

function ImageGallery({ images, name }) {
  const [open, setOpen] = useState(-1);
  const close = useCallback(() => setOpen(-1), []);
  const items = images.map((image, i) => ({ image, name: `${name} — ${i + 1}`, industry: '' }));
  return (
    <>
      <Carousel label={`${name} gallery`} className="gallery-carousel">
        {items.map((item, i) => (
          <button className="work-tile" type="button" key={item.image} onClick={() => setOpen(i)}>
            <img src={asset(item.image)} width="960" height="720" alt={item.name} loading="lazy" />
            <span className="work-tile-zoom" aria-hidden="true"><i className="bi bi-arrows-angle-expand" /></span>
          </button>
        ))}
      </Carousel>
      <Lightbox items={items} index={open} onClose={close} onIndex={setOpen} />
    </>
  );
}

export function ProductsIndex() {
  return (
    <Shell meta={pages.products}>
      <PageHero kicker="Coming soon" title="WhatsApp bots for every industry." lead="Join the waitlist. Websites, ads and graphics are available today." breadcrumbs={pages.products.breadcrumbs} />
      <section className="section">
        <div className="container-site">
          <div className="row g-4">
            {products.map((product) => (
              <div className="col-md-6" key={product.slug}><ProductCard product={product} /></div>
            ))}
          </div>
        </div>
      </section>
      <CtaSection title="Need a website or ads right now?" />
    </Shell>
  );
}

export function PortfolioIndex() {
  const filters = {
    all: 'All',
    websites: 'Websites',
    marketing: 'Marketing',
    automation: 'Automation',
    branding: 'Branding',
    'landing-pages': 'Landing Pages',
  };
  const [filter, setFilter] = useState('all');
  const items = portfolio.filter((item) => filter === 'all' || (item.filters || []).includes(filter));
  return (
    <Shell meta={pages.portfolio}>
      <PageHero kicker="Portfolio" title="Work that speaks for itself." lead="Websites, campaigns and automation for growing Indian brands." breadcrumbs={pages.portfolio.breadcrumbs} />
      <section className="section">
        <div className="container-site">
          <div className="filter-bar" role="toolbar" aria-label="Filter portfolio">
            {Object.entries(filters).map(([key, label]) => (
              <button key={key} className={`filter-btn ${filter === key ? 'active' : ''}`} type="button" onClick={() => { setFilter(key); track('portfolio_filter', { filter: key }); }}>{label}</button>
            ))}
          </div>
          <div className="row g-4">
            {items.map((item) => (
              <div className="col-md-6 col-lg-4" key={item.slug}><PortfolioCard item={item} /></div>
            ))}
          </div>
        </div>
      </section>
      <CtaSection title="Have a similar project in mind?" />
    </Shell>
  );
}

export function CaseStudiesIndex() {
  const [lead, ...rest] = caseStudies;
  return (
    <Shell meta={pages['case-studies']}>
      <PageHero kicker="Case studies" title="Real projects. Measurable results." lead="How we turned traffic into customers for brands like yours." breadcrumbs={pages['case-studies'].breadcrumbs} />
      <section className="section">
        <div className="container-site">
          <div className="mb-4"><CaseStudyCard study={lead} featured /></div>
          <div className="row g-4">
            {rest.map((study) => (
              <div className="col-md-6 col-lg-4" key={study.slug}><CaseStudyCard study={study} /></div>
            ))}
          </div>
        </div>
      </section>
      <CtaSection title="Want results like these?" />
    </Shell>
  );
}

export function BlogIndex() {
  return (
    <Shell meta={pages.blog}>
      <PageHero kicker="Blog" title="Insights on websites, ads and WhatsApp." breadcrumbs={pages.blog.breadcrumbs} />
      <section className="section">
        <div className="container-site">
          <div className="row g-4">
            {blog.map((article) => (
              <div className="col-md-6 col-lg-4" key={article.slug}>
                <Link className="pf-card" to={article.url}>
                  <div className="pf-card-media">
                    <img src={asset(article.image)} width="640" height="480" alt={article.title} loading="lazy" />
                  </div>
                  <div className="pf-card-body">
                    <span className="pf-card-industry">{article.category}</span>
                    <h3>{article.title}</h3>
                    <span className="pf-card-tags">{new Date(article.date).toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' })} · {article.read_time}</span>
                  </div>
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>
    </Shell>
  );
}

export function PortfolioDetail() {
  const { slug } = useParams();
  const item = getPortfolio(slug);
  if (!item) return <Navigate to="/404" replace />;
  const meta = {
    title: `${item.name} | Portfolio`,
    description: item.excerpt,
    canonical: item.url,
    image: item.image,
    whatsapp_message: item.whatsapp_message,
  };
  const more = portfolio.filter((p) => p.slug !== item.slug).slice(0, 3);
  return (
    <Shell meta={meta}>
      <DetailHero crumbs={[...pages.portfolio.breadcrumbs, { name: item.name, url: item.url }]} kicker={item.industry} title={item.name} lead={item.excerpt} image={item.image}>
        <div className="card-meta">{item.services.map((s) => <span className="chip chip-light" key={s}>{s}</span>)}</div>
      </DetailHero>
      <section className="section">
        <div className="container-site">
          <div className="row g-5 align-items-start">
            <div className="col-lg-7">
              <div className="portfolio-thumb mb-4">
                <img src={asset(item.image)} width="960" height="720" alt={item.name} />
              </div>
            </div>
            <div className="col-lg-5">
              <div className="story-stack">
                <div className="story-card"><span className="story-icon"><i className="bi bi-exclamation-diamond" aria-hidden="true" /></span><div><h3>Challenge</h3><p>{item.challenge}</p></div></div>
                <div className="story-card"><span className="story-icon"><i className="bi bi-lightbulb" aria-hidden="true" /></span><div><h3>Approach</h3><p>{item.approach}</p></div></div>
                <div className="story-card story-card-accent"><span className="story-icon"><i className="bi bi-trophy" aria-hidden="true" /></span><div><h3>Result</h3><p>{item.outcome}</p></div></div>
              </div>
              <a className="btn btn-whatsapp mt-4" href={whatsappLink(item.whatsapp_message, 'portfolio-detail')} target="_blank" rel="noopener"><i className="bi bi-whatsapp" aria-hidden="true" /> Discuss a similar project</a>
            </div>
          </div>
        </div>
      </section>
      <section className="section section-light">
        <div className="container-site">
          <div className="section-head-row">
            <div className="section-head"><p className="section-kicker">More work</p><h2 className="section-title">Other projects.</h2></div>
            <Link className="btn btn-secondary" to="/portfolio">View all</Link>
          </div>
          <div className="row g-4">
            {more.map((p) => <div className="col-md-6 col-lg-4" key={p.slug}><PortfolioCard item={p} /></div>)}
          </div>
        </div>
      </section>
      <CtaSection title="Want something like this?" />
    </Shell>
  );
}

export function CaseStudyDetail() {
  const { slug } = useParams();
  const item = getCaseStudy(slug);
  if (!item) return <Navigate to="/404" replace />;
  const meta = {
    title: `${item.name} | Case Study`,
    description: item.summary,
    canonical: item.url,
    image: item.image,
    whatsapp_message: item.whatsapp_message,
  };
  const services = relatedServices(item.related_services || []).slice(0, 3);
  const others = caseStudies.filter((c) => c.slug !== item.slug).slice(0, 2);
  return (
    <Shell meta={meta}>
      <DetailHero crumbs={[...pages['case-studies'].breadcrumbs, { name: item.name, url: item.url }]} kicker={`${item.industry} · ${item.duration}`} title={item.name} lead={item.summary} image={item.image}>
        <p className="detail-hero-client"><i className="bi bi-building" aria-hidden="true" /> {item.client}</p>
      </DetailHero>

      <div className="container-site">
        <div className="metric-bar">
          {item.metrics.map((m) => (
            <div key={m.label}><strong>{m.value}</strong><span>{m.label}</span></div>
          ))}
        </div>
      </div>

      <section className="section">
        <div className="container-site">
          <div className="row g-4">
            <div className="col-md-4"><div className="story-card"><span className="story-icon"><i className="bi bi-exclamation-diamond" aria-hidden="true" /></span><div><h3>Challenge</h3><p>{item.challenge}</p></div></div></div>
            <div className="col-md-4"><div className="story-card"><span className="story-icon"><i className="bi bi-compass" aria-hidden="true" /></span><div><h3>Strategy</h3><p>{item.strategy}</p></div></div></div>
            <div className="col-md-4"><div className="story-card story-card-accent"><span className="story-icon"><i className="bi bi-trophy" aria-hidden="true" /></span><div><h3>Result</h3><p>{item.outcome}</p></div></div></div>
          </div>
        </div>
      </section>

      <section className="section section-light">
        <div className="container-site">
          <div className="row g-5 align-items-center">
            <div className="col-lg-5">
              <p className="section-kicker">What we built</p>
              <h2 className="section-title">Implementation.</h2>
              <ul className="tick-list">
                {item.implementation.map((row) => <li key={row}><i className="bi bi-check-circle-fill" aria-hidden="true" />{row}</li>)}
              </ul>
              <div className="card-meta mt-3">{item.technology.map((t) => <span className="chip" key={t}>{t}</span>)}</div>
            </div>
            <div className="col-lg-7">
              <ImageGallery images={item.gallery || [item.image]} name={item.name} />
            </div>
          </div>
        </div>
      </section>

      {item.quote && (
        <section className="section">
          <div className="container-site">
            <figure className="quote-band">
              <StarRating value={5} />
              <blockquote>“{item.quote.text}”</blockquote>
              <figcaption>
                {item.quote.avatar && <img src={asset(item.quote.avatar)} width="56" height="56" alt={item.quote.name} loading="lazy" />}
                <div><strong>{item.quote.name}</strong><span>{item.quote.role}</span></div>
              </figcaption>
            </figure>
          </div>
        </section>
      )}

      {services.length > 0 && (
        <section className="section section-light">
          <div className="container-site">
            <div className="section-head"><p className="section-kicker">Services used</p><h2 className="section-title">How we did it.</h2></div>
            <div className="row g-4">
              {services.map((s) => <div className="col-md-6 col-lg-4" key={s.slug}><ServiceImageCard service={s} /></div>)}
            </div>
          </div>
        </section>
      )}

      <section className="section">
        <div className="container-site">
          <div className="section-head-row">
            <div className="section-head"><p className="section-kicker">More stories</p><h2 className="section-title">Keep reading.</h2></div>
            <Link className="btn btn-secondary" to="/case-studies">All case studies</Link>
          </div>
          <div className="row g-4">
            {others.map((c) => <div className="col-md-6" key={c.slug}><CaseStudyCard study={c} /></div>)}
          </div>
        </div>
      </section>

      <CtaSection title="Want results like these?" />
    </Shell>
  );
}

export function ArticlePage() {
  const { slug } = useParams();
  const article = getArticle(slug);
  if (!article) return <Navigate to="/404" replace />;
  const related = (article.related || []).map(getArticle).filter(Boolean);
  const meta = {
    title: article.seo_title,
    description: article.seo_description,
    canonical: article.url,
    image: article.image,
    type: 'article',
    whatsapp_message: article.whatsapp_message,
  };
  return (
    <Shell meta={meta}>
      <article>
        <PageHero title={article.title} lead={article.excerpt} breadcrumbs={[...pages.blog.breadcrumbs, { name: article.title, url: article.url }]} />
        <section className="section">
          <div className="container-site">
            <div className="row g-5">
              <div className="col-lg-8">
                <div className="article-thumb mb-4">
                  <img src={asset(article.image)} width="960" height="540" alt={article.title} />
                </div>
                <p className="text-muted small">{article.author} · {new Date(article.date).toLocaleDateString('en-IN', { day: 'numeric', month: 'long', year: 'numeric' })} · {article.read_time}</p>
                <div className="article-body prose" dangerouslySetInnerHTML={{ __html: markdownLite(article.body) }} />
              </div>
              <aside className="col-lg-4">
                <div className="card-premium mb-3 article-cta">
                  <h2 className="h5">Need help with this?</h2>
                  <p>Free 20-minute consultation.</p>
                  <Link className="btn" to="/contact">Get Free Consultation</Link>
                </div>
                {related.length > 0 && (
                  <div className="card-premium">
                    <h2 className="h5">Related articles</h2>
                    {related.map((rel) => <p key={rel.slug}><Link to={rel.url}>{rel.title}</Link></p>)}
                  </div>
                )}
              </aside>
            </div>
          </div>
        </section>
      </article>
      <CtaSection />
    </Shell>
  );
}
