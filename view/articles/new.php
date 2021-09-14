<h1>Nouvel article</h1>

<form action="" method="post">
    <label for="title"> Titre :
        <input type="text" name="title" value="<?= $_POST['title'] ?? '' ?>">
    </label>
    <label for="content"> Contenu :
        <input type="text" name="content" value="<?= $_POST['content'] ?? '' ?>">
    </label>
    <button type="submit">Envoyer</button>
</form>