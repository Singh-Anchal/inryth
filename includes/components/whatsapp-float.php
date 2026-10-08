<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<a class="float-wa" href="<?= e(generateWhatsAppLink(null, 'float')) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp" data-track="whatsapp_click" data-track-label="float">
    <i class="bi bi-whatsapp" aria-hidden="true"></i>
</a>
