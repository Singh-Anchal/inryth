<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

/**
 * Configuration-driven chatbot flows.
 * UI reads this via /api/bot-config.php. Logic stays out of HTML.
 */
return [
    'name' => 'Inryth Assistant',
    'welcome' => 'Hi! I\'m your digital growth assistant. What would you like help with today?',
    'offline' => 'I can help you explore options here, or you can continue with the team on WhatsApp.',
    'quick_replies' => [
        ['id' => 'services', 'label' => 'Explore Services'],
        ['id' => 'products', 'label' => 'View Products'],
        ['id' => 'website', 'label' => 'Get Website Quote'],
        ['id' => 'ads', 'label' => 'Run Ads'],
        ['id' => 'whatsapp', 'label' => 'WhatsApp Automation'],
        ['id' => 'expert', 'label' => 'Talk to Expert'],
    ],
    'nodes' => [
        'services' => [
            'message' => 'Which area are you looking at?',
            'buttons' => [
                ['id' => 'website', 'label' => 'Website'],
                ['id' => 'digital-marketing', 'label' => 'Digital Marketing'],
                ['id' => 'google-ads', 'label' => 'Google Ads'],
                ['id' => 'meta-ads', 'label' => 'Meta Ads'],
                ['id' => 'seo', 'label' => 'SEO'],
                ['id' => 'whatsapp', 'label' => 'WhatsApp Automation'],
                ['id' => 'products', 'label' => 'Products'],
                ['id' => 'expert', 'label' => 'Talk to Expert'],
            ],
        ],
        'website' => [
            'message' => 'What do you need for the website?',
            'buttons' => [
                ['id' => 'website-new', 'label' => 'New Website'],
                ['id' => 'website-redesign', 'label' => 'Redesign'],
                ['id' => 'website-landing', 'label' => 'Landing Page'],
                ['id' => 'website-ecom', 'label' => 'E-commerce'],
            ],
        ],
        'website-new' => [
            'message' => 'A new business website is a strong starting point. We can scope pages, enquiry paths and WhatsApp in one project.',
            'cta' => true,
            'link' => '/services/website-design',
            'link_label' => 'See website services',
        ],
        'website-redesign' => [
            'message' => 'Redesigns work best when we first identify why the current site is not generating enquiries.',
            'cta' => true,
            'link' => '/contact?service=website-design&form=website',
            'link_label' => 'Request a website review',
        ],
        'website-landing' => [
            'message' => 'Landing pages should match one ad or offer. We can build that as a page or as the Conversion Landing System.',
            'cta' => true,
            'link' => '/products/conversion-landing-system',
            'link_label' => 'View landing system',
        ],
        'website-ecom' => [
            'message' => 'E-commerce needs a clear catalogue, mobile checkout path and remarketing readiness. Tell us what you sell and we will recommend the right build.',
            'cta' => true,
            'link' => '/contact?service=website-design&form=website',
            'link_label' => 'Get an e-commerce quote',
        ],
        'digital-marketing' => [
            'message' => 'Digital marketing at Inryth means a system: traffic, converting pages and follow-up. Which channel is the priority?',
            'buttons' => [
                ['id' => 'google-ads', 'label' => 'Google Ads'],
                ['id' => 'meta-ads', 'label' => 'Meta Ads'],
                ['id' => 'seo', 'label' => 'SEO'],
                ['id' => 'expert', 'label' => 'Talk to Expert'],
            ],
        ],
        'google-ads' => [
            'message' => 'We manage Search, Display, Performance Max and remarketing with landing pages and conversion tracking.',
            'cta' => true,
            'link' => '/services/google-ads',
            'link_label' => 'See Google Ads',
        ],
        'meta-ads' => [
            'message' => 'Meta Ads work when creative, offer and follow-up are planned together. We can map Facebook and Instagram campaigns to WhatsApp or your CRM.',
            'cta' => true,
            'link' => '/services/meta-ads',
            'link_label' => 'See Meta Ads',
        ],
        'seo' => [
            'message' => 'SEO starts with an audit: technical health, service pages and local visibility. We can review your current site first.',
            'cta' => true,
            'link' => '/services/seo',
            'link_label' => 'See SEO services',
        ],
        'ads' => [
            'message' => 'Are you looking at search ads, social ads, or both?',
            'buttons' => [
                ['id' => 'google-ads', 'label' => 'Google Ads'],
                ['id' => 'meta-ads', 'label' => 'Meta Ads'],
                ['id' => 'digital-marketing', 'label' => 'Full marketing plan'],
            ],
        ],
        'whatsapp' => [
            'message' => 'WhatsApp automation can welcome leads, qualify them, send brochures and route chats to your team.',
            'cta' => true,
            'link' => '/services/whatsapp-automation',
            'link_label' => 'See WhatsApp automation',
        ],
        'products' => [
            'message' => 'These are ready systems we implement for you — not a self-serve app store.',
            'buttons' => [
                ['id' => 'product-website', 'label' => 'Business Website System'],
                ['id' => 'product-landing', 'label' => 'Landing System'],
                ['id' => 'product-wa', 'label' => 'WhatsApp Growth Kit'],
                ['id' => 'product-leads', 'label' => 'LeadFlow'],
            ],
        ],
        'product-website' => [
            'message' => 'The Business Website System is a conversion-ready site architecture for service businesses.',
            'cta' => true,
            'link' => '/products/business-website-system',
            'link_label' => 'View product',
        ],
        'product-landing' => [
            'message' => 'The Conversion Landing System is built for Google Ads and Meta Ads destinations.',
            'cta' => true,
            'link' => '/products/conversion-landing-system',
            'link_label' => 'View product',
        ],
        'product-wa' => [
            'message' => 'The WhatsApp Growth Kit covers welcome flows, qualification and sales handoff.',
            'cta' => true,
            'link' => '/products/whatsapp-growth-kit',
            'link_label' => 'View product',
        ],
        'product-leads' => [
            'message' => 'LeadFlow organises capture, assignment and follow-up across website and WhatsApp.',
            'cta' => true,
            'link' => '/products/leadflow-system',
            'link_label' => 'View product',
        ],
        'pricing' => [
            'message' => 'We do not publish one-size prices because scope changes by pages, ads workload and integrations. Share a few details and we will propose honestly.',
            'cta' => true,
            'link' => '/contact',
            'link_label' => 'Request a proposal',
        ],
        'expert' => [
            'message' => 'Would you like a quick consultation?',
            'buttons' => [
                ['id' => 'consult-yes', 'label' => 'Yes'],
                ['id' => 'consult-wa', 'label' => 'WhatsApp'],
                ['id' => 'consult-later', 'label' => 'Later'],
            ],
        ],
        'consult-yes' => [
            'message' => 'Share a few details on the consultation form. We will review and get back during business hours.',
            'cta' => true,
            'link' => '/contact?form=marketing',
            'link_label' => 'Book consultation',
        ],
        'consult-wa' => [
            'message' => 'Continue on WhatsApp and tell us what you sell and what you need help with first.',
            'whatsapp' => true,
            'whatsapp_label' => 'Chat on WhatsApp',
        ],
        'consult-later' => [
            'message' => 'No problem. You can browse services or products and come back when you are ready.',
            'buttons' => [
                ['id' => 'services', 'label' => 'Explore Services'],
                ['id' => 'products', 'label' => 'View Products'],
            ],
        ],
    ],
];
