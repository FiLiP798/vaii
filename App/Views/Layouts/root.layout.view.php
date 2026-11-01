<?php
/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="mySkyLog – osobný denník letov.">
    <title>mySkyLog – Osobný denník letov</title>
    <link rel="stylesheet" href="<?= $link->asset('css/myskylog.css') ?>">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="<?= $link->url('home.index') ?>" aria-label="mySkyLog – úvod">
            <h1 class="brand-name">mySkyLog</h1>
            <p class="brand-subtitle">Osobný denník letov</p>
        </a>
        <?php $currentAction = $_GET['a'] ?? 'index'; ?>
        <nav class="main-nav" aria-label="Hlavná navigácia">
            <a href="<?= $link->url('home.index') ?>" <?= $currentAction === 'index' ? 'aria-current="page"' : '' ?>>Prehľad</a>
            <a href="<?= $link->url('home.flights') ?>" <?= $currentAction === 'flights' ? 'aria-current="page"' : '' ?>>Môj denník letov</a>
            <a href="<?= $link->url('home.flights') ?>#letiska">Letiská</a>
            <a href="<?= $link->url('home.flights') ?>#spolocnosti">Letecké spoločnosti</a>
        </nav>
        <div class="user-area"><span class="avatar" aria-hidden="true">F</span><span>Filip</span></div>
    </div>
</header>
<main>
    <?= $contentHTML ?>
</main>
<footer class="site-footer">
    <div class="footer-inner"><strong>mySkyLog</strong><span>© <?= date('Y') ?> – mySkyLog. Všetky práva vyhradené.</span></div>
</footer>
</body>
</html>