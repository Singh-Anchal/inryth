<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/bootstrap.php';
$item = prepare_case_study_page('ads-to-landing-to-whatsapp');
require INCLUDES_PATH . '/header.php';
render_template('case-study', ['item' => $item]);
require INCLUDES_PATH . '/footer.php';
