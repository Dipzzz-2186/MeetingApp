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
    $name = trim($_POST['name'] ?? '');
    $capacity = (int)($_POST['capacity'] ?? 0);

    if ($name === '' || $capacity <= 0) {
        $error = 'Nama room dan kapasitas wajib diisi.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO rooms (owner_admin_id, name, capacity, created_at) VALUES (:owner_admin_id, :name, :capacity, :created_at)');
            $stmt->execute([
                ':owner_admin_id' => $user['id'],
                ':name' => $name,
                ':capacity' => $capacity,
                ':created_at' => now_iso(),
            ]);
            $notice = 'Room berhasil ditambahkan.';
        } catch (PDOException $e) {
            $error = 'Nama room sudah digunakan.';
        }
    }
}

$stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY id DESC');
$stmt->execute([':owner_admin_id' => $user['id']]);
$rooms = $stmt->fetchAll();

render_header('Add Room');
?>

<div class="grid two">
  <div class="card">
    <h1>Add Room</h1>
    <?php if ($notice): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Nama Room</label>
        <input type="text" name="name" required>
      </div>
      <div>
        <label>Kapasitas</label>
        <input type="number" name="capacity" min="1" required>
      </div>
      <button type="submit">Tambah</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar Room</h2>
    <table class="table">
      <thead><tr><th>Nama</th><th>Kapasitas</th></tr></thead>
      <tbody>
        <?php foreach ($rooms as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo (int)$row['capacity']; ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$rooms): ?>
          <tr><td colspan="2" class="muted">Belum ada room.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php render_footer(); ?>
