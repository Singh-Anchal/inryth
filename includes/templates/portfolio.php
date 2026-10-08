<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$filters = [
    'all' => 'All',
    'websites' => 'Websites',
    'real-estate' => 'Real Estate',
    'healthcare' => 'Healthcare',
    'education' => 'Education',
    'marketing' => 'Marketing',
    'automation' => 'Automation',
    'branding' => 'Branding',
    'landing-pages' => 'Landing Pages',
    'hospitality' => 'Hospitality',
];
?>
<?php render('page-hero', [
    'title' => 'Selected work across websites, marketing and automation.',
    'lead' => 'Each project is described in terms of the problem we solved. We do not attach invented growth percentages.',
]); ?>
<section class="section">
    <div class="container-site">
        <div class="filter-bar" role="toolbar" aria-label="Filter portfolio">
            <?php foreach ($filters as $key => $label): ?>
                <button class="filter-btn <?= $key === 'all' ? 'active' : '' ?>" type="button" data-filter="<?= e($key) ?>"><?= e($label) ?></button>
            <?php endforeach; ?>
        </div>
        <div class="row g-4">
            <?php foreach (load_data('portfolio') as $item): ?>
                <div class="col-md-6 col-lg-4"><?php render('portfolio-card', ['item' => $item]); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php render('cta-section', ['title' => 'Have a similar project in mind?']); ?>
