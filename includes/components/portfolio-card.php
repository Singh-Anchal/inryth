<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$item = $item ?? [];
$tags = implode(' ', $item['filters'] ?? []);
?>
<article class="card-premium" data-item="<?= e($tags) ?>">
    <div class="portfolio-thumb">
        <img src="<?= e(asset($item['image'])) ?>" width="640" height="400" alt="<?= e($item['name']) ?>" loading="lazy">
    </div>
    <span class="chip"><?= e($item['industry']) ?></span>
    <h3 class="mt-3"><?= e($item['name']) ?></h3>
    <p><?= e($item['result']) ?></p>
    <div class="card-meta">
        <?php foreach ($item['services'] as $svc): ?>
            <span class="chip"><?= e($svc) ?></span>
        <?php endforeach; ?>
    </div>
    <p class="mt-3 mb-0"><a class="fw-bold" href="<?= e(url($item['url'])) ?>" data-track="portfolio_view" data-track-label="<?= e($item['slug']) ?>">View project →</a></p>
</article>
