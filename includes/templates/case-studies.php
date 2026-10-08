<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Case studies: how the system is assembled.',
    'lead' => 'These stories focus on challenge, strategy and operating change. Where we did not have a clean baseline, we do not invent a result.',
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-4">
            <?php foreach (load_data('case-studies') as $study): ?>
                <div class="col-md-4"><?php render('case-study-card', ['study' => $study]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php render('cta-section'); ?>
