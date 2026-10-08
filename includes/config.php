<?php
/**
 * Inryth site configuration.
 * Update contact, analytics and tracking IDs here. Never put secrets in frontend JS.
 */
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

return [
    'site_name' => 'Inryth',
    'legal_name' => 'Inryth',
    'site_tagline' => 'Build. Market. Automate. Grow.',
    'site_description' => 'Inryth is a digital growth partner for Indian businesses. We build converting websites, run performance marketing and automate lead follow-up on WhatsApp.',
    'site_url' => '', // Leave empty to auto-detect. Example: https://inryth.com
    'locale' => 'en_IN',
    'language' => 'en',
    'country' => 'IN',
    'service_area' => 'India',
    'founding_year' => '2024',

    // Contact — leave blank to hide that channel. Do not invent a street address.
    'whatsapp_number' => '919455047109',
    'phone' => '+91 94550 47109',
    'email' => 'info@inryth.com',
    'address' => 'Lucknow, Uttar Pradesh, India',
    'city' => 'Lucknow',
    'state' => 'Uttar Pradesh',
    'pincode' => '',
    'map_embed' => '',
    'business_hours' => '24/7 WhatsApp chat',
    'response_time' => 'We typically reply on WhatsApp the same day.',

    // Social — add only real profiles
    'social' => [
        'linkedin' => '',
        'instagram' => '',
        'facebook' => '',
        'x' => '',
        'youtube' => '',
    ],

    // Analytics — leave empty until IDs are issued
    'google_analytics_id' => '',
    'google_tag_manager_id' => '',
    'meta_pixel_id' => '',
    'google_ads_conversion_id' => '',
    'google_ads_conversion_label' => '',

    // Lead handling
    'lead_notify_email' => '',
    'lead_webhook_url' => '',
    'lead_storage' => true,
    'form_rate_limit' => 5,
    'form_rate_window' => 900,

    // Theme
    'og_image' => 'images/og-default.svg',
    'logo' => 'images/logo.svg',
    'favicon' => 'images/favicon.svg',
];
