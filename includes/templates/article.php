<?php if (!defined('INRYTH')) { http_response_code(403); exit; }
$article = $article ?? [];
$related = [];
foreach ($article['related'] ?? [] as $slug) {
    $found = get_article($slug);
    if ($found) {
        $related[] = $found;
    }
}
?>
<article>
    <?php render('page-hero', [
        'title' => $article['title'],
        'lead' => $article['excerpt'],
    ]); ?>
    <section class="section">
        <div class="container-site">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="article-thumb mb-4">
                        <img src="<?= e(asset($article['image'])) ?>" width="960" height="540" alt="<?= e($article['title']) ?>">
                    </div>
                    <p class="text-muted small"><?= e($article['author']) ?> · <?= e(date('j F Y', strtotime($article['date']))) ?> · <?= e($article['read_time']) ?></p>
                    <div class="article-body prose">
                        <?= markdown_lite($article['body']) ?>
                    </div>
                    <?php if (!empty($article['faq'])): ?>
                        <h2 class="mt-5">FAQ</h2>
                        <?php render('faq-accordion', ['faqs' => $article['faq'], 'id' => 'article-faq']); ?>
                    <?php endif; ?>
                </div>
                <aside class="col-lg-4">
                    <div class="card-premium mb-3">
                        <h2 class="h5">Need this implemented?</h2>
                        <p>If this is the bottleneck in your business, we can help you act on it.</p>
                        <a class="btn" href="<?= e(url('/contact')) ?>">Get Free Consultation</a>
                    </div>
                    <?php if ($related): ?>
                        <div class="card-premium">
                            <h2 class="h5">Related articles</h2>
                            <?php foreach ($related as $rel): ?>
                                <p><a href="<?= e(url($rel['url'])) ?>"><?= e($rel['title']) ?></a></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
    </section>
</article>
<?php render('cta-section'); ?>
