<?php $e = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); ?>
<form class="filters catalog-form" action="<?= $e($formAction) ?>" method="post" autocomplete="off">
<?php if ($airline->id !== null): ?><input type="hidden" name="id" value="<?= $e($airline->id) ?>"><?php endif; ?>
<div class="field"><label for="name">Názov spoločnosti</label><input id="name" name="name" maxlength="120" required value="<?= $e($airline->name) ?>"></div>
<div class="field"><label for="iata_code">Kód IATA</label><input id="iata_code" name="iata_code" maxlength="2" value="<?= $e($airline->iata_code) ?>" placeholder="OS"></div>
<div class="field"><label for="icao_code">Kód ICAO</label><input id="icao_code" name="icao_code" maxlength="3" value="<?= $e($airline->icao_code) ?>" placeholder="AUA"></div>
<div class="field"><label for="country">Krajina</label><input id="country" name="country" maxlength="100" value="<?= $e($airline->country) ?>" ></div>
<div class="filter-actions"><button class="button-primary" type="submit"><?= $e($submitLabel) ?></button><a class="button button-secondary" href="<?= $link->url('airlines.index') ?>">Zrušiť</a></div></form>
