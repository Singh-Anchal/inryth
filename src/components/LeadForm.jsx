import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Link } from 'react-router-dom';
import config from '../config';
import { budgetRanges, serviceOptions, track, whatsappLink } from '../lib/site';

export default function LeadForm({ type = 'enquiry', prefillService = '' }) {
  const navigate = useNavigate();
  const [status, setStatus] = useState('');
  const [sending, setSending] = useState(false);
  const heading = {
    enquiry: 'Tell us what you need',
    website: 'Request a website quote',
    marketing: 'Book a marketing consultation',
  }[type] || 'Tell us what you need';

  async function onSubmit(e) {
    e.preventDefault();
    const form = e.currentTarget;
    const data = Object.fromEntries(new FormData(form).entries());
    if ((data.website_hp || '').trim()) {
      navigate('/thank-you');
      return;
    }
    if (!data.name || data.name.trim().length < 2) {
      setStatus('Please enter your name.');
      return;
    }
    const digits = String(data.phone || '').replace(/\D+/g, '');
    if (digits.length < 10 || digits.length > 15) {
      setStatus('Enter a valid phone number.');
      return;
    }
    setSending(true);
    setStatus('');
    const { website_hp: _hp, ...fields } = data;
    const payload = { ...fields, form_type: type, page_path: window.location.pathname, created_at: new Date().toISOString() };
    if (!config.leadWebhookUrl) {
      const lines = Object.entries(fields)
        .filter(([, v]) => String(v).trim())
        .map(([k, v]) => `${k.replace(/_/g, ' ').replace(/^\w/, (c) => c.toUpperCase())}: ${String(v).trim()}`);
      window.open(whatsappLink(`Hi Inryth, new enquiry (${heading}):\n${lines.join('\n')}`, 'contact-form'), '_blank', 'noopener');
    }
    try {
      if (config.leadWebhookUrl) {
        await fetch(config.leadWebhookUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
        });
      }
      track('form_submit', { form_type: type });
      navigate('/thank-you');
    } catch {
      setSending(false);
      setStatus('Could not send. Please try WhatsApp.');
    }
  }

  return (
    <form className="form-card" onSubmit={onSubmit} noValidate>
      <div className="hp-field" aria-hidden="true">
        <label>Company website<input type="text" name="website_hp" tabIndex={-1} autoComplete="off" /></label>
      </div>
      <h2 className="h4 mb-1">{heading}</h2>
      <p className="form-sub">Takes 30 seconds. We reply within a few hours.</p>
      {status && <p className="form-status" role="alert"><i className="bi bi-exclamation-circle" aria-hidden="true" /> {status}</p>}
      <div className="row g-3">
        <div className="col-md-6">
          <label className="form-label" htmlFor="name">Name</label>
          <input className="form-control" id="name" name="name" required autoComplete="name" />
        </div>
        <div className="col-md-6">
          <label className="form-label" htmlFor="phone">Phone</label>
          <input className="form-control" id="phone" name="phone" required inputMode="tel" autoComplete="tel" />
        </div>
        {type === 'enquiry' && (
          <>
            <div className="col-md-6">
              <label className="form-label" htmlFor="email">Email</label>
              <input className="form-control" id="email" name="email" type="email" autoComplete="email" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="business_name">Business name</label>
              <input className="form-control" id="business_name" name="business_name" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="service">Service</label>
              <select className="form-select" id="service" name="service" defaultValue={prefillService}>
                {serviceOptions.map(([value, label]) => <option key={value || 'empty'} value={value}>{label}</option>)}
              </select>
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="budget">Budget range</label>
              <select className="form-select" id="budget" name="budget">
                {budgetRanges.map(([value, label]) => <option key={value || 'b'} value={value}>{label}</option>)}
              </select>
            </div>
            <div className="col-12">
              <label className="form-label" htmlFor="message">Message</label>
              <textarea className="form-control" id="message" name="message" rows="4" placeholder="What is not working today?" />
            </div>
          </>
        )}
        {type === 'website' && (
          <>
            <div className="col-md-6">
              <label className="form-label" htmlFor="business_type">Business type</label>
              <input className="form-control" id="business_type" name="business_type" placeholder="Real estate, clinic, coaching…" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="website_type">Website type</label>
              <select className="form-select" id="website_type" name="website_type">
                <option value="">Select</option>
                <option>New business website</option>
                <option>Redesign</option>
                <option>Landing page</option>
                <option>E-commerce</option>
                <option>Industry website</option>
              </select>
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="pages">Pages required</label>
              <input className="form-control" id="pages" name="pages" placeholder="e.g. 8–12" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="features">Key features</label>
              <input className="form-control" id="features" name="features" placeholder="WhatsApp, listings, bookings…" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="budget">Budget</label>
              <select className="form-select" id="budget" name="budget">
                {budgetRanges.map(([value, label]) => <option key={value || 'b'} value={value}>{label}</option>)}
              </select>
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="timeline">Timeline</label>
              <input className="form-control" id="timeline" name="timeline" placeholder="e.g. 4 weeks" />
            </div>
          </>
        )}
        {type === 'marketing' && (
          <>
            <div className="col-md-6">
              <label className="form-label" htmlFor="business_name">Business</label>
              <input className="form-control" id="business_name" name="business_name" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="current_website">Current website</label>
              <input className="form-control" id="current_website" name="current_website" placeholder="https://" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="marketing_goal">Marketing goal</label>
              <input className="form-control" id="marketing_goal" name="marketing_goal" placeholder="Leads, calls, enrolments…" />
            </div>
            <div className="col-md-6">
              <label className="form-label" htmlFor="ad_budget">Monthly ad budget</label>
              <select className="form-select" id="ad_budget" name="ad_budget">
                <option value="">Select</option>
                <option>Under ₹25,000</option>
                <option>₹25,000 – ₹75,000</option>
                <option>₹75,000 – ₹2,00,000</option>
                <option>₹2,00,000+</option>
                <option>Not decided</option>
              </select>
            </div>
            <div className="col-12">
              <label className="form-label" htmlFor="service">Preferred service</label>
              <select className="form-select" id="service" name="service" defaultValue={prefillService}>
                {serviceOptions.map(([value, label]) => <option key={value || 'empty'} value={value}>{label}</option>)}
              </select>
            </div>
          </>
        )}
        <div className="col-12">
          <button className="btn btn-lg-cta w-100" type="submit" disabled={sending}><i className="bi bi-send" aria-hidden="true" /> {sending ? 'Sending…' : 'Send enquiry'}</button>
          <p className="small text-muted mt-3 mb-0">We use this only to respond to your request. See our <Link to="/privacy-policy">privacy policy</Link>.</p>
        </div>
      </div>
    </form>
  );
}
