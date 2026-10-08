<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$product = $product ?? [];
?>
<?php render('page-hero', [
    'title' => $product['hero'],
    'lead' => $product['excerpt'],
    'actions' => [
        ['label' => 'Enquire on WhatsApp', 'href' => generateWhatsAppLink($product['whatsapp_message'], 'product-hero'), 'class' => 'btn-whatsapp', 'external' => true],
        ['label' => 'Request a walkthrough', 'href' => '/contact?service=products', 'class' => 'btn-secondary'],
    ],
]); ?>

<section class="section">
    <div class="container-site">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="product-thumb" style="aspect-ratio:16/10;margin:0;">
                    <img src="<?= e(asset($product['image'])) ?>" width="800" height="500" alt="<?= e($product['name']) ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="chip"><?= e($product['category']) ?></span>
                <h2 class="h3 mt-3">The problem</h2>
                <p class="text-muted"><?= e($product['problem']) ?></p>
                <h2 class="h3">The solution</h2>
                <p class="text-muted mb-0"><?= e($product['solution']) ?></p>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="section-title">Features</h2>
                <ul><?php foreach ($product['features'] as $f): ?><li><?= e($f) ?></li><?php endforeach; ?></ul>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Benefits</h2>
                <ul><?php foreach ($product['benefits'] as $f): ?><li><?= e($f) ?></li><?php endforeach; ?></ul>
                <h3 class="h5 mt-4">Who it’s for</h3>
                <div class="card-meta">
                    <?php foreach ($product['ideal_for'] as $who): ?><span class="chip"><?= e($who) ?></span><?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <h2 class="section-title">How it works</h2>
        <div class="workflow">
            <?php foreach ($product['how_it_works'] as $i => $step): ?>
                <div class="workflow-step">
                    <div class="workflow-dot"><?= $i + 1 ?></div>
                    <div><p class="mb-0"><?= e($step) ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <h2 class="section-title">Screenshots</h2>
        <p class="text-muted">Product UI previews. Replace these illustrations with real captures before a public launch.</p>
        <div class="row g-3">
            <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="col-md-4">
                    <div class="product-thumb">
                        <img src="<?= e(asset($product['image'])) ?>" width="640" height="400" alt="<?= e($product['name']) ?> preview <?= $i + 1 ?>" loading="lazy">
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="section-title">Questions</h2>
                <a class="btn btn-whatsapp mt-2" href="<?= e(generateWhatsAppLink($product['whatsapp_message'], 'product-faq')) ?>" target="_blank" rel="noopener" data-track="product_enquiry">Enquire on WhatsApp</a>
            </div>
            <div class="col-lg-7">
                <?php render('faq-accordion', ['faqs' => $product['faq'], 'id' => 'product-faq']); ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($product['related_services'])): ?>
<section class="section section-light">
    <div class="container-site">
        <h2 class="section-title">Pair this with</h2>
        <div class="row g-3">
            <?php foreach (related_services($product['related_services']) as $item): ?>
                <div class="col-md-4"><?php render('service-card', ['service' => $item]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php render('cta-section', [
    'title' => 'See if this system fits your operation.',
    'cta' => 'Request a walkthrough',
    'cta_href' => '/contact?service=products',
]); ?>
