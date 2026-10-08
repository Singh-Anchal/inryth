<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/bootstrap.php';
$product = prepare_product_page('whatsapp-growth-kit');
require INCLUDES_PATH . '/header.php';
render_template('product', ['product' => $product]);
require INCLUDES_PATH . '/footer.php';
