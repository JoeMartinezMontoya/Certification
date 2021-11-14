<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Normalizing relative paths-->
    <base href="/lab/Certification/">
    <title>Certification</title>
    <!--STYLESHEETS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
          integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/app.css">
</head>
<!--BODY-->
<body>
<!--HEADER-->
<header>
    <!--MENU TOGGLER-->
    <div class="menu-button__wrapper">
        <div class="menu-button">
            <span class="menu-button__bar"></span>
            <span class="menu-button__bar"></span>
            <span class="menu-button__bar"></span>
        </div>
    </div>
    <!--MENU OVERLAY-->
    <div class="menu-overlay">
        <nav class="nav">
            <!--LINKS-->
            <a class="nav__item" href="">Accueil</a>
            <a class="nav__item" href="articles">Articles</a>
            <?php if (isset($_SESSION) && !empty($_SESSION)): ?>
                <a class="nav__item" href="articles/user_index">Mes articles</a>
                <?php if ($_SESSION['role'] === 2) : ?>
                    <a class="nav__item" href="admin">Panneau de contrôle</a>
                <?php endif ?>
            <?php endif ?>
        </nav>
        <div class="nav-bottom">
            <?php if (isset($_SESSION) && !empty($_SESSION)): ?>
                <a href="users/logout" class="btn btn-primary">Se déconnecter</a>
            <?php else: ?>
                <a href="users/register" class="btn btn-primary">S'inscrire</a>
                <a href="users/login" class="btn btn-primary">Se connecter</a>
            <?php endif ?>
        </div>
    </div>
</header>
<!--CONTENT-->
<div class="container">
    <?= $content ?>
</div>
<!--FOOTER-->
<!--SCRIPTS-->
<script src="src/js/jQuery.js"></script>
<script src="src/js/app.js"></script>
</body>
</html>