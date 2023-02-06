<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg menu co">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand mb-0 h1">
            <img src="public/images/logo.webp" class="logo" alt="logo firmy">
        </a>
        <a class="brand" href="index.php">All4Cycling</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ms-3" id="navbarScroll">
            <div class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll " style="--bs-scroll-height: 400px;">
                <a href="?c=orders&a=index" >
                    <img src="public/images/cart3.svg" class="logo" id="cart" alt="...">
                </a>
                <img src="public/images/red.png" class="logo indicator" id="cartIndicator" alt="...">

                <a class="indicatorNumber" id="cartIndicatorNum">0</a>
                <div class=" dropdown menuText ">
                    <a class=" dropdown-toggle menuText" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Bicykle
                    </a>
                    <ul class="dropdown-menu z-Home">
                        <li><a class="dropdown-item" href="?c=products&a=cestne">Cestné bicykle</a></li>
                        <li><a class="dropdown-item" href="?c=products&a=horske">Horské bicykle</a></li>
                        <li><a class="dropdown-item" href="?c=products&a=ebike">E-bicykle</a></li>
                    </ul>
                </div>

                <div class="menuText">
                    <a class="menuText" aria-current="page" href="?c=home&a=contact">Kontakt</a>
                </div>

                <?php if (!$auth->isLogged()) { ?>
                    <div class="menuText">
                        <a class="menuText" aria-current="page" href="?c=auth&a=login">Prihlasiť sa</a>
                    </div>
                <?php } else { ?>
                    <div class=" dropdown menuText ">
                        <a class=" dropdown-toggle menuText" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?= \App\Models\User::getOne($auth->getLoggedUserId())->getUsername() ?>
                        </a>
                        <ul class="dropdown-menu z-Home dropdownM">
                            <li><a class="dropdown-item " href="?c=auth&a=logout">Odhlasiť sa</a></li>
                            <li><a class="dropdown-item " href="?c=auth&a=edit">Uprav profil</a></li>
                            <li><a class="dropdown-item " href="?c=orders&a=index">Moje objednovky</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>