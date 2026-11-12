<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Airline $airline */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); $formAction = $link->url('airlines.update'); $submitLabel = 'Uložiť zmeny';
?>
<section class="page-heading"><div><h1>Upraviť spoločnosť</h1><p>Upravte údaje v katalógu aerolínií</p></div><a class="button button-secondary" href="<?= $link->url('airlines.index') ?>">Späť na spoločnosti</a></section>
<section class="section panel"><h2 class="section-title">Údaje spoločnosti</h2><?php if (!empty($error)): ?><p class="form-error" role="alert"><?= $e($error) ?></p><?php endif; ?><?php include __DIR__ . '/fields.view.php'; ?></section>
