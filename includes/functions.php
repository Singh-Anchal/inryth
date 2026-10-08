<?php
/**
 * Shared helpers: URLs, escaping, WhatsApp, forms, data lookups.
 */
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

function config(?string $key = null, $default = null)
{
    $config = $GLOBALS['config'] ?? [];
    if ($key === null) {
        return $config;
    }
    return $config[$key] ?? $default;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function base_url(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }

    $configured = rtrim((string) config('site_url', ''), '/');
    if ($configured !== '') {
        $base = $configured;
        return $base;
    }

    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ((int) ($_SERVER['SERVER_PORT'] ?? 80) === 443);
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    $docRoot = rtrim(str_replace('\\', '/', (string) ($_SERVER['DOCUMENT_ROOT'] ?? '')), '/');
    $root = str_replace('\\', '/', ROOT_PATH);
    $sub = '';
    if ($docRoot !== '' && str_starts_with($root, $docRoot)) {
        $sub = trim(substr($root, strlen($docRoot)), '/');
    }

    $base = $scheme . '://' . $host . ($sub !== '' ? '/' . $sub : '');
    return $base;
}

function url(string $path = ''): string
{
    $path = '/' . ltrim($path, '/');
    if ($path === '/') {
        return base_url() . '/';
    }
    return base_url() . rtrim($path, '/');
}

function asset(string $path): string
{
    return base_url() . '/assets/' . ltrim($path, '/');
}

function current_path(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $basePath = parse_url(base_url(), PHP_URL_PATH) ?: '';
    if ($basePath !== '' && $basePath !== '/' && str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath)) ?: '/';
    }
    $uri = '/' . ltrim($uri, '/');
    if ($uri !== '/' && str_ends_with($uri, '.php')) {
        $uri = substr($uri, 0, -4);
    }
    return rtrim($uri, '/') ?: '/';
}

function is_active(string $path): bool
{
    $current = current_path();
    $path = rtrim($path, '/') ?: '/';
    if ($path === '/') {
        return $current === '/';
    }
    return $current === $path || str_starts_with($current, $path . '/');
}

function nav_items(): array
{
    return [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Services', 'href' => '/services', 'children' => [
            ['label' => 'All services', 'href' => '/services'],
            ['label' => 'Digital Marketing', 'href' => '/services/digital-marketing'],
            ['label' => 'Google Ads', 'href' => '/services/google-ads'],
            ['label' => 'Meta Ads', 'href' => '/services/meta-ads'],
            ['label' => 'SEO', 'href' => '/services/seo'],
            ['label' => 'Website Design', 'href' => '/services/website-design'],
            ['label' => 'Graphic Design', 'href' => '/services/graphic-design'],
            ['label' => 'WhatsApp Automation', 'href' => '/services/whatsapp-automation'],
            ['label' => 'Lead Management', 'href' => '/services/lead-management'],
            ['label' => 'AI Automation', 'href' => '/services/ai-automation'],
        ]],
        ['label' => 'Products', 'href' => '/products'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        ['label' => 'Case Studies', 'href' => '/case-studies'],
        ['label' => 'Blog', 'href' => '/blog'],
        ['label' => 'Contact', 'href' => '/contact'],
    ];
}

function generateWhatsAppLink(?string $message = null, string $source = 'website'): string
{
    $number = preg_replace('/\D+/', '', (string) config('whatsapp_number', ''));
    if ($number === '' || str_contains(strtoupper((string) config('whatsapp_number')), 'YOUR_')) {
        $number = '';
    }
    $message = $message ?: ($GLOBALS['page']['whatsapp_message'] ?? 'Hi, I would like to discuss digital growth for my business.');
    $text = $message . "\n\nSource: " . $source;
    $query = http_build_query(['text' => $text], '', '&', PHP_QUERY_RFC3986);
    if ($number === '') {
        return 'https://wa.me/?' . $query;
    }
    return 'https://wa.me/' . $number . '?' . $query;
}

function whatsapp_ready(): bool
{
    $number = (string) config('whatsapp_number', '');
    return $number !== '' && !str_contains(strtoupper($number), 'YOUR_');
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function find_by_slug(array $items, string $slug): ?array
{
    foreach ($items as $item) {
        if (($item['slug'] ?? '') === $slug) {
            return $item;
        }
    }
    return null;
}

function get_service(string $slug): ?array
{
    return find_by_slug(load_data('services'), $slug);
}

function get_product(string $slug): ?array
{
    return find_by_slug(load_data('products'), $slug);
}

function get_portfolio(string $slug): ?array
{
    return find_by_slug(load_data('portfolio'), $slug);
}

function get_case_study(string $slug): ?array
{
    return find_by_slug(load_data('case-studies'), $slug);
}

function get_article(string $slug): ?array
{
    return find_by_slug(load_data('blog'), $slug);
}

function get_industry(string $slug): ?array
{
    return find_by_slug(load_data('industries'), $slug);
}

function related_services(array $slugs): array
{
    $out = [];
    foreach ($slugs as $slug) {
        $item = get_service($slug);
        if ($item) {
            $out[] = $item;
        }
    }
    return $out;
}

function related_products(array $slugs): array
{
    $out = [];
    foreach ($slugs as $slug) {
        $item = get_product($slug);
        if ($item) {
            $out[] = $item;
        }
    }
    return $out;
}

function page_meta(string $id): array
{
    $pages = load_data('pages');
    return $pages[$id] ?? [];
}

function apply_page(string $id, array $overrides = []): void
{
    global $page;
    $page = array_merge($page, page_meta($id), $overrides, ['id' => $id]);
}

function render(string $component, array $props = []): void
{
    extract($props, EXTR_SKIP);
    $file = INCLUDES_PATH . '/components/' . $component . '.php';
    if (is_file($file)) {
        include $file;
    }
}

function render_template(string $template, array $props = []): void
{
    extract($props, EXTR_SKIP);
    $file = INCLUDES_PATH . '/templates/' . $template . '.php';
    if (is_file($file)) {
        include $file;
    }
}

function icon(string $name, string $class = ''): string
{
    $class = trim('bi bi-' . $name . ' ' . $class);
    return '<i class="' . e($class) . '" aria-hidden="true"></i>';
}

function budget_ranges(): array
{
    return [
        '' => 'Select a range',
        'under-25k' => 'Under ₹25,000',
        '25k-75k' => '₹25,000 – ₹75,000',
        '75k-2l' => '₹75,000 – ₹2,00,000',
        '2l-5l' => '₹2,00,000 – ₹5,00,000',
        '5l-plus' => '₹5,00,000+',
        'not-sure' => 'Not sure yet',
    ];
}

function service_options(): array
{
    $options = ['' => 'Select a service'];
    foreach (load_data('services') as $service) {
        $options[$service['slug']] = $service['name'];
    }
    $options['products'] = 'Digital products';
    $options['not-sure'] = 'Not sure yet';
    return $options;
}

function client_ip(): string
{
    $keys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $value = explode(',', (string) $_SERVER[$key])[0];
            return trim($value);
        }
    }
    return '0.0.0.0';
}

function rate_limited(string $bucket = 'form'): bool
{
    $dir = STORAGE_PATH . '/rate-limit';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    $file = $dir . '/' . hash('sha256', $bucket . '|' . client_ip()) . '.json';
    $window = (int) config('form_rate_window', 900);
    $limit = (int) config('form_rate_limit', 5);
    $now = time();
    $hits = [];
    if (is_file($file)) {
        $hits = json_decode((string) file_get_contents($file), true) ?: [];
    }
    $hits = array_values(array_filter($hits, static fn($t) => ($now - (int) $t) < $window));
    if (count($hits) >= $limit) {
        return true;
    }
    $hits[] = $now;
    file_put_contents($file, json_encode($hits), LOCK_EX);
    return false;
}

function sanitize_text(?string $value, int $max = 2000): string
{
    $value = trim(strip_tags((string) $value));
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]+/', '', $value) ?? '';
    return mb_substr($value, 0, $max);
}

function valid_email(string $email): bool
{
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function valid_phone(string $phone): bool
{
    $digits = preg_replace('/\D+/', '', $phone);
    return strlen($digits) >= 10 && strlen($digits) <= 15;
}

function json_response(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function redirect_to(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function set_page_defaults(array $item, string $type): void
{
    global $page;
    $page['title'] = $item['seo_title'] ?? ($item['name'] . ' | ' . config('site_name'));
    $page['description'] = $item['seo_description'] ?? ($item['excerpt'] ?? $item['summary'] ?? config('site_description'));
    $page['canonical'] = $item['url'] ?? ('/' . $type . 's/' . ($item['slug'] ?? ''));
    $page['whatsapp_message'] = $item['whatsapp_message'] ?? $page['whatsapp_message'];
    $page['og_image'] = $item['image'] ?? $page['og_image'];
    $page['schema'] = $item['schema'] ?? $type;
}

function not_found_and_exit(): void
{
    apply_page('404');
    http_response_code(404);
    require INCLUDES_PATH . '/header.php';
    render_template('error-404');
    require INCLUDES_PATH . '/footer.php';
    exit;
}

function prepare_service_page(string $slug, bool $landing = false): array
{
    global $schema_extra;
    $service = get_service($slug);
    if (!$service) {
        not_found_and_exit();
    }
    $crumbs = [
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Services', 'url' => '/services'],
        ['name' => $service['name'], 'url' => $service['url']],
    ];
    if ($landing) {
        $crumbs = [
            ['name' => 'Home', 'url' => '/'],
            ['name' => $service['name'] . ' landing', 'url' => '/landing/' . $slug],
        ];
    }
    apply_page('services', [
        'title' => $landing
            ? ($service['cta'] . ' | ' . $service['name'] . ' for Indian Businesses')
            : $service['seo_title'],
        'description' => $service['seo_description'],
        'canonical' => $landing ? '/landing/' . $slug : $service['url'],
        'whatsapp_message' => $service['whatsapp_message'],
        'breadcrumbs' => $crumbs,
        'minimal_nav' => $landing,
        'robots' => $landing ? 'index,follow' : 'index,follow',
    ]);
    $faqs = load_data('faqs')[$service['faq_group'] ?? 'general'] ?? [];
    $schema_extra[] = service_schema($service);
    if ($faqs) {
        $schema_extra[] = faq_schema($faqs);
    }
    return $service;
}

function prepare_product_page(string $slug): array
{
    global $schema_extra;
    $product = get_product($slug);
    if (!$product) {
        not_found_and_exit();
    }
    apply_page('products', [
        'title' => $product['seo_title'],
        'description' => $product['seo_description'],
        'canonical' => $product['url'],
        'whatsapp_message' => $product['whatsapp_message'],
        'og_image' => $product['image'],
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Products', 'url' => '/products'],
            ['name' => $product['name'], 'url' => $product['url']],
        ],
    ]);
    $schema_extra[] = product_schema($product);
    if (!empty($product['faq'])) {
        $schema_extra[] = faq_schema($product['faq']);
    }
    return $product;
}

function prepare_portfolio_page(string $slug): array
{
    $item = get_portfolio($slug);
    if (!$item) {
        not_found_and_exit();
    }
    apply_page('portfolio', [
        'title' => $item['name'] . ' | Portfolio',
        'description' => $item['excerpt'],
        'canonical' => $item['url'],
        'whatsapp_message' => $item['whatsapp_message'],
        'og_image' => $item['image'],
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Portfolio', 'url' => '/portfolio'],
            ['name' => $item['name'], 'url' => $item['url']],
        ],
    ]);
    return $item;
}

function prepare_case_study_page(string $slug): array
{
    $item = get_case_study($slug);
    if (!$item) {
        not_found_and_exit();
    }
    apply_page('case-studies', [
        'title' => $item['name'] . ' | Case Study',
        'description' => $item['summary'],
        'canonical' => $item['url'],
        'whatsapp_message' => $item['whatsapp_message'],
        'og_image' => $item['image'],
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Case Studies', 'url' => '/case-studies'],
            ['name' => $item['name'], 'url' => $item['url']],
        ],
    ]);
    return $item;
}

function prepare_article_page(string $slug): array
{
    global $schema_extra;
    $article = get_article($slug);
    if (!$article) {
        not_found_and_exit();
    }
    apply_page('blog', [
        'title' => $article['seo_title'],
        'description' => $article['seo_description'],
        'canonical' => $article['url'],
        'whatsapp_message' => $article['whatsapp_message'],
        'og_image' => $article['image'],
        'og_type' => 'article',
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Blog', 'url' => '/blog'],
            ['name' => $article['title'], 'url' => $article['url']],
        ],
    ]);
    $schema_extra[] = article_schema($article);
    if (!empty($article['faq'])) {
        $schema_extra[] = faq_schema($article['faq']);
    }
    return $article;
}

function markdown_lite(string $text): string
{
    $text = str_replace(["\r\n", "\r"], "\n", trim($text));
    $html = '';
    $para = [];
    $list = [];
    $flush_para = static function () use (&$html, &$para) {
        if ($para) {
            $html .= '<p>' . e(implode(' ', $para)) . '</p>';
            $para = [];
        }
    };
    $flush_list = static function () use (&$html, &$list) {
        if ($list) {
            $html .= '<ul>';
            foreach ($list as $item) {
                $html .= '<li>' . e($item) . '</li>';
            }
            $html .= '</ul>';
            $list = [];
        }
    };
    foreach (explode("\n", $text) as $line) {
        $line = rtrim($line);
        if ($line === '') {
            $flush_para();
            $flush_list();
            continue;
        }
        if (str_starts_with($line, '## ')) {
            $flush_para();
            $flush_list();
            $html .= '<h2>' . e(substr($line, 3)) . '</h2>';
            continue;
        }
        if (str_starts_with($line, '- ')) {
            $flush_para();
            $list[] = substr($line, 2);
            continue;
        }
        $flush_list();
        $para[] = $line;
    }
    $flush_para();
    $flush_list();
    return $html;
}
