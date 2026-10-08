import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import Chatbot from './Chatbot';
import { Footer, LandingNav, MobileSticky, Navbar, WhatsAppFloat } from './ui';

export default function Layout({ children, minimalNav = false, hideSticky = false }) {
  const location = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);
  }, [location.pathname]);

  useEffect(() => {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) return undefined;
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-in');
        io.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.section .card-premium, .svc-card, .cs-card, .pf-card, .benefit-card, .step, .process-rail-step, .story-card').forEach((el, i) => {
      el.classList.add('will-reveal');
      el.style.transitionDelay = `${Math.min(i % 6, 5) * 0.05}s`;
      io.observe(el);
    });
    return () => io.disconnect();
  }, [location.pathname]);

  return (
    <>
      <a className="skip-link" href="#main">Skip to content</a>
      {minimalNav ? <LandingNav /> : <Navbar />}
      <main id="main">{children}</main>
      {!minimalNav && <Footer />}
      {!hideSticky && <MobileSticky />}
      {!minimalNav && <WhatsAppFloat />}
      <Chatbot />
    </>
  );
}
