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
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/app.css">
</head>
<body>
<div id="navToggler"></div>
<div id="navLayout" class="d-none">
    <nav id="navMenu">
        <ul class="navMenu">
            <li class="navItem">
                <a href="" class="navLink">Accueil</a>
            </li>
            <li class="navItem">
                <a href="articles" class="navLink">Articles</a>
            </li>
        </ul>
    </nav>
</div>
<div class="container">
    <?= $content ?>
</div>
<script src="src/js/jQuery.js"></script>
<script src="src/js/app.js"></script>
</body>
</html>