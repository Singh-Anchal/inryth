<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/includes/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=300');

$bot = load_data('chatbot');
$bot['whatsapp'] = generateWhatsAppLink('Hi, I would like to talk to an expert about digital growth.', 'chatbot');
echo json_encode($bot, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
