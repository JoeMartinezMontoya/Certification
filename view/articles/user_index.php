<h1>Mes articles</h1>
<small><?= count($articles) ?> résultat</small>

<?php foreach ($articles as $article): ?>
    <div class="card">
        <h2>
            <a href="articles/show/<?= $article['slug'] ?>">
                <?= $article['title'] ?>
            </a>
        </h2>
        <p><?= $article['excerpt'] ?></p>
        <button class="card-link">
            <a href="articles/show/<?= $article['slug'] ?>">Voir plus...</a>
        </button>
    </div>
<?php endforeach; ?>

<div class="crud-bar">
    <button class="crud-button new">
        <a href="articles/new">
            <i class="fas fa-plus"></i>
        </a>
    </button>
</div>
