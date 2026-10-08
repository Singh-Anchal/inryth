<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$align = $align ?? '';
?>
<div class="section-head <?= e($align) ?>">
    <?php if (!empty($kicker)): ?><p class="section-kicker"><?= e($kicker) ?></p><?php endif; ?>
    <h2 class="section-title"><?= e($title) ?></h2>
    <?php if (!empty($lead)): ?><p class="section-lead"><?= e($lead) ?></p><?php endif; ?>
</div>
