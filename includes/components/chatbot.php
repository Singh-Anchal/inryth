<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<div class="chatbot-root" data-chatbot data-config-url="<?= e(url('/api/bot-config')) ?>">
    <button class="chatbot-toggle" type="button" data-chatbot-toggle aria-expanded="false" aria-controls="chatbot-panel" aria-label="Open chat assistant">
        <i class="bi bi-chat-dots" aria-hidden="true"></i>
    </button>
    <div class="chatbot-panel" id="chatbot-panel" data-chatbot-panel aria-hidden="true" role="dialog" aria-label="Digital growth assistant">
        <div class="chatbot-head">
            <strong>Inryth Assistant</strong>
            <button type="button" class="btn btn-ghost" style="min-height:36px;padding:6px 10px;" data-chatbot-close aria-label="Close chat">Close</button>
        </div>
        <div class="chatbot-messages" data-chatbot-messages></div>
        <div class="chatbot-actions" data-chatbot-actions></div>
    </div>
</div>
