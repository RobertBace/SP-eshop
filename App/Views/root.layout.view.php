<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
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
            <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll " style="--bs-scroll-height: 400px;">
                <a href="#" class="navbar-brand mb-0 h1 ">
                    <img src="public/images/cart3.svg" class="logo" id="cart" alt="...">
                    <img src="public/images/red.png" class="logo indicator" id="cartIndicator" alt="...">
                    <a class = "indicatorNumber" id="cartIndicatorNum">0</a>
                </a>
                <li class=" dropdown menuText ">
                    <a class=" dropdown-toggle menuText" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Bicykle
                    </a>
                    <ul class="dropdown-menu z-Home">
                        <li><a class="dropdown-item" href="?c=products">Cestné bicykle</a></li>
                        <li><a class="dropdown-item" href="#">Horské bicykle</a></li>
                        <li><a class="dropdown-item" href="#">E-bicykle</a></li>
                    </ul>
                </li>

                <li class="menuText">
                    <a class="menuText" aria-current="page" href="?c=home&a=contact">Kontakt</a>
                </li>
            </ul>
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
</html>
