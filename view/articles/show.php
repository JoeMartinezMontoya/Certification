<div class="article-wrapper">
    <h1><?= $article['title'] ?></h1>
    <p><?= $article['content'] ?></p>
    <small>Publié le <?= $article['created_at'] ?></small>
</div>
<div class="crud-bar">
    <button class="crud-button alert" title="delete">
        <a href="#">
            <i class="fas fa-trash"></i>
        </a>
    </button>
    <button class="crud-button edit">
        <a href="#" title="edition">
            <i class="fas fa-pen"></i>
        </a>
    </button>
</div>