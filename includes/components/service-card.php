<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$service = $service ?? [];
?>
<a class="card-link" href="<?= e(url($service['url'])) ?>">
    <article class="card-premium">
        <div class="icon-wrap"><i class="bi bi-<?= e($service['icon'] === 'whatsapp' ? 'whatsapp' : ($service['icon'] === 'google' ? 'search' : ($service['icon'] === 'meta' ? 'badge-ad' : $service['icon']))) ?>"></i></div>
        <h3><?= e($service['name']) ?></h3>
        <p><?= e($service['excerpt']) ?></p>
        <p class="mt-3 mb-0 fw-bold text-primary">Learn more →</p>
    </article>
</a>
