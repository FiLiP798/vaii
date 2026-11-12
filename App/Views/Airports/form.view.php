<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Airport $airport */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); $formAction = $link->url('airports.update'); $submitLabel = 'Uložiť zmeny';
?>
<section class="page-heading"><div><h1>Upraviť letisko</h1><p>Upravte údaje letiska v katalógu</p></div><a class="button button-secondary" href="<?= $link->url('airports.index') ?>">Späť na letiská</a></section>
<section class="section panel"><h2 class="section-title">Údaje letiska</h2><?php if (!empty($error)): ?><p class="form-error" role="alert"><?= $e($error) ?></p><?php endif; ?><?php include __DIR__ . '/fields.view.php'; ?></section>
