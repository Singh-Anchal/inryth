<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$product = $product ?? [];
?>
<article class="card-premium">
    <div class="product-thumb">
        <img src="<?= e(asset($product['image'])) ?>" width="640" height="400" alt="<?= e($product['name']) ?>" loading="lazy">
    </div>
    <span class="chip"><?= e($product['category']) ?></span>
    <h3 class="mt-3"><?= e($product['name']) ?></h3>
    <p><?= e($product['excerpt']) ?></p>
    <div class="btn-group mt-3">
        <a class="btn" href="<?= e(url($product['url'])) ?>" data-track="product_view" data-track-label="<?= e($product['slug']) ?>">View Details</a>
        <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink($product['whatsapp_message'], 'product-card')) ?>" target="_blank" rel="noopener" data-track="product_enquiry" data-track-label="<?= e($product['slug']) ?>">Enquire on WhatsApp</a>
    </div>
</article>
