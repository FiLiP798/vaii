<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Flight $flight */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$formAction = $link->url('home.updateFlight');
$submitLabel = 'Uložiť zmeny';
?>
<section class="page-heading"><div><h1>Upraviť let</h1><p>Upravte údaje v denníku</p></div><a class="button button-secondary" href="<?= $link->url('home.flights') ?>">Späť na denník</a></section>
<section class="section panel" aria-labelledby="edit-flight-title">
    <h2 id="edit-flight-title" class="section-title">Údaje o lete</h2>
    <?php include __DIR__ . '/flight_fields.view.php'; ?>
</section>
