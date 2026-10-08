<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/bootstrap.php';
$article = prepare_article_page('google-ads-need-landing-pages');
require INCLUDES_PATH . '/header.php';
render_template('article', ['article' => $article]);
require INCLUDES_PATH . '/footer.php';
