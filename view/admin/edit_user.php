<h1>Editer <?= $user['username'] ?></h1>

<form action="" method="post">
    <label for="edit_user_username">
        <input class="form-input" type="text" name="edit_user_username" id="edit_user_username"
               value="<?= $user['username'] ?>">
    </label>
    <p class="form-p">Administrateur</p>
    <label for="edit_user_role">
        <input type="checkbox" name="edit_user_role" id="edit_user_role" <?= (int)$user['ref_role_id'] === 2 ? 'checked' : '' ?>>
    </label>
    <br>
    <button type="submit" class="form-submit">Enregistrer</button>
</form>
