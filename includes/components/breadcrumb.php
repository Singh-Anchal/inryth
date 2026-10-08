<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
if (empty($page['breadcrumbs'])) return;
?>
<nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($page['breadcrumbs'] as $i => $crumb): ?>
            <?php $last = $i === array_key_last($page['breadcrumbs']); ?>
            <li class="breadcrumb-item <?= $last ? 'active' : '' ?>" <?= $last ? 'aria-current="page"' : '' ?>>
                <?php if (!$last): ?>
                    <a href="<?= e(url($crumb['url'])) ?>"><?= e($crumb['name']) ?></a>
                <?php else: ?>
                    <?= e($crumb['name']) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
