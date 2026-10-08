<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$item = $item ?? [];
?>
<?php render('page-hero', [
    'title' => $item['name'],
    'lead' => $item['excerpt'],
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="portfolio-thumb mb-4">
                    <img src="<?= e(asset($item['image'])) ?>" width="960" height="600" alt="<?= e($item['name']) ?>">
                </div>
                <h2>Challenge</h2>
                <p class="text-muted"><?= e($item['challenge']) ?></p>
                <h2>Approach</h2>
                <p class="text-muted"><?= e($item['approach']) ?></p>
                <h2>Outcome</h2>
                <p class="text-muted"><?= e($item['outcome']) ?></p>
            </div>
            <div class="col-lg-5">
                <aside class="card-premium">
                    <p><strong>Industry</strong><br><?= e($item['industry']) ?></p>
                    <p><strong>Services</strong><br><?= e(implode(', ', $item['services'])) ?></p>
                    <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink($item['whatsapp_message'], 'portfolio-detail')) ?>" target="_blank" rel="noopener">Discuss a similar project</a>
                </aside>
            </div>
        </div>
    </div>
</section>
<?php render('cta-section', ['title' => 'Want a similar enquiry path for your business?']); ?>
