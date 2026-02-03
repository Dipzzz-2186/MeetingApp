<?php
/** @var array $stats */
?>

<h1>Dashboard Super Admin</h1>

<div class="grid three">
    <div class="card">
        <h3>Total Admin</h3>
        <p class="muted"><?= (int)$stats['admins'] ?> akun</p>
    </div>

    <div class="card">
        <h3>Total User</h3>
        <p class="muted"><?= (int)$stats['users'] ?> akun</p>
    </div>

    <div class="card">
        <h3>Total Booking</h3>
        <p class="muted"><?= (int)$stats['bookings'] ?> jadwal</p>
    </div>
</div>

<div class="card" style="margin-top:20px">
    <h3>Akses Super Admin</h3>
    <p class="muted">
        Anda memiliki akses penuh ke seluruh admin, user, room, dan booking.
    </p>
</div>
