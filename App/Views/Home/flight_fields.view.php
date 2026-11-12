<?php
/** Shared create/update form fields. */
$e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<form class="filters flight-form" action="<?= $e($formAction) ?>" method="post">
    <p class="form-hint">Ak letisko alebo spoločnosť chýba, pridajte položku a potom obnovte tento formulár.</p>
    <?php if ($flight->id !== null): ?><input type="hidden" name="id" value="<?= $e($flight->id) ?>"><?php endif; ?>
    <div class="field"><label for="flight_number">Číslo letu</label><input id="flight_number" name="flight_number" maxlength="20" required value="<?= $e($flight->flight_number) ?>" placeholder="Napr. OK123"></div>
    <div class="field"><label for="departure_airport_id">Odletové letisko</label><select id="departure_airport_id" name="departure_airport_id" required><option value="">Vyberte letisko</option><?php foreach ($airports as $airport): ?><option value="<?= $e($airport->id) ?>" <?= (string)$flight->departure_airport_id === (string)$airport->id ? 'selected' : '' ?>><?= $e($airport->iata_code . ' · ' . $airport->city . ' — ' . $airport->name) ?></option><?php endforeach; ?></select></div>
    <div class="field"><label for="arrival_airport_id">Príletové letisko</label><select id="arrival_airport_id" name="arrival_airport_id" required><option value="">Vyberte letisko</option><?php foreach ($airports as $airport): ?><option value="<?= $e($airport->id) ?>" <?= (string)$flight->arrival_airport_id === (string)$airport->id ? 'selected' : '' ?>><?= $e($airport->iata_code . ' · ' . $airport->city . ' — ' . $airport->name) ?></option><?php endforeach; ?></select></div>
    <div class="field"><label for="airline_id">Letecká spoločnosť</label><select id="airline_id" name="airline_id" required><option value="">Vyberte spoločnosť</option><?php foreach ($airlines as $airline): ?><option value="<?= $e($airline->id) ?>" <?= (string)$flight->airline_id === (string)$airline->id ? 'selected' : '' ?>><?= $e(($airline->iata_code ? $airline->iata_code . ' · ' : '') . $airline->name) ?></option><?php endforeach; ?></select></div>
    <div class="field"><label for="flight_date">Dátum letu</label><input id="flight_date" name="flight_date" type="date" required value="<?= $e($flight->flight_date) ?>"></div>
    <div class="field"><label for="distance_km">Vzdialenosť (km)</label><input id="distance_km" name="distance_km" type="number" min="0" step="1" value="<?= $e($flight->distance_km) ?>"></div>
    <div class="field"><label for="ticket_price">Cena (€)</label><input id="ticket_price" name="ticket_price" type="number" min="0" step="0.01" value="<?= $e($flight->ticket_price) ?>"></div>
    <div class="field"><label for="payment_method">Spôsob úhrady</label><select id="payment_method" name="payment_method"><option value="">Nezadané</option><?php foreach (['Peniaze', 'Míle', 'Kombinácia'] as $method): ?><option value="<?= $e($method) ?>" <?= $flight->payment_method === $method ? 'selected' : '' ?>><?= $e($method) ?></option><?php endforeach; ?></select></div>
    <div class="field flight-notes"><label for="notes">Poznámka</label><textarea id="notes" name="notes" rows="3" maxlength="2000"><?= $e($flight->notes) ?></textarea></div>
    <div class="filter-actions"><button class="button-primary" type="submit"><?= $e($submitLabel) ?></button><a class="button button-secondary" href="<?= $link->url('home.flights') ?>">Zrušiť</a></div>
</form>
