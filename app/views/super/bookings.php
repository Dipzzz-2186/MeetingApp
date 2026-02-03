<?php
/** @var array $bookings */
?>

<h1>Semua Booking</h1>

<div class="card">
    <div class="table-wrap">
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
</div>
<style>       
    .table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 640px;
    }
</style>