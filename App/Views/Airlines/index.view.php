<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Airline[] $airlines */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<section class="page-heading"><div><h1>Letecké spoločnosti</h1><p>Katalóg aerolínií a prehľad najčastejších letov</p></div><a class="button button-primary" href="#airline-form">＋ Pridať spoločnosť</a></section>
<section class="stats-grid" aria-label="Štatistiky leteckých spoločností">
    <article class="stat-card"><p class="stat-label">Spoločnosti v katalógu</p><p class="stat-value"><?= number_format(count($airlines), 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Zaznamenané lety</p><p class="stat-value"><?= number_format($flightCount, 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Najčastejšia aerolínia</p><p class="stat-value stat-value-small"><?php if ($topAirline): ?><?= $e($topAirline->name) ?><br><span><?= number_format($topUses, 0, ',', ' ') ?> letov</span><?php else: ?>—<br><span>Zatiaľ bez letov</span><?php endif; ?></p></article>
    <article class="stat-card"><p class="stat-label">Rôzne aerolínie využité</p><p class="stat-value"><?= number_format(count($uses), 0, ',', ' ') ?></p></article>
</section>
<section class="section panel table-panel"><div class="table-heading"><h2>Prehľad spoločností</h2></div><div class="table-wrap"><table>
<thead><tr><th>Spoločnosť</th><th>IATA</th><th>ICAO</th><th>Krajina</th><th>Počet letov</th><th>Akcie</th></tr></thead><tbody>
<?php if (!$airlines): ?><tr><td colspan="6">Katalóg je zatiaľ prázdny.</td></tr><?php endif; ?>
<?php foreach ($airlines as $airline): ?><tr><td data-label="Spoločnosť"><strong><?= $e($airline->name) ?></strong></td><td data-label="IATA"><?= $e($airline->iata_code ?: '—') ?></td><td data-label="ICAO"><?= $e($airline->icao_code ?: '—') ?></td><td data-label="Krajina"><?= $e($airline->country ?: '—') ?></td><td data-label="Počet letov"><?= number_format($uses[(string)$airline->id] ?? 0, 0, ',', ' ') ?></td>
<td data-label="Akcie"><div class="actions"><a class="button button-secondary action-button" href="<?= $link->url('airlines.edit', ['id' => $airline->id]) ?>">Upraviť</a><form method="post" action="<?= $link->url('airlines.delete') ?>" onsubmit="return confirm('Vymazať spoločnosť z katalógu? Spoločnosť použitú v lete nemožno vymazať.')"><input type="hidden" name="id" value="<?= $e($airline->id) ?>"><button class="button-secondary action-button" type="submit">Zmazať</button></form></div></td></tr><?php endforeach; ?>
</tbody></table></div></section>
<section id="airline-form" class="section panel"><h2 class="section-title">Pridať spoločnosť do katalógu</h2>
<?php if (!empty($error)): ?><p class="form-error" role="alert"><?= $e($error) ?></p><?php endif; ?>
<?php $airline = $airlineForm ?? new \App\Models\Airline(); $formAction = $link->url('airlines.create'); $submitLabel = 'Uložiť spoločnosť'; include __DIR__ . '/fields.view.php'; ?>
</section>
