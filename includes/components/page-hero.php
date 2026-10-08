<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$title = $title ?? '';
$lead = $lead ?? '';
?>
<section class="page-hero">
    <div class="container-site">
        <?php render('breadcrumb'); ?>
        <h1 class="section-title mb-2"><?= e($title) ?></h1>
        <?php if ($lead): ?><p class="section-lead"><?= e($lead) ?></p><?php endif; ?>
        <?php if (!empty($actions)): ?>
            <div class="btn-group mt-4">
                <?php foreach ($actions as $action): ?>
                    <a class="btn <?= e($action['class'] ?? '') ?>" href="<?= e($action['external'] ?? false ? $action['href'] : url($action['href'])) ?>" <?= !empty($action['external']) ? 'target="_blank" rel="noopener"' : '' ?>><?= e($action['label']) ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
