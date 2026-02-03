<?php
require_once __DIR__ . '/../app/helpers/layout.php';

if (current_user()) {
    $target = current_user()['role'] === 'admin' ? 'dashboard_admin' : 'dashboard_user';
    header('Location: ' . $target);
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        login_user($user);
        $target = $user['role'] === 'admin' ? 'dashboard_admin' : 'dashboard_user';
        header('Location: ' . $target);
        exit;
    }
    $error = 'Email atau password salah.';
}

render_header('Login', 'auth');
?>

<div class="auth-layout">
  <div class="auth-side">
    <div class="auth-mini">
    </div>
    <div class="doodle note"></div>
    <div class="doodle dots"></div>
    <div class="doodle card"></div>
  </div>

  <div class="auth-card">
    <h1>Admin Login</h1>
    <p class="muted">Masuk untuk mengelola meeting room dan jadwal.</p>
    <?php if ($error): ?>
      <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Email</label>
        <input type="email" name="email" placeholder="you@company.com" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" placeholder="????????" required>
      </div>
      <button type="submit">Sign in</button>
      <div class="auth-foot">
        <span class="muted">Belum punya admin?</span>
        <a href="register">Register sekarang</a>
      </div>
    </form>
  </div>

  <div class="auth-side right">
    <div class="doodle woman"></div>
    <div class="doodle dots"></div>
    <div class="doodle stack"></div>
  </div>
</div>

<?php render_footer(); ?>
