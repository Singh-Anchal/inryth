<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
apply_page('portfolio');
require INCLUDES_PATH . '/header.php';
render_template('portfolio');
require INCLUDES_PATH . '/footer.php';
