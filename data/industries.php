<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

return [
    [
        'slug' => 'real-estate',
        'name' => 'Real Estate',
        'icon' => 'buildings',
        'excerpt' => 'Project pages, site-visit enquiries and WhatsApp conversations for property businesses.',
        'needs' => ['Project websites', 'Lead forms', 'Meta & Google Ads', 'WhatsApp qualification'],
    ],
    [
        'slug' => 'healthcare',
        'name' => 'Healthcare',
        'icon' => 'heart-pulse',
        'excerpt' => 'Clear service pages, appointment intent and trustworthy mobile experiences for clinics.',
        'needs' => ['Clinic websites', 'Local SEO', 'Appointment WhatsApp', 'Patient FAQs'],
    ],
    [
        'slug' => 'education',
        'name' => 'Education',
        'icon' => 'mortarboard',
        'excerpt' => 'Admissions landing pages, counsellor follow-up and campaign tracking for institutes and coaches.',
        'needs' => ['Admissions pages', 'Meta Ads', 'Counsellor routing', 'Brochure flows'],
    ],
    [
        'slug' => 'ecommerce',
        'name' => 'E-commerce',
        'icon' => 'bag',
        'excerpt' => 'Storefronts, performance creative and remarketing that support purchase, not only traffic.',
        'needs' => ['Store websites', 'Product creatives', 'Remarketing', 'WhatsApp support'],
    ],
    [
        'slug' => 'travel',
        'name' => 'Travel',
        'icon' => 'airplane',
        'excerpt' => 'Package pages, enquiry capture and fast chat follow-up for travel brands.',
        'needs' => ['Package landing pages', 'Ads', 'Itinerary delivery', 'Lead tracking'],
    ],
    [
        'slug' => 'hospitality',
        'name' => 'Hospitality',
        'icon' => 'cup-hot',
        'excerpt' => 'Stay-focused websites and WhatsApp booking conversations for hotels and experiences.',
        'needs' => ['Property websites', 'Offer pages', 'WhatsApp booking', 'Local visibility'],
    ],
    [
        'slug' => 'professional-services',
        'name' => 'Professional Services',
        'icon' => 'briefcase',
        'excerpt' => 'Authority websites, search visibility and organised inbound for firms and consultants.',
        'needs' => ['Corporate websites', 'SEO', 'Consultation booking', 'CRM hygiene'],
    ],
    [
        'slug' => 'local-businesses',
        'name' => 'Local Businesses',
        'icon' => 'geo-alt',
        'excerpt' => 'Service pages, Google Business alignment and click-to-call or WhatsApp paths.',
        'needs' => ['Local SEO', 'Service pages', 'Google Ads', 'Mobile CTAs'],
    ],
    [
        'slug' => 'startups',
        'name' => 'Startups',
        'icon' => 'rocket-takeoff',
        'excerpt' => 'Launch websites, analytics and a first demand channel without overbuilding.',
        'needs' => ['Launch websites', 'Demo/waitlist', 'Analytics', 'Early ads tests'],
    ],
    [
        'slug' => 'personal-brands',
        'name' => 'Personal Brands',
        'icon' => 'person-badge',
        'excerpt' => 'Consistent brand, content-to-lead paths and campaign pages for coaches and founders.',
        'needs' => ['Personal sites', 'Creatives', 'Lead magnets', 'WhatsApp consults'],
    ],
];
