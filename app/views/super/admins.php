<?php
/** @var array $admins */
?>

<h1>Daftar Admin</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Plan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['name']) ?></td>
                    <td><?= htmlspecialchars($a['email']) ?></td>
                    <td><?= htmlspecialchars($a['plan_type']) ?></td>
                    <td>
                        <?php if ($a['plan_type'] === 'trial'): ?>
                            <span class="badge">Trial</span>
                        <?php else: ?>
                            <span class="badge">Paid</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
