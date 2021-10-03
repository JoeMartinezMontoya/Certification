<h1>Inscription</h1>

<form action="" method="post">
    <label for="mail">
        <input type="email" name="mail" class="form-input" value="<?= $_POST['mail'] ?? '' ?>"
               placeholder="Votre adresse mail">
    </label>
    <label for="username">
        <input type="text" name="username" class="form-input" value="<?= $_POST['username'] ?? '' ?>"
               placeholder="Choisissez un pseudo">
    </label>
    <label for="password">
        <input type="password" name="password" class="form-input"
                  placeholder="Choisissez un mot de passe" value="<?= $_POST['password'] ?? '' ?>">
    </label>
    <label for="confirm_password">
        <input type="password" name="confirm_password" class="form-input"
                  placeholder="Confirmez votre mot de passe" value="<?= $_POST['confirm_password'] ?? '' ?>">
    </label>
    <button type="submit" class="form-submit">S'inscrire</button>
</form>