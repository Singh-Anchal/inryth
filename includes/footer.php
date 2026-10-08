<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}
?>
</main>
<?php if (empty($page['minimal_nav'])): ?>
<footer class="site-footer">
    <div class="container-site">
        <div class="footer-cta d-lg-flex justify-content-between align-items-center gap-3">
            <div>
                <p class="section-kicker mb-2">Let’s talk</p>
                <h2 class="h3 mb-2">Let’s build your digital growth system.</h2>
                <p class="mb-0">Website, ads, leads and WhatsApp — planned as one path, not four disconnected vendors.</p>
            </div>
            <div class="btn-group mt-3 mt-lg-0">
                <a class="btn" href="<?= e(url('/contact')) ?>" data-track="consultation_click" data-track-label="footer">Get Free Consultation</a>
                <a class="btn btn-ghost" href="<?= e(generateWhatsAppLink(null, 'footer')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="footer">WhatsApp Us</a>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-6 col-lg-3">
                <h3 class="h6 text-uppercase" style="letter-spacing:.08em;">Company</h3>
                <ul class="footer-links">
                    <li><a href="<?= e(url('/about')) ?>">About</a></li>
                    <li><a href="<?= e(url('/portfolio')) ?>">Portfolio</a></li>
                    <li><a href="<?= e(url('/case-studies')) ?>">Case Studies</a></li>
                    <li><a href="<?= e(url('/industries')) ?>">Industries</a></li>
                    <li><a href="<?= e(url('/contact')) ?>">Contact</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h3 class="h6 text-uppercase" style="letter-spacing:.08em;">Services</h3>
                <ul class="footer-links">
                    <li><a href="<?= e(url('/services/seo')) ?>">SEO</a></li>
                    <li><a href="<?= e(url('/services/google-ads')) ?>">Google Ads</a></li>
                    <li><a href="<?= e(url('/services/meta-ads')) ?>">Meta Ads</a></li>
                    <li><a href="<?= e(url('/services/website-design')) ?>">Website Design</a></li>
                    <li><a href="<?= e(url('/services/graphic-design')) ?>">Graphic Design</a></li>
                    <li><a href="<?= e(url('/services/whatsapp-automation')) ?>">WhatsApp Automation</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h3 class="h6 text-uppercase" style="letter-spacing:.08em;">Solutions</h3>
                <ul class="footer-links">
                    <li><a href="<?= e(url('/services/lead-management')) ?>">Lead Generation</a></li>
                    <li><a href="<?= e(url('/services/ai-automation')) ?>">AI Automation</a></li>
                    <li><a href="<?= e(url('/products/business-website-system')) ?>">Business Websites</a></li>
                    <li><a href="<?= e(url('/products')) ?>">Digital Products</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h3 class="h6 text-uppercase" style="letter-spacing:.08em;">Resources</h3>
                <ul class="footer-links">
                    <li><a href="<?= e(url('/blog')) ?>">Blog</a></li>
                    <li><a href="<?= e(url('/faq')) ?>">FAQs</a></li>
                    <li><a href="<?= e(url('/privacy-policy')) ?>">Privacy Policy</a></li>
                    <li><a href="<?= e(url('/terms-and-conditions')) ?>">Terms</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom d-lg-flex justify-content-between">
            <p class="mb-2 mb-lg-0">&copy; <?= date('Y') ?> <?= e(config('site_name')) ?>. <?= e(config('site_tagline')) ?></p>
            <p class="mb-0">
                <a href="<?= e(url('/cookie-policy')) ?>">Cookies</a> ·
                <a href="<?= e(url('/disclaimer')) ?>">Disclaimer</a>
            </p>
        </div>
    </div>
</footer>
<?php endif; ?>
<?php
if (empty($page['hide_sticky_bar'])) {
    render('mobile-sticky-bar');
}
if (empty($page['minimal_nav'])) {
    render('whatsapp-float');
}
render('chatbot');
?>
<script>window.INRYTH_WHATSAPP = <?= json_encode(generateWhatsAppLink(null, 'chatbot')) ?>;</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="<?= e(asset('js/tracking.js')) ?>" defer></script>
<script src="<?= e(asset('js/main.js')) ?>?v=2" defer></script>
<script src="<?= e(asset('js/forms.js')) ?>" defer></script>
<script src="<?= e(asset('js/chatbot.js')) ?>" defer></script>
</body>
</html>
