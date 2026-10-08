<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

/**
 * Placeholder testimonials. Replace with real client quotes before publishing socially.
 * Do not invent names, companies or results.
 */
return [
    [
        'status' => 'placeholder',
        'name' => 'Client name',
        'company' => 'Company',
        'industry' => 'Industry',
        'quote' => 'A short note from a real client will appear here once we have permission to publish it. We do not display invented reviews.',
    ],
    [
        'status' => 'placeholder',
        'name' => 'Client name',
        'company' => 'Company',
        'industry' => 'Industry',
        'quote' => 'When you have a verified testimonial, add it in data/testimonials.php. The layout is already conversion-ready.',
    ],
    [
        'status' => 'placeholder',
        'name' => 'Client name',
        'company' => 'Company',
        'industry' => 'Industry',
        'quote' => 'Until then, this section stays honest: structure without fake social proof.',
    ],
];
