<?php
require_once __DIR__ . '/../app/helpers/layout.php';
require_login();
refresh_user($pdo);
$user = current_user();

$stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name
  FROM bookings
  JOIN rooms ON rooms.id = bookings.room_id
  WHERE bookings.user_id = :uid AND bookings.admin_id = :admin_id
  ORDER BY start_time DESC');
$stmt->execute([':uid' => $user['id'], ':admin_id' => $user['owner_admin_id']]);
$my_bookings = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY name ASC');
$stmt->execute([':owner_admin_id' => $user['owner_admin_id']]);
$rooms = $stmt->fetchAll();

render_header('Dashboard User');
?>

<div class="grid two">
  <div class="card">
    <h1>Halo, <?php echo htmlspecialchars($user['name']); ?></h1>
    <p class="muted">Lihat room yang tersedia dan buat booking meeting.</p>
    <a href="booking_user">Buat Booking</a>
  </div>
  <div class="card">
    <h2>Room Tersedia</h2>
    <div class="grid">
      <?php foreach ($rooms as $room): ?>
        <div class="badge"><?php echo htmlspecialchars($room['name']); ?> (<?php echo (int)$room['capacity']; ?>)</div>
      <?php endforeach; ?>
      <?php if (!$rooms): ?>
        <p class="muted">Belum ada room.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="card">
  <h2>Booking Saya</h2>
  <table class="table">
    <thead>
      <tr><th>Room</th><th>Mulai</th><th>Selesai</th><th>Tujuan</th></tr>
    </thead>
    <tbody>
    <?php foreach ($my_bookings as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
        <td><?php echo htmlspecialchars($row['purpose'] ?? '-'); ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$my_bookings): ?>
      <tr><td colspan="4" class="muted">Belum ada booking.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<?php render_footer(); ?>
