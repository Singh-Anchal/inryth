<?php
/**
 * Future AI message endpoint.
 * Keep UI, bot logic and API separate. Wire an LLM provider here later.
 * Never put API keys in frontend JavaScript.
 */
declare(strict_types=1);
require_once dirname(__DIR__) . '/includes/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['ok' => false, 'message' => 'POST only'], 405);
}

json_response([
    'ok' => true,
    'mode' => 'rules',
    'message' => 'AI replies are not enabled yet. Use the guided buttons or WhatsApp.',
]);
