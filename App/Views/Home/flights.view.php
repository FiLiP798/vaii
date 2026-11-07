<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Flight[] $flights */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<section class="page-heading" aria-labelledby="page-title">
    <div><h1 id="page-title">Môj denník letov</h1><p>Prehľad a správa absolvovaných letov</p></div>
    <a class="button button-primary" href="#formular-pridania">＋ Pridať let</a>
</section>

<section class="section panel table-panel" aria-labelledby="flight-list-title">
    <div class="table-heading"><h2 id="flight-list-title">Zoznam letov (<?= count($flights) ?>)</h2></div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Dátum</th><th>Číslo letu</th><th>Trasa</th><th>Letecká spoločnosť</th><th>Vzdialenosť</th><th>Cena</th><th>Úhrada</th><th>Akcie</th></tr></thead>
            <tbody>
            <?php if (!$flights): ?>
                <tr><td colspan="8">Zatiaľ nemáte uložený žiadny let. Pridajte prvý záznam nižšie.</td></tr>
            <?php endif; ?>
            <?php foreach ($flights as $flight): ?>
                <tr>
                    <td data-label="Dátum"><?= $e($flight->flight_date) ?></td>
                    <td data-label="Číslo letu"><?= $e($flight->flight_number) ?></td>
                    <td data-label="Trasa"><span class="route"><?= $e($flight->departure_airport) ?> → <?= $e($flight->arrival_airport) ?></span></td>
                    <td data-label="Letecká spoločnosť" class="airline"><?= $e($flight->airline) ?></td>
                    <td data-label="Vzdialenosť"><?= $flight->distance_km !== null && $flight->distance_km !== '' ? $e($flight->distance_km) . ' km' : '—' ?></td>
                    <td data-label="Cena"><?= $flight->ticket_price !== null && $flight->ticket_price !== '' ? $e(number_format((float)$flight->ticket_price, 2, ',', ' ')) . ' €' : '—' ?></td>
                    <td data-label="Úhrada"><?= $e($flight->payment_method ?: 'Nezadané') ?></td>
                    <td data-label="Akcie"><div class="actions">
                        <a class="button button-secondary action-button" href="<?= $link->url('home.editFlight', ['id' => $flight->id]) ?>">Upraviť</a>
                        <form method="post" action="<?= $link->url('home.deleteFlight') ?>" onsubmit="return confirm('Naozaj chcete vymazať tento let?')">
                            <input type="hidden" name="id" value="<?= $e($flight->id) ?>"><button class="button-secondary action-button" type="submit">Zmazať</button>
                        </form>
                    </div></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section id="formular-pridania" class="section panel" aria-labelledby="add-flight-title">
    <h2 id="add-flight-title" class="section-title">Pridať let</h2>
    <?php $flight = new \App\Models\Flight(); $formAction = $link->url('home.createFlight'); $submitLabel = 'Uložiť let'; include __DIR__ . '/flight_fields.view.php'; ?>
</section>
