<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$study = $study ?? [];
?>
<article class="card-premium">
    <span class="chip"><?= e($study['industry']) ?></span>
    <h3 class="mt-3"><?= e($study['name']) ?></h3>
    <p><?= e($study['summary']) ?></p>
    <p class="mt-3 mb-0"><a class="fw-bold" href="<?= e(url($study['url'])) ?>">Read case study →</a></p>
</article>
