<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$articles = load_data('blog');
$categories = array_unique(array_map(static fn($a) => $a['category'], $articles));
?>
<?php render('page-hero', [
    'title' => 'Practical notes on websites, ads, SEO and WhatsApp.',
    'lead' => 'Written for Indian business owners who need clearer decisions, not more jargon.',
]); ?>
<section class="section">
    <div class="container-site">
        <div class="card-meta mb-4">
            <?php foreach ($categories as $cat): ?><span class="chip"><?= e($cat) ?></span><?php endforeach; ?>
        </div>
        <div class="row g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card-premium">
                        <div class="article-thumb">
                            <img src="<?= e(asset($article['image'])) ?>" width="640" height="400" alt="<?= e($article['title']) ?>" loading="lazy">
                        </div>
                        <span class="chip"><?= e($article['category']) ?></span>
                        <h2 class="h5 mt-3"><a href="<?= e(url($article['url'])) ?>"><?= e($article['title']) ?></a></h2>
                        <p><?= e($article['excerpt']) ?></p>
                        <p class="small text-muted mb-0"><?= e(date('j M Y', strtotime($article['date']))) ?> · <?= e($article['read_time']) ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
