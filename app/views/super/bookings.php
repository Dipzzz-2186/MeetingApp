<?php
/** @var array $bookings */
?>

<h1>Semua Booking</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Room</th>
                <th>User</th>
                <th>Admin</th>
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['room_name']) ?></td>
                    <td><?= htmlspecialchars($b['user_name']) ?></td>
                    <td><?= htmlspecialchars($b['admin_name']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($b['start_time'])) ?></td>
                    <td><?= date('d M Y H:i', strtotime($b['end_time'])) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
