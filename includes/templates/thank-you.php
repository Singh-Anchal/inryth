<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Thank you. Your enquiry has been received.',
    'lead' => 'Our team will review your requirement and contact you shortly. If it is easier, continue the conversation on WhatsApp now.',
    'actions' => [
        ['label' => 'Continue on WhatsApp', 'href' => generateWhatsAppLink('Hi, I just submitted an enquiry on your website and would like to continue on WhatsApp.', 'thank-you'), 'class' => 'btn-whatsapp', 'external' => true],
        ['label' => 'Explore Services', 'href' => '/services', 'class' => 'btn-secondary'],
        ['label' => 'View Portfolio', 'href' => '/portfolio'],
    ],
]); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.InrythTrack) window.InrythTrack('form_submit', { status: 'thank_you' });
    <?php if (config('google_ads_conversion_id') && config('google_ads_conversion_label')): ?>
    if (typeof gtag === 'function') gtag('event', 'conversion', { send_to: <?= json_encode(config('google_ads_conversion_id') . '/' . config('google_ads_conversion_label')) ?> });
    <?php endif; ?>
});
</script>
