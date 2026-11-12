<?php $e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); ?>
<form class="filters catalog-form" action="<?= $e($formAction) ?>" method="post" autocomplete="off">
<?php if ($airport->id !== null): ?><input type="hidden" name="id" value="<?= $e($airport->id) ?>"><?php endif; ?>
<div class="field"><label for="iata_code">Kód IATA</label><input id="iata_code" name="iata_code" maxlength="3" minlength="3" required value="<?= $e($airport->iata_code) ?>" placeholder="VIE"></div>
<div class="field"><label for="icao_code">Kód ICAO</label><input id="icao_code" name="icao_code" maxlength="4" value="<?= $e($airport->icao_code) ?>" placeholder="LOWW"></div>
<div class="field"><label for="name">Názov letiska</label><input id="name" name="name" maxlength="120" required value="<?= $e($airport->name) ?>"></div>
<div class="field"><label for="city">Mesto</label><input id="city" name="city" maxlength="100" required value="<?= $e($airport->city) ?>"></div>
<div class="field"><label for="country">Krajina</label><input id="country" name="country" maxlength="100" required value="<?= $e($airport->country) ?>"></div>
<div class="filter-actions"><button class="button-primary" type="submit"><?= $e($submitLabel) ?></button><a class="button button-secondary" href="<?= $link->url('airports.index') ?>">Zrušiť</a></div></form>
