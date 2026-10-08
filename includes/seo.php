<?php
/**
 * SEO helpers: titles, canonicals, Open Graph, JSON-LD.
 */
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

function seo_title(): string
{
    global $page;
    $title = $page['title'] ?? config('site_name');
    $name = config('site_name');
    if ($title === $name || str_ends_with($title, ' | ' . $name) || str_ends_with($title, ' — ' . $name)) {
        return $title;
    }
    return $title . ' | ' . $name;
}

function canonical_url(): string
{
    global $page;
    $path = $page['canonical'] ?? current_path();
    if (str_starts_with($path, 'http')) {
        return $path;
    }
    return url($path);
}

function og_image_url(): string
{
    global $page;
    $image = $page['og_image'] ?? config('og_image');
    if (str_starts_with((string) $image, 'http')) {
        return $image;
    }
    return asset($image);
}

function breadcrumb_schema(array $crumbs): array
{
    $items = [];
    foreach ($crumbs as $i => $crumb) {
        $items[] = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $crumb['name'],
            'item' => str_starts_with($crumb['url'], 'http') ? $crumb['url'] : url($crumb['url']),
        ];
    }
    return [
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}

function organization_schema(): array
{
    $sameAs = array_values(array_filter(config('social', [])));
    $org = [
        '@type' => ['Organization', 'ProfessionalService'],
        '@id' => url('/') . '#organization',
        'name' => config('site_name'),
        'url' => url('/'),
        'logo' => asset(config('logo')),
        'description' => config('site_description'),
        'areaServed' => config('service_area'),
        'slogan' => config('site_tagline'),
    ];
    if (config('email')) {
        $org['email'] = config('email');
    }
    if (config('phone')) {
        $org['telephone'] = config('phone');
    }
    if ($sameAs) {
        $org['sameAs'] = $sameAs;
    }
    if (config('address') && config('city')) {
        $org['address'] = [
            '@type' => 'PostalAddress',
            'streetAddress' => config('address'),
            'addressLocality' => config('city'),
            'addressRegion' => config('state'),
            'postalCode' => config('pincode'),
            'addressCountry' => 'IN',
        ];
    }
    return $org;
}

function website_schema(): array
{
    return [
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => config('site_name'),
        'publisher' => ['@id' => url('/') . '#organization'],
        'inLanguage' => 'en-IN',
    ];
}

function service_schema(array $service): array
{
    return [
        '@type' => 'Service',
        'name' => $service['name'],
        'description' => $service['seo_description'] ?? $service['excerpt'],
        'provider' => ['@id' => url('/') . '#organization'],
        'areaServed' => 'IN',
        'serviceType' => $service['name'],
        'url' => url($service['url']),
    ];
}

function product_schema(array $product): array
{
    $schema = [
        '@type' => 'Product',
        'name' => $product['name'],
        'description' => $product['seo_description'] ?? $product['excerpt'],
        'brand' => ['@type' => 'Brand', 'name' => config('site_name')],
        'url' => url($product['url']),
        'image' => asset($product['image'] ?? config('og_image')),
        'category' => $product['category'] ?? 'Digital Product',
    ];
    if (!empty($product['price']) && empty($product['hide_price'])) {
        $schema['offers'] = [
            '@type' => 'Offer',
            'priceCurrency' => 'INR',
            'price' => $product['price'],
            'availability' => 'https://schema.org/InStock',
            'url' => url($product['url']),
        ];
    }
    return $schema;
}

function faq_schema(array $faqs): array
{
    $entities = [];
    foreach ($faqs as $faq) {
        $entities[] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }
    return [
        '@type' => 'FAQPage',
        'mainEntity' => $entities,
    ];
}

function article_schema(array $article): array
{
    return [
        '@type' => 'Article',
        'headline' => $article['title'],
        'description' => $article['excerpt'],
        'datePublished' => $article['date'],
        'dateModified' => $article['updated'] ?? $article['date'],
        'author' => [
            '@type' => 'Organization',
            'name' => $article['author'] ?? config('site_name'),
        ],
        'publisher' => ['@id' => url('/') . '#organization'],
        'image' => asset($article['image'] ?? config('og_image')),
        'mainEntityOfPage' => url($article['url']),
    ];
}

function schema_graph(array $extra = []): array
{
    global $page;
    $graph = [organization_schema(), website_schema()];
    if (!empty($page['breadcrumbs'])) {
        $graph[] = breadcrumb_schema($page['breadcrumbs']);
    }
    foreach ($extra as $node) {
        if ($node) {
            $graph[] = $node;
        }
    }
    return [
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ];
}

function print_schema(array $extra = []): void
{
    $json = json_encode(schema_graph($extra), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}
