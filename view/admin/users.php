<h1>Tout les utilisateurs</h1>

<table class="dashboard-table">
    <thead>
    <tr>
        <th>Mail</th>
        <th>Username</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['mail'] ?></td>
            <td><?= $user['username'] ?></td>
            <td>
                <button class="crud-button edit"><a href="admin/edit_user/<?= $user['id'] ?>" title="edition">
                        <i class="fas fa-pen"></i>
                    </a>
                </button>
                <button class="crud-button alert" title="delete">
                    <a href="#">
                        <i class="fas fa-trash"></i>
                    </a>
                </button>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>