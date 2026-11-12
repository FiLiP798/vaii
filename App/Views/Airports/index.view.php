<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Airport[] $airports */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<section class="page-heading"><div><h1>Letiská</h1><p>Katalóg letísk a prehľad navštívených miest</p></div><a class="button button-primary" href="#airport-form">＋ Pridať letisko</a></section>
<section class="stats-grid" aria-label="Štatistiky letísk">
    <article class="stat-card"><p class="stat-label">Navštívené letiská</p><p class="stat-value"><?= number_format($visitedCount, 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Letiská v katalógu</p><p class="stat-value"><?= number_format(count($airports), 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Zaznamenané lety</p><p class="stat-value"><?= number_format($flightCount, 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Najčastejšie letisko</p><p class="stat-value stat-value-small"><?php if ($topAirport): ?><?= $e($topAirport->iata_code) ?> - <?= $e($topAirport->city) ?><br><span><?= number_format($topVisits, 0, ',', ' ') ?> návštev</span><?php else: ?>—<br><span>Zatiaľ bez letov</span><?php endif; ?></p></article>
</section>
<section class="section panel table-panel"><div class="table-heading"><h2>Letiská a počet návštev</h2></div><div class="table-wrap"><table>
<thead><tr><th>IATA</th><th>Letisko</th><th>Mesto</th><th>Krajina</th><th>Návštevy</th><th>Akcie</th></tr></thead><tbody>
<?php if (!$airports): ?><tr><td colspan="6">Katalóg je zatiaľ prázdny.</td></tr><?php endif; ?>
<?php foreach ($airports as $airport): ?><tr>
    <td data-label="IATA"><strong><?= $e($airport->iata_code) ?></strong><?php if ($airport->icao_code): ?><br><small><?= $e($airport->icao_code) ?></small><?php endif; ?></td>
    <td data-label="Letisko"><?= $e($airport->name) ?></td><td data-label="Mesto"><?= $e($airport->city) ?></td><td data-label="Krajina"><?= $e($airport->country) ?></td>
    <td data-label="Návštevy"><?= number_format($visits[(string)$airport->id] ?? 0, 0, ',', ' ') ?></td>
    <td data-label="Akcie"><div class="actions"><a class="button button-secondary action-button" href="<?= $link->url('airports.edit', ['id' => $airport->id]) ?>">Upraviť</a><form method="post" action="<?= $link->url('airports.delete') ?>" onsubmit="return confirm('Vymazať letisko z katalógu? Letisko použité v lete nemožno vymazať.')"><input type="hidden" name="id" value="<?= $e($airport->id) ?>"><button class="button-secondary action-button" type="submit">Zmazať</button></form></div></td>
</tr><?php endforeach; ?>
</tbody></table></div></section>
<section id="airport-form" class="section panel"><h2 class="section-title">Pridať letisko do katalógu</h2>
<?php if (!empty($error)): ?><p class="form-error" role="alert"><?= $e($error) ?></p><?php endif; ?>
<?php $airport = $airportForm ?? new \App\Models\Airport(); $formAction = $link->url('airports.create'); $submitLabel = 'Uložiť letisko'; include __DIR__ . '/fields.view.php'; ?>
</section>
