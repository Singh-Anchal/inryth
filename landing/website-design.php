<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/bootstrap.php';
$service = prepare_service_page('website-design', true);
require INCLUDES_PATH . '/header.php';
render_template('landing', ['service' => $service]);
require INCLUDES_PATH . '/footer.php';
