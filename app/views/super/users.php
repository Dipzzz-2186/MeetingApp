<?php
/** @var array $users */
?>

<h1>Daftar User</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Admin Pemilik</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['admin_name'] ?? '-') ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
