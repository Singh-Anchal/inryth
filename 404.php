<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
apply_page('404');
http_response_code(404);
require INCLUDES_PATH . '/header.php';
render_template('error-404');
require INCLUDES_PATH . '/footer.php';
