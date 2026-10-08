<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Industries we help grow.',
    'lead' => 'The system changes by industry. The job does not: make it easy to enquire and easy to follow up. Dedicated industry landing pages can be added when there is unique content.',
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-3">
            <?php foreach (load_data('industries') as $industry): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card-premium" id="<?= e($industry['slug']) ?>">
                        <div class="icon-wrap"><i class="bi bi-<?= e($industry['icon']) ?>"></i></div>
                        <h2 class="h4"><?= e($industry['name']) ?></h2>
                        <p><?= e($industry['excerpt']) ?></p>
                        <div class="card-meta">
                            <?php foreach ($industry['needs'] as $need): ?><span class="chip"><?= e($need) ?></span><?php endforeach; ?>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php render('cta-section', ['title' => 'Tell us your industry and the current bottleneck.']); ?>
