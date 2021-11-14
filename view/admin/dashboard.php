<h1>Dashboard</h1>

<div class="container d-flex row">
    <div class="bubble">
        <h2>Nombre d'utilisateurs</h2>
        <p class="counter"><?= $stats['usersCount'] ?></p>
        <a href="admin/users">Gérer</a>
    </div>
    <div class="bubble">
        <h2>Nombre d'articles crées</h2>
        <p class="counter"><?= $stats['articlesCount'] ?></p>
        <a href="admin/articles">Gérer</a>
    </div>
    <div class="bubble">
        <h2>Nombre de commentaires</h2>
        <a href="#">Gérer</a>
    </div>
</div>