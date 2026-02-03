<div class="auth-layout">
  <div class="auth-side">
    <div class="auth-mini">
    </div>
  </div>

  <div class="auth-card">
    <a class="auth-back" href="/">← Kembali ke Home</a>
    <h1>Admin Login</h1>
    <p class="muted">Masuk untuk mengelola meeting room dan jadwal.</p>
    <?php if (!empty($error)): ?>
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
        <a href="/register">Register sekarang</a>
      </div>
    </form>
  </div>
</div>
