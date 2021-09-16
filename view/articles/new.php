<h1>Nouvel article</h1>

<div class="wrapper">
    <form action="" method="post">
        <label for="title">
            <input type="text" name="title" class="form-input" value="<?= $_POST['title'] ?? '' ?>" placeholder="Titre de votre article">
        </label>
        <label for="content">
            <textarea name="content" class="form-textarea" placeholder="Contenu de l'article"><?= $_POST['content'] ?? '' ?></textarea>
        </label>
        <button type="submit">Envoyer</button>
    </form>
</div>
