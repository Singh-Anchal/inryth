<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}
global $page, $schema_extra;
$schema_extra = $schema_extra ?? [];
$gtm = config('google_tag_manager_id');
$ga = config('google_analytics_id');
$pixel = config('meta_pixel_id');
?>
<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e(seo_title()) ?></title>
    <meta name="description" content="<?= e($page['description'] ?? config('site_description')) ?>">
    <meta name="robots" content="<?= e($page['robots'] ?? 'index,follow') ?>">
    <link rel="canonical" href="<?= e(canonical_url()) ?>">
    <link rel="icon" type="image/svg+xml" href="<?= e(asset(config('favicon'))) ?>">
    <meta property="og:type" content="<?= e($page['og_type'] ?? 'website') ?>">
    <meta property="og:title" content="<?= e(seo_title()) ?>">
    <meta property="og:description" content="<?= e($page['description'] ?? config('site_description')) ?>">
    <meta property="og:url" content="<?= e(canonical_url()) ?>">
    <meta property="og:image" content="<?= e(og_image_url()) ?>">
    <meta property="og:locale" content="<?= e(config('locale', 'en_IN')) ?>">
    <meta property="og:site_name" content="<?= e(config('site_name')) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e(seo_title()) ?>">
    <meta name="twitter:description" content="<?= e($page['description'] ?? config('site_description')) ?>">
    <meta name="twitter:image" content="<?= e(og_image_url()) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>?v=2">
    <?php print_schema($schema_extra); ?>
    <?php if ($gtm): ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':Date.now(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($gtm) ?>');</script>
    <?php endif; ?>
    <?php if ($ga && !$gtm): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($ga) ?>"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($ga) ?>');</script>
    <?php endif; ?>
    <?php if ($pixel): ?>
    <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','<?= e($pixel) ?>');fbq('track','PageView');</script>
    <?php endif; ?>
</head>
<body class="<?= e(trim(($page['body_class'] ?? '') . (!empty($page['hide_sticky_bar']) ? ' no-sticky-bar' : ''))) ?>">
<?php if ($gtm): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($gtm) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>
<a class="skip-link" href="#main">Skip to content</a>
<?php
if (!empty($page['minimal_nav'])) {
    include INCLUDES_PATH . '/components/landing-nav.php';
} else {
    include INCLUDES_PATH . '/navbar.php';
}
?>
<main id="main">
