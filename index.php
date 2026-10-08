<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
apply_page('home');
$faqs = array_merge(load_data('faqs')['general'], load_data('faqs')['pricing']);
$schema_extra[] = faq_schema($faqs);
require INCLUDES_PATH . '/header.php';
render_template('home');
require INCLUDES_PATH . '/footer.php';
