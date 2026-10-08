<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
apply_page('disclaimer');
$docs = load_data('legal');
$doc = $docs['disclaimer'] ?? null;
if (!$doc) { not_found_and_exit(); }
require INCLUDES_PATH . '/header.php';
render_template('legal', ['doc' => $doc]);
require INCLUDES_PATH . '/footer.php';
