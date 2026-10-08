<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$service = $service ?? [];
$faqs_all = load_data('faqs');
$faqs = $faqs_all[$service['faq_group'] ?? 'general'] ?? $faqs_all['general'];
?>
<section class="hero">
    <div class="container-site">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <p class="section-kicker"><?= e($service['name']) ?> for Indian businesses</p>
                <h1><?= e($service['hero']) ?></h1>
                <p class="lead"><?= e($service['intro']) ?></p>
                <div class="btn-group">
                    <a class="btn" href="#lead-form"><?= e($service['cta']) ?></a>
                    <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink($service['whatsapp_message'], 'landing-hero')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click">WhatsApp Us</a>
                </div>
            </div>
            <div class="col-lg-6" id="lead-form">
                <?php render('lead-form', ['type' => str_contains($service['slug'], 'website') ? 'website' : 'marketing', 'prefill_service' => $service['slug']]); ?>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <div class="row g-4">
            <div class="col-lg-6">
                <h2 class="section-title">What’s going wrong</h2>
                <p class="text-muted"><?= e($service['problem']) ?></p>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">What we put in place</h2>
                <p class="text-muted"><?= e($service['solution']) ?></p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <h2 class="section-title">The process</h2>
        <div class="workflow">
            <?php foreach ($service['process'] as $i => $step): ?>
                <div class="workflow-step">
                    <div class="workflow-dot"><?= $i + 1 ?></div>
                    <div>
                        <strong><?= e($step['title']) ?></strong>
                        <p class="mb-0 text-muted"><?= e($step['text']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <h2 class="section-title">What you can expect from the work</h2>
        <div class="row g-3">
            <?php foreach ($service['benefits'] as $item): ?>
                <div class="col-md-6"><div class="card-premium"><p class="mb-0"><?= e($item) ?></p></div></div>
            <?php endforeach; ?>
        </div>
        <p class="text-muted mt-4 mb-0">We do not publish invented performance percentages. Proof is discussed against your current baseline after we see the account or website.</p>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="section-title">Common questions</h2>
                <a class="btn mt-2" href="#lead-form"><?= e($service['cta']) ?></a>
            </div>
            <div class="col-lg-7">
                <?php render('faq-accordion', ['faqs' => $faqs, 'id' => 'landing-faq']); ?>
            </div>
        </div>
    </div>
</section>

<?php render('cta-section', [
    'title' => $service['cta'],
    'cta' => $service['cta'],
    'cta_href' => '#lead-form',
]); ?>
