<div class="article-wrapper">
    <h1><?= $article['title'] ?></h1>
    <p><?= $article['content'] ?></p>
    <small>Publié le <?= $article['created_at'] ?></small>
    <?php if ($article['updated_at'] !== null): ?>
        <small>|| Modifié le <?= $article['updated_at'] ?></small>
    <?php endif ?>
</div>
<?php if ((int)$_SESSION['id'] === (int)$article['author_id']): ?>
    <div class="crud-bar">
        <button class="crud-button alert" title="delete">
            <a href="articles/delete/<?= $article['id'] ?>">
                <i class="fas fa-trash"></i>
            </a>
        </button>
        <button class="crud-button edit">
            <a href="articles/edit/<?= $article['slug'] . '/' . $article['id'] ?>" title="edition">
                <i class="fas fa-pen"></i>
            </a>
        </button>
    </div>
<?php endif ?>