<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Looks like this page took a wrong turn.',
    'lead' => 'The link may be outdated. You can go home, browse services, or talk to us on WhatsApp.',
    'actions' => [
        ['label' => 'Go Home', 'href' => '/'],
        ['label' => 'Explore Services', 'href' => '/services', 'class' => 'btn-secondary'],
        ['label' => 'WhatsApp Us', 'href' => generateWhatsAppLink(null, '404'), 'class' => 'btn-whatsapp', 'external' => true],
    ],
]); ?>
<section class="section">
    <div class="container-site">
        <div class="row g-3">
            <div class="col-md-4"><a class="card-link" href="<?= e(url('/services/website-design')) ?>"><article class="card-premium"><h3>Website Design</h3><p>Sites built to generate enquiries.</p></article></a></div>
            <div class="col-md-4"><a class="card-link" href="<?= e(url('/services/google-ads')) ?>"><article class="card-premium"><h3>Google Ads</h3><p>Campaigns with landing pages and tracking.</p></article></a></div>
            <div class="col-md-4"><a class="card-link" href="<?= e(url('/services/whatsapp-automation')) ?>"><article class="card-premium"><h3>WhatsApp Automation</h3><p>Follow-up that does not wait until morning.</p></article></a></div>
        </div>
    </div>
</section>
