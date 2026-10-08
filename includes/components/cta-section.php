<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$title = $title ?? 'Ready to build a growth system?';
$lead = $lead ?? 'Tell us what is not working today. We will recommend the next useful step — website, ads, SEO or WhatsApp — without a generic pitch.';
$cta = $cta ?? 'Get Free Consultation';
$cta_href = $cta_href ?? '/contact';
$wa = $wa ?? 'WhatsApp Us';
?>
<section class="section section-dark">
    <div class="container-site">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h2 class="section-title text-white"><?= e($title) ?></h2>
                <p class="section-lead" style="color:#c5cedd;"><?= e($lead) ?></p>
            </div>
            <div class="col-lg-5">
                <div class="btn-group">
                    <a class="btn" href="<?= e(url($cta_href)) ?>" data-track="consultation_click" data-track-label="cta-section"><?= e($cta) ?></a>
                    <a class="btn btn-ghost" href="<?= e(generateWhatsAppLink(null, 'cta-section')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="cta-section"><?= e($wa) ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
