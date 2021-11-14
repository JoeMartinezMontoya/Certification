<h1>Tout les articles</h1>

<table class="dashboard-table">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= $article['title'] ?></td>
            <td>
                <button class="crud-button edit"><a href="articles/edit/<?= $article['slug'] . '/' . $article['id'] ?>" title="edition">
                        <i class="fas fa-pen"></i>
                    </a>
                </button>
                <button class="crud-button alert" title="delete">
                    <a href="articles/delete/<?= $article['id'] ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </button>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>