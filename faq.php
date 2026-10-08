<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
apply_page('faq');
$all = [];
foreach (load_data('faqs') as $set) {
    $all = array_merge($all, $set);
}
$schema_extra[] = faq_schema($all);
require INCLUDES_PATH . '/header.php';
render_template('faq');
require INCLUDES_PATH . '/footer.php';
