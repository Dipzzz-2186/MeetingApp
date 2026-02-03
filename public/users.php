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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Semua field wajib diisi.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (owner_admin_id, name, email, password_hash, role, created_at)
                VALUES (:owner_admin_id, :name, :email, :password_hash, :role, :created_at)');
            $stmt->execute([
                ':owner_admin_id' => $user['id'],
                ':name' => $name,
                ':email' => $email,
                ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
                ':role' => 'user',
                ':created_at' => now_iso(),
            ]);
            $notice = 'User berhasil ditambahkan.';
        } catch (PDOException $e) {
            $error = 'Email sudah digunakan.';
        }
    }
}

$stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE owner_admin_id = :owner_admin_id AND role = 'user' ORDER BY id DESC");
$stmt->execute([':owner_admin_id' => $user['id']]);
$users = $stmt->fetchAll();

render_header('Add User');
?>

<div class="grid two">
  <div class="card">
    <h1>Add User</h1>
    <?php if ($notice): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Nama</label>
        <input type="text" name="name" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit">Tambah</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar User</h2>
    <table class="table">
      <thead><tr><th>Nama</th><th>Email</th><th>Role</th></tr></thead>
      <tbody>
        <?php foreach ($users as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$users): ?>
          <tr><td colspan="3" class="muted">Belum ada user.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php render_footer(); ?>
