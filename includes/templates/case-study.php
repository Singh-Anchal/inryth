<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$item = $item ?? [];
?>
<?php render('page-hero', [
    'title' => $item['name'],
    'lead' => $item['summary'],
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-4 mb-4">
            <div class="col-md-4"><div class="card-premium"><strong>Client / project</strong><p class="mb-0 text-muted"><?= e($item['client']) ?></p></div></div>
            <div class="col-md-4"><div class="card-premium"><strong>Industry</strong><p class="mb-0 text-muted"><?= e($item['industry']) ?></p></div></div>
            <div class="col-md-4"><div class="card-premium"><strong>Focus</strong><p class="mb-0 text-muted"><?= e(implode(', ', $item['technology'])) ?></p></div></div>
        </div>
        <h2>Business challenge</h2>
        <p class="text-muted"><?= e($item['challenge']) ?></p>
        <h2>Strategy</h2>
        <p class="text-muted"><?= e($item['strategy']) ?></p>
        <h2>Implementation</h2>
        <ul><?php foreach ($item['implementation'] as $row): ?><li><?= e($row) ?></li><?php endforeach; ?></ul>
        <h2>Technology</h2>
        <p class="text-muted"><?= e(implode(', ', $item['technology'])) ?></p>
        <h2>Marketing / automation</h2>
        <p class="text-muted"><?= e($item['marketing']) ?></p>
        <h2>Outcome</h2>
        <p class="text-muted"><?= e($item['outcome']) ?></p>
        <?php if (!empty($item['related_services'])): ?>
            <h2 class="mt-5">Related services</h2>
            <div class="row g-3">
                <?php foreach (related_services($item['related_services']) as $svc): ?>
                    <div class="col-md-4"><?php render('service-card', ['service' => $svc]); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="mt-4">
            <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink($item['whatsapp_message'], 'case-study')) ?>" target="_blank" rel="noopener">Talk about a similar system</a>
        </div>
    </div>
</section>
<?php render('cta-section'); ?>
