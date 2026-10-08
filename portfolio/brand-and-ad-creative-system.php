<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/bootstrap.php';
$item = prepare_portfolio_page('brand-and-ad-creative-system');
require INCLUDES_PATH . '/header.php';
render_template('portfolio-item', ['item' => $item]);
require INCLUDES_PATH . '/footer.php';
