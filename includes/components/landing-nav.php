<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<nav class="landing-nav">
    <div class="container-site d-flex justify-content-between align-items-center">
        <a class="brand" href="<?= e(url('/')) ?>">
            <img class="brand-mark" src="<?= e(asset('images/logo.svg')) ?>?v=2" width="34" height="34" alt="">
            <span><?= e(config('site_name')) ?></span>
        </a>
        <div class="d-flex gap-2">
            <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'landing-nav')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="landing-nav">WhatsApp</a>
            <a class="btn d-none d-sm-inline-flex" href="#lead-form" data-track="consultation_click" data-track-label="landing-nav">Get a plan</a>
        </div>
    </div>
</nav>
