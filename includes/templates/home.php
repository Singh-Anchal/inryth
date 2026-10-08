<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$services = load_data('services');
$products = load_data('products');
$industries = load_data('industries');
$studies = load_data('case-studies');
$faqs = array_merge(load_data('faqs')['general'], load_data('faqs')['pricing']);
?>
<section class="hero">
    <div class="hero-orbs" aria-hidden="true">
        <span class="orb orb-blue"></span>
        <span class="orb orb-orange"></span>
    </div>
    <div class="container-site">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <p class="section-kicker">Digital growth partner for Indian businesses</p>
                <h1>Grow faster. Market smarter. <span>Automate better.</span></h1>
                <p class="lead">We build high-performance websites, digital marketing campaigns and automation systems that help Indian businesses generate leads, improve conversions and scale digitally.</p>
                <div class="btn-group">
                    <a class="btn" href="<?= e(url('/contact')) ?>" data-track="consultation_click" data-track-label="hero">Get Free Consultation</a>
                    <a class="btn btn-whatsapp" href="<?= e(generateWhatsAppLink(null, 'hero')) ?>" target="_blank" rel="noopener" data-track="whatsapp_click" data-track-label="hero">WhatsApp Us</a>
                    <a class="btn btn-secondary" href="<?= e(url('/services')) ?>">Explore Our Services</a>
                </div>
                <div class="trust-row" aria-label="Focus areas">
                    <span class="trust-pill">Web Development</span>
                    <span class="trust-pill">Digital Marketing</span>
                    <span class="trust-pill">Automation</span>
                    <span class="trust-pill">Lead Generation</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual" aria-hidden="true">
                    <div class="dash-top">
                        <strong>Growth system</strong>
                        <div class="dash-dots"><span></span><span></span><span></span></div>
                    </div>
                    <div class="dash-grid">
                        <div class="dash-card">
                            <strong>Website</strong>
                            <b>Enquiry-ready pages</b>
                            <div class="dash-bar"><i style="--w:82%"></i></div>
                        </div>
                        <div class="dash-card">
                            <strong>Ads</strong>
                            <b>Search + Meta</b>
                            <div class="dash-bar"><i style="--w:68%"></i></div>
                        </div>
                        <div class="dash-card">
                            <strong>Leads</strong>
                            <b>Tracked intake</b>
                            <div class="dash-bar"><i style="--w:74%"></i></div>
                        </div>
                        <div class="dash-card">
                            <strong>WhatsApp</strong>
                            <b>Same-day reply</b>
                            <div class="dash-bar"><i style="--w:90%"></i></div>
                        </div>
                        <div class="dash-card dash-wide">
                            <strong>Build → Market → Automate → Grow</strong>
                            <div class="flow-mini">
                                <span>Traffic</span><span>Landing page</span><span>Form</span><span>CRM</span><span>WhatsApp</span><span>Follow-up</span><span>Sale</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pillar-row" aria-label="How we work">
            <div class="pillar">Build</div>
            <div class="pillar">Market</div>
            <div class="pillar">Automate</div>
            <div class="pillar">Grow</div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'What we cover',
            'title' => 'Everything you need to build, market and grow your business online.',
            'lead' => 'One partner for the website, the campaigns and the follow-up — so leads do not fall between tools.',
        ]); ?>
        <div class="row g-3">
            <?php foreach ($services as $service): ?>
                <div class="col-6 col-md-4 col-lg-3"><?php render('service-card', ['service' => $service]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-6">
                <?php render('section-header', [
                    'kicker' => 'The real problem',
                    'title' => 'Your business doesn’t need more digital noise. It needs a better growth system.',
                    'lead' => 'Activity is easy to buy. A system that turns attention into conversations is not.',
                ]); ?>
                <ul class="text-muted">
                    <li>Website not generating enquiries</li>
                    <li>Ads spending without quality leads</li>
                    <li>Slow lead response</li>
                    <li>Manual follow-up</li>
                    <li>Poor online visibility</li>
                    <li>No proper lead tracking</li>
                    <li>Social media without measurable results</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="card-premium">
                    <h2 class="h4">We connect Website + Ads + Leads + WhatsApp + Automation into one growth system.</h2>
                    <div class="workflow mt-4">
                        <?php
                        $steps = ['Traffic', 'Website / Landing page', 'Lead form', 'CRM / lead system', 'WhatsApp', 'Automated follow-up', 'Sales conversion'];
                        foreach ($steps as $i => $step):
                        ?>
                            <div class="workflow-step">
                                <div class="workflow-dot"><?= $i + 1 ?></div>
                                <div>
                                    <strong><?= e($step) ?></strong>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Services',
            'title' => 'Four capabilities. One outcome: qualified conversations.',
            'lead' => 'Use them together or start with the constraint that is costing you the most right now.',
        ]); ?>
        <div class="row g-4">
            <div class="col-md-6">
                <article class="card-premium">
                    <h3>Digital Marketing</h3>
                    <p>SEO, Google Ads, Meta Ads, social, performance marketing and local SEO — planned around lead quality.</p>
                    <p class="mb-0"><a class="fw-bold" href="<?= e(url('/services/digital-marketing')) ?>">Explore digital marketing →</a></p>
                </article>
            </div>
            <div class="col-md-6">
                <article class="card-premium">
                    <h3>Website Development</h3>
                    <p>Business sites, landing pages, industry websites, WordPress or custom PHP — built to convert, not just to exist.</p>
                    <p class="mb-0"><a class="fw-bold" href="<?= e(url('/services/website-design')) ?>">Explore websites →</a></p>
                </article>
            </div>
            <div class="col-md-6">
                <article class="card-premium">
                    <h3>Creative & Branding</h3>
                    <p>Ad creatives, social design, branding and UI that keep the same promise from the first click to the form.</p>
                    <p class="mb-0"><a class="fw-bold" href="<?= e(url('/services/graphic-design')) ?>">Explore creative →</a></p>
                </article>
            </div>
            <div class="col-md-6">
                <article class="card-premium">
                    <h3>Automation</h3>
                    <p>WhatsApp flows, lead routing, CRM, chatbots, n8n and API connections that remove delay from follow-up.</p>
                    <p class="mb-0"><a class="fw-bold" href="<?= e(url('/services/whatsapp-automation')) ?>">Explore automation →</a></p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'How we work',
            'title' => 'A process that stays visible.',
            'lead' => 'You always know what is being built, what is waiting on you, and what happens after launch.',
        ]); ?>
        <div class="process-grid">
            <?php
            $process = [
                ['01', 'Discover', 'Understand your business, offer and what a good lead looks like.'],
                ['02', 'Strategize', 'Choose the channel and system that remove the current bottleneck.'],
                ['03', 'Design', 'Shape the experience so people can decide and act on mobile.'],
                ['04', 'Develop', 'Build fast pages, forms, tracking and integrations you can maintain.'],
                ['05', 'Launch', 'Go live with analytics, WhatsApp and a clear operating routine.'],
                ['06', 'Optimize', 'Review conversations, not vanity metrics, and improve the next cycle.'],
            ];
            foreach ($process as $step):
            ?>
                <article class="process-item">
                    <div class="process-num"><?= e($step[0]) ?> — <?= e($step[1]) ?></div>
                    <p class="mb-0 text-muted"><?= e($step[2]) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Industries',
            'title' => 'Built for the way Indian businesses actually sell.',
            'lead' => 'The system changes by industry. The job does not: make it easy to enquire and easy to follow up.',
        ]); ?>
        <div class="row g-3">
            <?php foreach ($industries as $industry): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <article class="card-premium">
                        <div class="icon-wrap"><i class="bi bi-<?= e($industry['icon']) ?>"></i></div>
                        <h3><?= e($industry['name']) ?></h3>
                        <p><?= e($industry['excerpt']) ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Products',
            'title' => 'Ready systems when you need a faster start.',
            'lead' => 'These are implemented products, not a self-serve store. Each one can connect to ads and WhatsApp.',
        ]); ?>
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6"><?php render('product-card', ['product' => $product]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Solutions',
            'title' => 'Solutions designed around your business.',
            'lead' => 'Starting shapes, not locked prices. We propose after we understand scope.',
        ]); ?>
        <div class="row g-3">
            <?php
            $packs = [
                ['Starter', 'Website + basic SEO foundations'],
                ['Growth', 'Website + SEO + ads readiness'],
                ['Performance', 'Ads + landing pages + tracking'],
                ['Automation', 'WhatsApp + lead management + workflows'],
                ['Custom', 'Complete digital growth system'],
            ];
            foreach ($packs as $pack):
            ?>
                <div class="col-md-6 col-lg">
                    <article class="card-premium">
                        <h3><?= e($pack[0]) ?></h3>
                        <p><?= e($pack[1]) ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <a class="btn" href="<?= e(url('/contact')) ?>">Request Custom Proposal</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Proof',
            'title' => 'How the system looks in practice.',
            'lead' => 'Case studies describe decisions and operating changes. We do not invent percentage growth.',
        ]); ?>
        <div class="row g-4">
            <?php foreach ($studies as $study): ?>
                <div class="col-md-4"><?php render('case-study-card', ['study' => $study]); ?></div>
            <?php endforeach; ?>
        </div>
        <p class="mt-4 mb-0"><a class="fw-bold" href="<?= e(url('/case-studies')) ?>">All case studies →</a> · <a class="fw-bold" href="<?= e(url('/portfolio')) ?>">Portfolio →</a></p>
    </div>
</section>

<section class="section section-light">
    <div class="container-site">
        <?php render('section-header', [
            'kicker' => 'Social proof',
            'title' => 'Trusted by businesses across multiple industries.',
            'lead' => 'Client quotes and logos appear here only when we have permission. The structure is ready; the claims stay honest.',
        ]); ?>
        <div class="row g-4">
            <?php foreach (load_data('testimonials') as $item): ?>
                <div class="col-md-4"><?php render('testimonial-card', ['item' => $item]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="row g-5">
            <div class="col-lg-5">
                <?php render('section-header', [
                    'kicker' => 'FAQ',
                    'title' => 'Straight answers before you enquire.',
                ]); ?>
            </div>
            <div class="col-lg-7">
                <?php render('faq-accordion', ['faqs' => $faqs, 'id' => 'home-faq']); ?>
                <p class="mt-3"><a class="fw-bold" href="<?= e(url('/faq')) ?>">More FAQs →</a></p>
            </div>
        </div>
    </div>
</section>

<?php render('cta-section', [
    'title' => 'Let’s map the next useful step for your business.',
    'cta' => 'Get Free Consultation',
]); ?>
