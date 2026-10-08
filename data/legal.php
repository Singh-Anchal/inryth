<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

$name = e(config('site_name'));

return [
    'privacy-policy' => [
        'title' => 'Privacy Policy',
        'lead' => 'How we collect and use information submitted through this website.',
        'html' => <<<HTML
<p>This policy describes how {$name} (“we”, “us”) handles information collected through our website, enquiry forms, chatbot and WhatsApp conversations.</p>
<h2>Information we collect</h2>
<p>When you submit a form or message us, we may collect your name, phone number, email, business details, service interest, budget range and the message you write. Server logs may include IP address, browser type and pages visited.</p>
<h2>How we use it</h2>
<p>We use this information to respond to enquiries, prepare proposals, improve the website, and — where you have asked us to — follow up on WhatsApp or email. We do not sell your information.</p>
<h2>Legal bases</h2>
<p>For Indian visitors, we process enquiry data to take steps at your request before a contract, and to pursue legitimate business interests in responding to you. Marketing messages are sent only where permitted.</p>
<h2>Sharing</h2>
<p>We may use processors such as hosting, email, analytics and WhatsApp Business tools. Future integrations (CRM, Google Sheets, n8n, webhooks) will only receive the data needed to handle your enquiry.</p>
<h2>Retention</h2>
<p>Enquiry records are kept only as long as needed for sales follow-up, accounting or legal requirements, then deleted or anonymised.</p>
<h2>Your choices</h2>
<p>You may ask to access, correct or delete enquiry data we hold, subject to legal exceptions. Contact us using the details in configuration or via the contact page.</p>
<h2>Cookies and analytics</h2>
<p>See our cookie policy. Analytics and advertising tags are loaded only when their IDs are configured.</p>
<h2>Children</h2>
<p>This website is intended for business customers, not for children.</p>
<h2>Changes</h2>
<p>We may update this policy. The date of the latest change will be reflected when this document is revised.</p>
HTML,
    ],
    'terms-and-conditions' => [
        'title' => 'Terms and Conditions',
        'lead' => 'Terms that govern use of this website and any later service engagement.',
        'html' => <<<HTML
<p>By using the {$name} website you agree to these terms. A separate proposal or service agreement will govern paid work.</p>
<h2>Website use</h2>
<p>Content on this site is for general information. It is not a binding offer. We may change services, copy and pricing guidance without notice.</p>
<h2>Enquiries</h2>
<p>Submitting a form or WhatsApp message is a request for contact, not a contract. We may decline work that is not a fit.</p>
<h2>Intellectual property</h2>
<p>Website design, copy, illustrations and code are owned by {$name} or its licensors unless a project agreement says otherwise. Client materials remain the client’s.</p>
<h2>No guaranteed results</h2>
<p>Marketing and SEO outcomes depend on budget, market, offer, creative, website quality and follow-up. We do not guarantee rankings, lead volume or revenue.</p>
<h2>Acceptable use</h2>
<p>Do not misuse the site, attempt to disrupt it, or submit unlawful, misleading or abusive content.</p>
<h2>Liability</h2>
<p>To the extent permitted by law, we are not liable for indirect or consequential loss arising from website use. Nothing excludes liability that cannot legally be excluded.</p>
<h2>Governing law</h2>
<p>These terms are governed by the laws of India. Courts in India shall have jurisdiction, unless a later contract specifies otherwise.</p>
HTML,
    ],
    'cookie-policy' => [
        'title' => 'Cookie Policy',
        'lead' => 'How this website uses cookies and similar technologies.',
        'html' => <<<HTML
<p>Cookies are small files stored on your device. We use them only as needed for the site to work, and for measurement when analytics or ads tags are enabled in configuration.</p>
<h2>Essential</h2>
<p>Session cookies support form security (CSRF protection) and basic site function.</p>
<h2>Analytics and advertising</h2>
<p>Google Analytics, Google Tag Manager, Google Ads and Meta Pixel scripts load only if their IDs are set in <code>includes/config.php</code>. Until then, those cookies are not set by us.</p>
<h2>Chatbot</h2>
<p>The on-site assistant runs in your browser. It does not require a marketing cookie to open.</p>
<h2>Control</h2>
<p>You can block cookies in your browser. Essential cookies may be required for forms to work correctly.</p>
HTML,
    ],
    'disclaimer' => [
        'title' => 'Disclaimer',
        'lead' => 'Important limits on website content and marketing claims.',
        'html' => <<<HTML
<p>{$name} provides digital growth services. Website content is informational. It is not legal, financial or professional advice for a specific business unless we have a signed engagement.</p>
<h2>Results</h2>
<p>Case studies describe process and operating change. They are not a promise that your business will achieve the same outcome. We do not publish invented testimonials or fake ratings.</p>
<h2>Third parties</h2>
<p>Google, Meta, WhatsApp and other platforms have their own terms, policies and algorithm changes. We do not control those platforms.</p>
<h2>External links</h2>
<p>Links to other sites are provided for convenience. We are not responsible for their content.</p>
<h2>Configuration</h2>
<p>Contact details, WhatsApp numbers and analytics IDs must be completed by the site owner before public advertising. Placeholder values are not real contact points.</p>
HTML,
    ],
];
