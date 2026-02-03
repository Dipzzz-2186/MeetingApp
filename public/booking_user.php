<?php
require_once __DIR__ . '/../app/helpers/layout.php';
require_login();
refresh_user($pdo);
$user = current_user();

$notice = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = (int)($_POST['room_id'] ?? 0);
    $start = normalize_datetime($_POST['start_time'] ?? '');
    $end = normalize_datetime($_POST['end_time'] ?? '');
    $purpose = trim($_POST['purpose'] ?? '');

    if ($room_id <= 0 || $start === '' || $end === '') {
        $error = 'Semua field wajib diisi.';
    } elseif (strtotime($end) <= strtotime($start)) {
        $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
    } elseif (!is_room_available($pdo, $room_id, $start, $end)) {
        $error = 'Room sudah terbooking pada waktu tersebut.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO bookings (admin_id, user_id, room_id, start_time, end_time, purpose, created_at)
            VALUES (:admin_id, :user_id, :room_id, :start_time, :end_time, :purpose, :created_at)');
        $stmt->execute([
            ':admin_id' => $user['owner_admin_id'],
            ':user_id' => $user['id'],
            ':room_id' => $room_id,
            ':start_time' => $start,
            ':end_time' => $end,
            ':purpose' => $purpose,
            ':created_at' => now_iso(),
        ]);
        $notice = 'Booking berhasil dibuat.';
    }
}

$stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY name ASC');
$stmt->execute([':owner_admin_id' => $user['owner_admin_id']]);
$rooms = $stmt->fetchAll();

render_header('Booking User');
?>

<div class="grid two">
  <div class="card">
    <h1>Buat Booking</h1>
    <?php if ($notice): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
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
      <button type="submit">Booking</button>
    </form>
  </div>
  <div class="card">
    <h2>Room Tersedia</h2>
    <div class="grid">
      <?php foreach ($rooms as $row): ?>
        <div class="badge"><?php echo htmlspecialchars($row['name']); ?> (<?php echo (int)$row['capacity']; ?>)</div>
      <?php endforeach; ?>
      <?php if (!$rooms): ?>
        <p class="muted">Belum ada room.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php render_footer(); ?>
