<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');

$urls = [
    '/',
    '/about',
    '/services',
    '/products',
    '/portfolio',
    '/case-studies',
    '/blog',
    '/contact',
    '/faq',
    '/industries',
    '/privacy-policy',
    '/terms-and-conditions',
    '/cookie-policy',
    '/disclaimer',
];

foreach (load_data('services') as $item) {
    $urls[] = $item['url'];
    if (!empty($item['landing'])) {
        $urls[] = '/landing/' . $item['slug'];
    }
}
foreach (load_data('products') as $item) {
    $urls[] = $item['url'];
}
foreach (load_data('portfolio') as $item) {
    $urls[] = $item['url'];
}
foreach (load_data('case-studies') as $item) {
    $urls[] = $item['url'];
}
foreach (load_data('blog') as $item) {
    $urls[] = $item['url'];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach (array_unique($urls) as $path) {
    echo '  <url><loc>' . e(url($path)) . '</loc><changefreq>weekly</changefreq></url>' . "\n";
}
echo '</urlset>';
