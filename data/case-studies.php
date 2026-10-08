<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

return [
    [
        'slug' => 'service-business-growth-system',
        'name' => 'Service Business Growth System',
        'client' => 'Professional services firm',
        'industry' => 'Professional Services',
        'summary' => 'Connected a new website, enquiry forms and WhatsApp follow-up so inbound interest stopped living in unread chats.',
        'image' => 'images/case-studies/service-growth.svg',
        'url' => '/case-studies/service-business-growth-system',
        'challenge' => 'The firm received referrals and occasional website visits, but the site did not explain services clearly. Enquiries arrived as incomplete WhatsApp messages and were easy to miss.',
        'strategy' => 'Treat the website as the first sales conversation: clarify offers, add proof, and make the next step obvious. Then make sure every enquiry creates a tracked conversation.',
        'implementation' => [
            'Rebuilt the information architecture around services and industries served.',
            'Added short enquiry forms with service and timeline fields.',
            'Connected form submits to WhatsApp with a useful pre-filled message.',
            'Set a simple lead stage list for the team to update.',
        ],
        'technology' => ['Custom PHP website', 'Lead forms', 'WhatsApp click-to-chat', 'Analytics events'],
        'marketing' => 'Organic and referral traffic first. The site was prepared so Google Ads could be added later without sending people to a weak homepage.',
        'outcome' => 'The team now receives more complete enquiries and can see which pages start conversations. Follow-up is assigned instead of assumed. We do not claim a percentage lift because the starting measurement was incomplete.',
        'whatsapp_message' => 'Hi, I read the service business growth system case study and want something similar.',
        'related_services' => ['website-design', 'whatsapp-automation', 'lead-management'],
    ],
    [
        'slug' => 'ads-to-landing-to-whatsapp',
        'name' => 'Ads to Landing Page to WhatsApp',
        'client' => 'Education counsellor practice',
        'industry' => 'Education',
        'summary' => 'Moved ad traffic off a large website onto a single intake landing page with counsellor handoff on WhatsApp.',
        'image' => 'images/case-studies/ads-landing.svg',
        'url' => '/case-studies/ads-to-landing-to-whatsapp',
        'challenge' => 'Meta Ads were running to the homepage. Parents had to hunt for intake details. Counsellors could not tell which campaign a chat came from.',
        'strategy' => 'One campaign, one offer, one page. Match the ad promise on the landing page and continue the conversation on WhatsApp with context.',
        'implementation' => [
            'Wrote a landing page for a single intake offer.',
            'Shortened the form to the fields counsellors actually use.',
            'Added WhatsApp as a parallel CTA with a campaign-specific message.',
            'Implemented thank-you and click events for future ads optimisation.',
        ],
        'technology' => ['Landing page', 'Form handler', 'WhatsApp deep links', 'Event tracking hooks'],
        'marketing' => 'Creative and copy were aligned to the same offer. Retargeting was planned only after the first destination converted cleanly.',
        'outcome' => 'Counsellors started conversations with more context (intake, city, timeline). Campaign review became possible because the destination was specific. Results are discussed in terms of lead completeness, not inflated growth percentages.',
        'whatsapp_message' => 'Hi, I want an ads-to-landing-page-to-WhatsApp system like your case study.',
        'related_services' => ['meta-ads', 'website-design', 'whatsapp-automation'],
    ],
    [
        'slug' => 'local-visibility-rebuild',
        'name' => 'Local Visibility Rebuild',
        'client' => 'Multi-service local business',
        'industry' => 'Local Businesses',
        'summary' => 'Replaced a thin one-page site with service pages, local SEO foundations and a usable enquiry path.',
        'image' => 'images/case-studies/local-seo.svg',
        'url' => '/case-studies/local-visibility-rebuild',
        'challenge' => 'The business offered several services but had one short homepage. Search visibility was weak, and the Google Business Profile pointed to a page that did not match the listing.',
        'strategy' => 'Give each important service a real page, fix basic technical SEO, and make phone/WhatsApp actions obvious on mobile.',
        'implementation' => [
            'Keyword mapping to existing and new service pages.',
            'On-page titles, headings, internal links and FAQ blocks.',
            'Performance cleanup: image weight, mobile layout, tap targets.',
            'Alignment between website NAP details and local listings.',
        ],
        'technology' => ['PHP pages', 'Schema (Service, FAQ, Organization)', 'Search Console setup notes'],
        'marketing' => 'SEO first. Paid search was recommended only after landing pages existed for the highest-intent services.',
        'outcome' => 'The business now has pages that can be found, shared and advertised. Owners can see which services attract enquiries. Ranking claims are avoided until a full measurement window exists.',
        'whatsapp_message' => 'Hi, I need a local SEO and service-page rebuild like your case study.',
        'related_services' => ['seo', 'website-design', 'google-ads'],
    ],
];
