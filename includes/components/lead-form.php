<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$type = $type ?? ($_GET['form'] ?? 'enquiry');
$allowed = ['enquiry', 'website', 'marketing'];
if (!in_array($type, $allowed, true)) {
    $type = 'enquiry';
}
$prefill = sanitize_text($_GET['service'] ?? ($prefill_service ?? ''), 80);
$heading = [
    'enquiry' => 'Tell us what you need',
    'website' => 'Request a website quote',
    'marketing' => 'Book a marketing consultation',
][$type];
?>
<form class="form-card" method="post" action="<?= e(url('/process-lead')) ?>" data-lead-form data-form-type="<?= e($type) ?>" novalidate>
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="form_type" value="<?= e($type) ?>">
    <input type="hidden" name="page_path" value="<?= e(current_path()) ?>">
    <div class="hp-field" aria-hidden="true">
        <label>Company website<input type="text" name="website_hp" tabindex="-1" autocomplete="off"></label>
    </div>
    <h2 class="h4 mb-3"><?= e($heading) ?></h2>
    <p class="text-muted" data-form-status hidden></p>
    <div class="row g-3">
        <div class="col-md-6 field">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" id="name" name="name" required autocomplete="name">
        </div>
        <div class="col-md-6 field">
            <label class="form-label" for="phone">Phone</label>
            <input class="form-control" id="phone" name="phone" required inputmode="tel" autocomplete="tel">
        </div>
        <?php if ($type === 'enquiry'): ?>
            <div class="col-md-6 field">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" id="email" name="email" type="email" autocomplete="email">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="business_name">Business name</label>
                <input class="form-control" id="business_name" name="business_name">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="service">Service</label>
                <select class="form-select" id="service" name="service">
                    <?php foreach (service_options() as $value => $label): ?>
                        <option value="<?= e($value) ?>" <?= $prefill === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="budget">Budget range</label>
                <select class="form-select" id="budget" name="budget">
                    <?php foreach (budget_ranges() as $value => $label): ?>
                        <option value="<?= e($value) ?>"><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 field">
                <label class="form-label" for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="What is not working today?"></textarea>
            </div>
        <?php elseif ($type === 'website'): ?>
            <div class="col-md-6 field">
                <label class="form-label" for="business_type">Business type</label>
                <input class="form-control" id="business_type" name="business_type" placeholder="Real estate, clinic, coaching…">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="website_type">Website type</label>
                <select class="form-select" id="website_type" name="website_type">
                    <option value="">Select</option>
                    <option>New business website</option>
                    <option>Redesign</option>
                    <option>Landing page</option>
                    <option>E-commerce</option>
                    <option>Industry website</option>
                </select>
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="pages">Pages required</label>
                <input class="form-control" id="pages" name="pages" placeholder="e.g. 8–12">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="features">Key features</label>
                <input class="form-control" id="features" name="features" placeholder="WhatsApp, listings, bookings…">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="budget">Budget</label>
                <select class="form-select" id="budget" name="budget">
                    <?php foreach (budget_ranges() as $value => $label): ?>
                        <option value="<?= e($value) ?>"><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="timeline">Timeline</label>
                <input class="form-control" id="timeline" name="timeline" placeholder="e.g. 4 weeks">
            </div>
        <?php else: ?>
            <div class="col-md-6 field">
                <label class="form-label" for="business_name">Business</label>
                <input class="form-control" id="business_name" name="business_name">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="current_website">Current website</label>
                <input class="form-control" id="current_website" name="current_website" placeholder="https://">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="marketing_goal">Marketing goal</label>
                <input class="form-control" id="marketing_goal" name="marketing_goal" placeholder="Leads, calls, enrolments…">
            </div>
            <div class="col-md-6 field">
                <label class="form-label" for="ad_budget">Monthly ad budget</label>
                <select class="form-select" id="ad_budget" name="ad_budget">
                    <option value="">Select</option>
                    <option>Under ₹25,000</option>
                    <option>₹25,000 – ₹75,000</option>
                    <option>₹75,000 – ₹2,00,000</option>
                    <option>₹2,00,000+</option>
                    <option>Not decided</option>
                </select>
            </div>
            <div class="col-12 field">
                <label class="form-label" for="service">Preferred service</label>
                <select class="form-select" id="service" name="service">
                    <?php foreach (service_options() as $value => $label): ?>
                        <option value="<?= e($value) ?>" <?= $prefill === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="col-12">
            <button class="btn" type="submit">Send enquiry</button>
            <p class="small text-muted mt-3 mb-0">We use this only to respond to your request. See our <a href="<?= e(url('/privacy-policy')) ?>">privacy policy</a>.</p>
        </div>
    </div>
</form>
