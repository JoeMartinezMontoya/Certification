<h1>Liste des articles</h1>
<small><?= count($articles) ?> résultat</small>

<?php foreach ($articles as $article): ?>
    <h2><a href="articles/show/<?= $article['slug'] ?>"><?= $article['title'] ?></a></h2>
    <p><?= $article['content'] ?></p>
<?php endforeach; ?>

<a href="articles/new">Créer un article</a>
