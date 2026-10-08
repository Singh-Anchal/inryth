<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Digital products and solutions.',
    'lead' => 'Ready systems we implement for Indian businesses — websites, landing pages, WhatsApp kits and lead pipelines. This is not a self-serve store.',
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-4">
            <?php foreach (load_data('products') as $product): ?>
                <div class="col-md-6"><?php render('product-card', ['product' => $product]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php render('cta-section', ['title' => 'Need a custom system instead of a product?']); ?>
