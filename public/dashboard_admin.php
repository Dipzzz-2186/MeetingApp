<?php
require_once __DIR__ . '/../app/helpers/layout.php';
require_admin();
refresh_user($pdo);
$user = current_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'mark_paid') {
        $paid_until = date('Y-m-d H:i:s', strtotime('+30 days'));
        $stmt = $pdo->prepare('UPDATE users SET plan_type = "permanent", paid_until = :paid_until WHERE id = :id');
        $stmt->execute([':paid_until' => $paid_until, ':id' => $user['id']]);
    }
    if ($action === 'extend_paid') {
        $date = normalize_datetime($_POST['paid_until'] ?? '');
        if ($date !== '') {
            $stmt = $pdo->prepare('UPDATE users SET plan_type = "permanent", paid_until = :paid_until WHERE id = :id');
            $stmt->execute([':paid_until' => $date, ':id' => $user['id']]);
        }
    }
    if ($action === 'reset_trial') {
        $trial_end = date('Y-m-d H:i:s', strtotime('+10 days'));
        $stmt = $pdo->prepare('UPDATE users SET plan_type = "trial", trial_end = :trial_end, paid_until = NULL WHERE id = :id');
        $stmt->execute([':trial_end' => $trial_end, ':id' => $user['id']]);
    }
    refresh_user($pdo);
    $user = current_user();
}

$plan_message = admin_plan_message($user);
$blocked = admin_plan_blocked($user);

$stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name, users.name AS user_name
  FROM bookings
  JOIN rooms ON rooms.id = bookings.room_id
  JOIN users ON users.id = bookings.user_id
  WHERE bookings.admin_id = :admin_id
  ORDER BY start_time DESC
  LIMIT 5');
$stmt->execute([':admin_id' => $user['id']]);
$recent = $stmt->fetchAll();

render_header('Dashboard Admin');
?>

<div class="grid two">
  <div class="card">
    <h1>Dashboard Admin</h1>
    <?php if ($plan_message): ?>
      <div class="alert"><?php echo htmlspecialchars($plan_message); ?></div>
    <?php endif; ?>
    <?php if ($blocked): ?>
      <div class="alert">Akses scheduling diblokir karena masa trial/pembayaran habis.</div>
    <?php endif; ?>
    <div class="grid">
      <a href="users">Add User</a>
      <a href="rooms">Add Room</a>
      <a href="bookings">Scheduling</a>
    </div>
  </div>
  <div class="card">
    <h2>Kelola Paket</h2>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="mark_paid">
      <button class="secondary" type="submit">Bayar / Aktifkan 30 Hari</button>
    </form>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="extend_paid">
      <label>Atur Tanggal Paid Until</label>
      <input type="datetime-local" name="paid_until">
      <button type="submit">Simpan</button>
    </form>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="reset_trial">
      <button type="submit">Reset Trial 10 Hari</button>
    </form>
  </div>
</div>

<div class="card">
  <h2>Recent Bookings</h2>
  <table class="table">
    <thead>
      <tr><th>User</th><th>Room</th><th>Mulai</th><th>Selesai</th></tr>
    </thead>
    <tbody>
    <?php foreach ($recent as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$recent): ?>
      <tr><td colspan="4" class="muted">Belum ada booking.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<?php render_footer(); ?>
