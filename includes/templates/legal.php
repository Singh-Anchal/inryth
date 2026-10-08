<?php
if (!defined('INRYTH')) { http_response_code(403); exit; }
$doc = $doc ?? [];
?>
<?php render('page-hero', ['title' => $doc['title'], 'lead' => $doc['lead']]); ?>
<section class="section">
    <div class="container-site prose" style="max-width:760px;">
        <?= $doc['html'] ?>
        <p class="small text-muted mt-5">This page is a professional placeholder and should be reviewed by a qualified advisor before relying on it as legal advice.</p>
    </div>
</section>
