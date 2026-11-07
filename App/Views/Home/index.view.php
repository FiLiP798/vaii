<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Flight[] $recentFlights */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<section class="page-heading">
    <div>
        <h1>Vitajte späť, Filip!</h1>
        <p>Tu je rýchly prehľad vašich leteckých dobrodružstiev a štatistík.</p>
    </div>
    <a class="button button-primary" href="<?= $link->url('home.flights') ?>">Otvoriť denník letov</a>
</section>

<section class="stats-grid" aria-label="Súhrnné štatistiky">
    <article class="stat-card"><p class="stat-label">Celkový počet letov</p><p class="stat-value"><?= number_format($flightCount, 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Nalietaná vzdialenosť</p><p class="stat-value"><?= number_format($totalDistance, 0, ',', ' ') ?> km</p></article>
    <article class="stat-card"><p class="stat-label">Navštívené letiská</p><p class="stat-value"><?= number_format($airportCount, 0, ',', ' ') ?></p></article>
    <article class="stat-card"><p class="stat-label">Celkové výdavky</p><p class="stat-value"><?= number_format($totalExpenses, 2, ',', ' ') ?> €</p></article>
</section>

<section class="section panel table-panel" aria-labelledby="recent-flights-title">
    <div class="table-heading">
        <h2 id="recent-flights-title">Posledné pridané lety</h2>
        <a class="button button-secondary" href="<?= $link->url('home.flights') ?>">Zobraziť všetky</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th scope="col">Dátum</th><th scope="col">Číslo letu</th><th scope="col">Trasa</th><th scope="col">Letecká spoločnosť</th><th scope="col">Vzdialenosť</th><th scope="col">Cena</th></tr></thead>
            <tbody>
            <?php if (!$recentFlights): ?>
                <tr><td colspan="6">Zatiaľ tu nie sú žiadne lety. Pridajte svoj prvý záznam do denníka.</td></tr>
            <?php endif; ?>
            <?php foreach ($recentFlights as $flight): ?>
                <tr>
                    <td data-label="Dátum"><?= $e(date('d. m. Y', strtotime((string)$flight->flight_date))) ?></td>
                    <td data-label="Číslo letu"><?= $e($flight->flight_number) ?></td>
                    <td data-label="Trasa"><span class="route"><?= $e($flight->departure_airport) ?> → <?= $e($flight->arrival_airport) ?></span></td>
                    <td data-label="Letecká spoločnosť" class="airline"><?= $e($flight->airline) ?></td>
                    <td data-label="Vzdialenosť"><?= $flight->distance_km !== null && $flight->distance_km !== '' ? number_format((int)$flight->distance_km, 0, ',', ' ') . ' km' : '—' ?></td>
                    <td data-label="Cena"><?= $flight->ticket_price !== null && $flight->ticket_price !== '' ? number_format((float)$flight->ticket_price, 2, ',', ' ') . ' €' : '—' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="section" aria-label="Rýchle akcie a informácie">
    <div class="quick-actions-grid">
        <article class="panel">
            <h2>Rýchla správa</h2>
            <p>Pridajte nový let do svojho denníka hneď po pristátí.</p>
            <a class="button button-primary" href="<?= $link->url('home.flights') ?>#formular-pridania">Pridať nový let</a>
        </article>
    </div>
</section>
