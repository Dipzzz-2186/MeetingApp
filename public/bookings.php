<?php
require_once __DIR__ . '/../app/helpers/layout.php';
require_admin();
refresh_user($pdo);
$user = current_user();

if (admin_plan_blocked($user)) {
    header('Location: dashboard_admin');
    exit;
}

$notice = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)($_POST['user_id'] ?? 0);
    $room_id = (int)($_POST['room_id'] ?? 0);
    $start = normalize_datetime($_POST['start_time'] ?? '');
    $end = normalize_datetime($_POST['end_time'] ?? '');
    $purpose = trim($_POST['purpose'] ?? '');

    if ($user_id <= 0 || $room_id <= 0 || $start === '' || $end === '') {
        $error = 'Semua field wajib diisi.';
    } elseif (strtotime($end) <= strtotime($start)) {
        $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
    } elseif (!is_room_available($pdo, $room_id, $start, $end)) {
        $error = 'Room sudah terbooking pada waktu tersebut.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO bookings (admin_id, user_id, room_id, start_time, end_time, purpose, created_at)
            VALUES (:admin_id, :user_id, :room_id, :start_time, :end_time, :purpose, :created_at)');
        $stmt->execute([
            ':admin_id' => $user['id'],
            ':user_id' => $user_id,
            ':room_id' => $room_id,
            ':start_time' => $start,
            ':end_time' => $end,
            ':purpose' => $purpose,
            ':created_at' => now_iso(),
        ]);
        $notice = 'Booking berhasil dibuat.';
    }
}

$stmt = $pdo->prepare("SELECT id, name FROM users WHERE role = 'user' AND owner_admin_id = :owner_admin_id ORDER BY name ASC");
$stmt->execute([':owner_admin_id' => $user['id']]);
$users = $stmt->fetchAll();
$stmt = $pdo->prepare('SELECT id, name FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY name ASC');
$stmt->execute([':owner_admin_id' => $user['id']]);
$rooms = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name, users.name AS user_name
  FROM bookings
  JOIN rooms ON rooms.id = bookings.room_id
  JOIN users ON users.id = bookings.user_id
  WHERE bookings.admin_id = :admin_id
  ORDER BY start_time DESC');
$stmt->execute([':admin_id' => $user['id']]);
$bookings = $stmt->fetchAll();

render_header('Scheduling');
?>

<div class="grid two">
  <div class="card">
    <h1>Scheduling</h1>
    <?php if ($notice): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>User</label>
        <select name="user_id" required>
          <option value="">Pilih user</option>
          <?php foreach ($users as $row): ?>
            <option value="<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label>Room</label>
        <select name="room_id" required>
          <option value="">Pilih room</option>
          <?php foreach ($rooms as $row): ?>
            <option value="<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label>Mulai</label>
        <input type="datetime-local" name="start_time" required>
      </div>
      <div>
        <label>Selesai</label>
        <input type="datetime-local" name="end_time" required>
      </div>
      <div>
        <label>Tujuan</label>
        <input type="text" name="purpose">
      </div>
      <button type="submit">Buat Booking</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar Booking</h2>
    <table class="table">
      <thead><tr><th>User</th><th>Room</th><th>Mulai</th><th>Selesai</th></tr></thead>
      <tbody>
        <?php foreach ($bookings as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['room_name']); ?></td>
            <td><?php echo htmlspecialchars($row['start_time']); ?></td>
            <td><?php echo htmlspecialchars($row['end_time']); ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$bookings): ?>
          <tr><td colspan="4" class="muted">Belum ada booking.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php render_footer(); ?>
