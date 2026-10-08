<?php if (!defined('INRYTH')) { http_response_code(403); exit; } ?>
<?php render('page-hero', [
    'title' => 'Digital growth specialist and technology partner.',
    'lead' => 'Inryth helps Indian businesses connect websites, marketing and automation so enquiries do not get lost between tools and teams.',
]); ?>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-7">
                <h2 class="section-title">About Inryth</h2>
                <p>We work as a digital growth partner — not a vendor that delivers a logo, a campaign or a chatbot in isolation. The job is to help a business get found, capture interest, respond quickly and keep follow-up consistent.</p>
                <p>Most owners already have pieces: a website, an Instagram page, an ads account, a WhatsApp number. The gap is the system between them. That is the work we take on.</p>
                <p>The operating idea is simple: <strong>Build → Market → Automate → Grow</strong>.</p>
            </div>
            <div class="col-lg-5">
                <div class="card-premium">
                    <h3>Client value first</h3>
                    <p class="mb-0">We keep personal biography short on purpose. What matters is whether your site can convert, whether ads have a destination, and whether a lead gets a useful reply the same day.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <article class="card-premium"><h3>Expertise</h3><p>Websites, SEO, Google Ads, Meta Ads, creative, WhatsApp automation and lead operations.</p></article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="card-premium"><h3>Approach</h3><p>Fix the current bottleneck. Do not sell a stack the team will not use.</p></article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="card-premium"><h3>Industries</h3><p>Real estate, healthcare, education, local services, hospitality, startups and personal brands.</p></article>
            </div>
            <div class="col-md-6 col-lg-3">
                <article class="card-premium"><h3>Technology</h3><p>PHP and WordPress sites, analytics, WhatsApp workflows, n8n, APIs and CRM connections.</p></article>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <h2 class="section-title">Why clients choose a growth partner</h2>
        <div class="row g-3">
            <div class="col-md-4"><div class="card-premium"><h3>One conversation</h3><p>Website, ads and follow-up are planned together, so you are not translating between three vendors.</p></div></div>
            <div class="col-md-4"><div class="card-premium"><h3>Honest measurement</h3><p>We will not invent “300% growth.” We measure what can be measured and say when the baseline is missing.</p></div></div>
            <div class="col-md-4"><div class="card-premium"><h3>Systems you own</h3><p>Domains, ad accounts, analytics and WhatsApp assets stay in your name.</p></div></div>
        </div>
    </div>
</section>

<?php render('cta-section', ['title' => 'See if we are the right partner for this stage.']); ?>
