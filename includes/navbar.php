<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}
$items = nav_items();
?>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-inryth" aria-label="Primary">
        <div class="container-site d-flex align-items-center justify-content-between w-100">
            <a class="brand" href="<?= e(url('/')) ?>">
                <img class="brand-mark" src="<?= e(asset('images/logo.svg')) ?>?v=2" width="34" height="34" alt="">
                <span><?= e(config('site_name')) ?></span>
            </a>
            <div class="d-none d-lg-flex align-items-center gap-1">
                <?php foreach ($items as $item): ?>
                    <?php if (!empty($item['children'])): ?>
                        <div class="dropdown">
                            <a class="nav-link-inryth dropdown-toggle <?= is_active($item['href']) ? 'active' : '' ?>" href="<?= e(url($item['href'])) ?>" data-bs-toggle="dropdown" aria-expanded="false"><?= e($item['label']) ?></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($item['children'] as $child): ?>
                                    <li><a class="dropdown-item" href="<?= e(url($child['href'])) ?>"><?= e($child['label']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="nav-link-inryth <?= is_active($item['href']) ? 'active' : '' ?>" href="<?= e(url($item['href'])) ?>"><?= e($item['label']) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="nav-cta nav-cta-desktop">
                <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'navbar')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="navbar">WhatsApp Us</a>
                <a class="btn" href="<?= e(url('/contact')) ?>" data-track="consultation_click" data-track-label="navbar">Get Free Consultation</a>
            </div>
            <button class="nav-toggle d-lg-none" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Open menu">
                <i class="bi bi-list" aria-hidden="true"></i>
            </button>
        </div>
    </nav>
</header>
<div class="mobile-nav d-lg-none" id="mobile-nav" data-mobile-nav aria-hidden="true">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <strong><?= e(config('site_name')) ?></strong>
        <button class="nav-toggle" type="button" data-nav-close aria-label="Close menu"><i class="bi bi-x-lg"></i></button>
    </div>
    <?php foreach ($items as $item): ?>
        <a href="<?= e(url($item['href'])) ?>" data-nav-close><?= e($item['label']) ?></a>
        <?php if (!empty($item['children'])): ?>
            <?php foreach ($item['children'] as $child): ?>
                <a href="<?= e(url($child['href'])) ?>" data-nav-close style="font-size:1rem;font-weight:600;padding-left:8px;"><?= e($child['label']) ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="btn-group mt-4">
        <a class="btn" href="<?= e(url('/contact')) ?>" data-nav-close>Get Free Consultation</a>
        <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'mobile-nav')) ?>" target="_blank" rel="noopener">WhatsApp Us</a>
    </div>
</div>
