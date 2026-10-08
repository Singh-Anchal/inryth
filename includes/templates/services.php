<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$services = load_data('services');
$groups = [
    'Marketing' => ['digital-marketing', 'google-ads', 'meta-ads', 'seo'],
    'Websites' => ['website-design'],
    'Creative' => ['graphic-design'],
    'Automation' => ['whatsapp-automation', 'lead-management', 'ai-automation'],
];
?>
<?php render('page-hero', [
    'title' => 'Services that connect into one growth system.',
    'lead' => 'Each service can stand alone. They work better when the website, campaigns and follow-up are planned together.',
    'actions' => [
        ['label' => 'Get Free Consultation', 'href' => '/contact'],
        ['label' => 'WhatsApp Us', 'href' => generateWhatsAppLink(null, 'services-index'), 'class' => 'btn-whatsapp', 'external' => true],
    ],
]); ?>
<section class="section">
    <div class="container-site">
        <?php foreach ($groups as $group => $slugs): ?>
            <h2 class="section-title mt-4"><?= e($group) ?></h2>
            <div class="row g-3 mb-4">
                <?php foreach ($slugs as $slug): $service = get_service($slug); if (!$service) continue; ?>
                    <div class="col-md-6 col-lg-3"><?php render('service-card', ['service' => $service]); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php render('cta-section', ['title' => 'Not sure where to start? Tell us the bottleneck.']); ?>
