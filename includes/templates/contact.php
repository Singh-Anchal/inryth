<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Contact Inryth',
    'lead' => 'Share a short brief. We will tell you the most useful next step — and if we are not the right fit, we will say so.',
    'actions' => [
        ['label' => 'WhatsApp Us', 'href' => generateWhatsAppLink(null, 'contact-hero'), 'class' => 'btn-whatsapp', 'external' => true],
    ],
]); ?>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-7">
                <?php render('lead-form'); ?>
            </div>
            <div class="col-lg-5">
                <div class="card-premium mb-3">
                    <h2 class="h5">Talk to us</h2>
                    <?php if (config('email')): ?>
                        <p><a href="mailto:<?= e(config('email')) ?>" data-track="email_click"><?= e(config('email')) ?></a></p>
                    <?php else: ?>
                        <p class="text-muted">Add your email in <code>includes/config.php</code> to show it here.</p>
                    <?php endif; ?>
                    <?php if (config('phone')): ?>
                        <p><a href="tel:<?= e(preg_replace('/\s+/', '', (string) config('phone'))) ?>" data-track="phone_click"><?= e(config('phone')) ?></a></p>
                    <?php endif; ?>
                    <p><a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'contact-aside')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click">Continue on WhatsApp</a></p>
                    <p class="mb-0"><strong>Hours:</strong> <?= e(config('business_hours')) ?><br><?= e(config('response_time')) ?></p>
                </div>
                <div class="card-premium mb-3">
                    <h2 class="h5">Service area</h2>
                    <p class="mb-0">We work with businesses across <?= e(config('service_area')) ?>. A street address and map appear here only when a real location is added in configuration.</p>
                </div>
                <?php if (config('map_embed') && config('address')): ?>
                    <div class="card-premium p-0 overflow-hidden">
                        <iframe title="Business location" src="<?= e(config('map_embed')) ?>" width="100%" height="240" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <h2 class="section-title">Before you write</h2>
        <?php render('faq-accordion', ['faqs' => load_data('faqs')['general'], 'id' => 'contact-faq']); ?>
    </div>
</section>
