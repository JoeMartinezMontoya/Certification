<h1>Liste des articles</h1>
<small><?= count($articles) ?> résultat</small>

<?php foreach ($articles as $article): ?>
    <h2>
        <a href="articles/show/<?= $article['slug'] ?>">
            <?= $article['title'] ?>
        </a>
    </h2>
    <p><?= $article['content'] ?></p>
<?php endforeach; ?>

<div class="crud-bar">
    <button class="crud-button">
        <a href="articles/new">
            <i class="fas fa-plus"></i>
        </a>
    </button>
</div>
