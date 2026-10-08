<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$item = $item ?? [];
?>
<blockquote class="card-premium">
    <p>“<?= e($item['quote']) ?>”</p>
    <footer class="mt-3">
        <strong><?= e($item['name']) ?></strong>
        <div class="text-muted small"><?= e($item['company']) ?> · <?= e($item['industry']) ?></div>
        <?php if (($item['status'] ?? '') === 'placeholder'): ?>
            <span class="chip mt-2">Placeholder — replace with a real client quote</span>
        <?php endif; ?>
    </footer>
</blockquote>
