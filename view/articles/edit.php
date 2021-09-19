<h1>Modifier l'article</h1>

<form action="" method="post">
    <label for="title">
        <input type="text" name="title" class="form-input" value="<?= $article['title'] ?>"
               placeholder="Titre de votre article">
    </label>
    <label for="content">
        <textarea name="content" class="form-textarea"
                  placeholder="Contenu de l'article"><?= $article['content'] ?></textarea>
    </label>
    <button type="submit" class="form-submit">Enregistrer</button>
</form>
