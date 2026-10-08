import { lazy, Suspense } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './pages/Home';

const catalog = () => import('./pages/CatalogPages');
const detail = () => import('./pages/DetailPages');
const site = () => import('./pages/SitePages');
const page = (loader, name) => lazy(() => loader().then((m) => ({ default: m[name] })));

const ArticlePage = page(catalog, 'ArticlePage');
const BlogIndex = page(catalog, 'BlogIndex');
const CaseStudiesIndex = page(catalog, 'CaseStudiesIndex');
const CaseStudyDetail = page(catalog, 'CaseStudyDetail');
const PortfolioDetail = page(catalog, 'PortfolioDetail');
const PortfolioIndex = page(catalog, 'PortfolioIndex');
const ProductsIndex = page(catalog, 'ProductsIndex');
const LandingPage = page(detail, 'LandingPage');
const ProductDetail = page(detail, 'ProductDetail');
const ServiceDetail = page(detail, 'ServiceDetail');
const About = page(site, 'About');
const Contact = page(site, 'Contact');
const FaqPage = page(site, 'FaqPage');
const Industries = page(site, 'Industries');
const LegalPage = page(site, 'LegalPage');
const NotFound = page(site, 'NotFound');
const ServicesIndex = page(site, 'ServicesIndex');
const ThankYou = page(site, 'ThankYou');

function PageLoader() {
  return <div className="page-loader" role="status" aria-label="Loading"><span /></div>;
}

export default function App() {
  return (
    <BrowserRouter>
      <Suspense fallback={<PageLoader />}>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/about" element={<About />} />
          <Route path="/services" element={<ServicesIndex />} />
          <Route path="/services/:slug" element={<ServiceDetail />} />
          <Route path="/products" element={<ProductsIndex />} />
          <Route path="/products/:slug" element={<ProductDetail />} />
          <Route path="/portfolio" element={<PortfolioIndex />} />
          <Route path="/portfolio/:slug" element={<PortfolioDetail />} />
          <Route path="/case-studies" element={<CaseStudiesIndex />} />
          <Route path="/case-studies/:slug" element={<CaseStudyDetail />} />
          <Route path="/blog" element={<BlogIndex />} />
          <Route path="/blog/:slug" element={<ArticlePage />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/faq" element={<FaqPage />} />
          <Route path="/industries" element={<Industries />} />
          <Route path="/thank-you" element={<ThankYou />} />
          <Route path="/landing/:slug" element={<LandingPage />} />
          <Route path="/privacy-policy" element={<LegalPage />} />
          <Route path="/terms-and-conditions" element={<LegalPage />} />
          <Route path="/cookie-policy" element={<LegalPage />} />
          <Route path="/disclaimer" element={<LegalPage />} />
          <Route path="/404" element={<NotFound />} />
          <Route path="*" element={<NotFound />} />
        </Routes>
      </Suspense>
    </BrowserRouter>
  );
}
