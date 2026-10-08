<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$groups = load_data('faqs');
$labels = [
    'general' => 'General',
    'digital-marketing' => 'Digital Marketing',
    'website' => 'Website Development',
    'seo' => 'SEO',
    'google-ads' => 'Google Ads',
    'meta-ads' => 'Meta Ads',
    'whatsapp' => 'WhatsApp Automation',
    'pricing' => 'Pricing',
    'process' => 'Process',
    'support' => 'Support',
    'leads' => 'Lead Management',
    'automation' => 'AI Automation',
    'creative' => 'Creative',
];
$all = [];
foreach ($groups as $set) {
    $all = array_merge($all, $set);
}
?>
<?php render('page-hero', [
    'title' => 'Questions from business owners.',
    'lead' => 'Clear answers on services, process, pricing shape and support. If your question is not here, WhatsApp us.',
]); ?>
<section class="section">
    <div class="container-site">
        <?php foreach ($groups as $key => $faqs): ?>
            <h2 class="h4 mt-4"><?= e($labels[$key] ?? ucfirst($key)) ?></h2>
            <?php render('faq-accordion', ['faqs' => $faqs, 'id' => 'faq-' . $key]); ?>
        <?php endforeach; ?>
    </div>
</section>
<?php render('cta-section', ['title' => 'Still deciding? Send the current problem.']); ?>
