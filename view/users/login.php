<h1>Connexion</h1>

<form action="" method="post">
    <label for="username">
        <input type="text" name="mail" class="form-input" value="<?= $_POST['mail'] ?? '' ?>"
               placeholder="Votre adresse mail">
    </label>
    <label for="password">
        <input type="password" name="password" class="form-input"
               placeholder="Mot de passe" value="<?= $_POST['password'] ?? '' ?>">
    </label>
    <button type="submit" class="form-submit">Se connecter</button>
</form>
