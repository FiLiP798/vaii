<?php
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="page-heading">
    <div>
        <h1>Vitajte späť, Filip!</h1>
        <p>Tu je rýchly prehľad vašich leteckých dobrodružstiev a štatistík.</p>
    </div>
    <a class="button button-primary" href="<?= $link->url('home.flights') ?>">Otvoriť denník letov</a>
</section>

<section class="stats-grid" aria-label="Súhrnné štatistiky">
    <article class="stat-card">
        <p class="stat-label">Celkový počet letov</p>
        <p class="stat-value">24</p>
    </article>
    <article class="stat-card">
        <p class="stat-label">Nalietaná vzdialenosť</p>
        <p class="stat-value">58 420 km</p>
    </article>
    <article class="stat-card">
        <p class="stat-label">Navštívené letiská</p>
        <p class="stat-value">18</p>
    </article>
    <article class="stat-card">
        <p class="stat-label">Celkové výdavky</p>
        <p class="stat-value">1 845,50 €</p>
    </article>
</section>

<section class="section panel table-panel" aria-labelledby="recent-flights-title">
    <div class="table-heading">
        <h2 id="recent-flights-title">Posledné pridané lety</h2>
        <a class="button button-secondary" href="<?= $link->url('home.flights') ?>">Zobraziť všetky</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th scope="col">Dátum</th>
                <th scope="col">Číslo letu</th>
                <th scope="col">Trasa</th>
                <th scope="col">Letecká spoločnosť</th>
                <th scope="col">Vzdialenosť</th>
                <th scope="col">Cena</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-label="Dátum">12. 06. 2026</td>
                <td data-label="Číslo letu">OK123</td>
                <td data-label="Trasa"><span class="route">VIE → BCN</span></td>
                <td data-label="Letecká spoločnosť" class="airline">Austrian Airlines</td>
                <td data-label="Vzdialenosť">1 360 km</td>
                <td data-label="Cena">145 €</td>
            </tr>
            <tr>
                <td data-label="Dátum">25. 05. 2026</td>
                <td data-label="Číslo letu">FR456</td>
                <td data-label="Trasa"><span class="route">BTS → STN</span></td>
                <td data-label="Letecká spoločnosť" class="airline">Ryanair</td>
                <td data-label="Vzdialenosť">1 280 km</td>
                <td data-label="Cena">12 000 míľ + 35 €</td>
            </tr>
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