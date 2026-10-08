<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$service = $service ?? [];
$faqs_all = load_data('faqs');
$faqs = $faqs_all[$service['faq_group'] ?? 'general'] ?? $faqs_all['general'];
$related = related_services($service['related'] ?? []);
$rel_products = related_products($service['products'] ?? []);
?>
<?php render('page-hero', [
    'title' => $service['hero'],
    'lead' => $service['intro'],
    'actions' => [
        ['label' => $service['cta'], 'href' => $service['cta_href']],
        ['label' => 'WhatsApp Us', 'href' => generateWhatsAppLink($service['whatsapp_message'], 'service-hero'), 'class' => 'btn-whatsapp', 'external' => true],
    ],
]); ?>

<section class="section">
    <div class="container-site">
        <div class="row g-4">
            <div class="col-lg-6">
                <article class="card-premium">
                    <p class="section-kicker">The problem</p>
                    <h2 class="h4"><?= e($service['problem']) ?></h2>
                </article>
            </div>
            <div class="col-lg-6">
                <article class="card-premium">
                    <p class="section-kicker">Our solution</p>
                    <h2 class="h4"><?= e($service['solution']) ?></h2>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="section-title">What this includes</h2>
                <ul>
                    <?php foreach ($service['includes'] as $item): ?>
                        <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Why businesses use this</h2>
                <ul>
                    <?php foreach ($service['benefits'] as $item): ?>
                        <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <?php render('section-header', ['kicker' => 'Process', 'title' => 'How the work unfolds.']); ?>
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
        <h2 class="section-title">Deliverables</h2>
        <div class="row g-3">
            <?php foreach ($service['deliverables'] as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-premium"><p class="mb-0"><?= e($item) ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if ($related): ?>
<section class="section">
    <div class="container-site">
        <h2 class="section-title">Often paired with</h2>
        <div class="row g-3">
            <?php foreach ($related as $item): ?>
                <div class="col-md-6 col-lg-3"><?php render('service-card', ['service' => $item]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($rel_products): ?>
<section class="section section-light">
    <div class="container-site">
        <h2 class="section-title">Related products</h2>
        <div class="row g-4">
            <?php foreach ($rel_products as $product): ?>
                <div class="col-md-6"><?php render('product-card', ['product' => $product]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="section-title">Questions we hear first</h2>
                <div class="btn-group mt-3">
                    <a class="btn" href="<?= e(url($service['cta_href'])) ?>"><?= e($service['cta']) ?></a>
                    <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink($service['whatsapp_message'], 'service-mid')) ?>" target="_blank" rel="noopener">Service enquiry</a>
                </div>
            </div>
            <div class="col-lg-7">
                <?php render('faq-accordion', ['faqs' => $faqs, 'id' => 'service-faq']); ?>
            </div>
        </div>
    </div>
</section>

<?php render('cta-section', [
    'title' => $service['cta'],
    'lead' => 'Share the current bottleneck. We will tell you whether this service is the right first move.',
    'cta' => $service['cta'],
    'cta_href' => $service['cta_href'],
]); ?>
