<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$faqs = $faqs ?? [];
$id = $id ?? 'faq';
if (!$faqs) return;
?>
<div class="accordion" id="<?= e($id) ?>">
    <?php foreach ($faqs as $i => $faq): ?>
        <div class="accordion-item">
            <h3 class="accordion-header" id="<?= e($id) ?>-h-<?= $i ?>">
                <button class="accordion-button <?= $i ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= e($id) ?>-c-<?= $i ?>" aria-expanded="<?= $i ? 'false' : 'true' ?>" aria-controls="<?= e($id) ?>-c-<?= $i ?>">
                    <?= e($faq['q']) ?>
                </button>
            </h3>
            <div id="<?= e($id) ?>-c-<?= $i ?>" class="accordion-collapse collapse <?= $i ? '' : 'show' ?>" data-bs-parent="#<?= e($id) ?>">
                <div class="accordion-body"><?= e($faq['a']) ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
