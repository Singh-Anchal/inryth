<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<div class="mobile-sticky" role="navigation" aria-label="Quick actions">
    <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'mobile-sticky')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="mobile-sticky">WhatsApp</a>
    <a class="btn" href="<?= e(url('/contact')) ?>" data-track="consultation_click" data-track-label="mobile-sticky">Get Quote</a>
</div>
