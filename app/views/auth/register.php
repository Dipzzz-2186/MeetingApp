<div class="auth-layout">
  <div class="auth-side">
    <div class="auth-mini">
      <div class="auth-label">MeetFlow</div>
      <div class="muted">mulai dengan trial gratis</div>
    </div>
    <div class="doodle note"></div>
    <div class="doodle dots"></div>
    <div class="doodle card"></div>
  </div>

  <div class="auth-card">
    <h1>Register Admin</h1>
    <p class="muted">Isi data admin, lalu pilih paket yang diinginkan.</p>
    <?php if (!empty($success)): ?>
      <div class="alert"><?php echo htmlspecialchars($success); ?></div>
    <?php elseif (!empty($error)): ?>
      <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Nama</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div>
        <button type="button" class="secondary" data-open-plan>Pilih Paket</button>
        <p class="muted">Pilih trial atau langganan, lalu buat admin.</p>
      </div>

      <div class="modal" data-modal>
        <div class="modal-content">
          <div class="modal-head">
            <h2>Pilih Paket</h2>
            <button type="button" class="modal-close" data-close-plan>x</button>
          </div>
          <p class="muted">Klik salah satu paket lalu lanjutkan registrasi.</p>
          <div class="plan-grid">
            <label class="plan-card">
              <input type="radio" name="plan_type" value="trial" checked>
              <div class="plan-content">
                <div>
                  <div class="plan-title">Trial 10 Hari</div>
                  <div class="muted">Gratis, bisa upgrade kapan saja</div>
                </div>
                <div class="plan-price">Rp0</div>
              </div>
            </label>
            <label class="plan-card">
              <input type="radio" name="plan_type" value="permanent">
              <div class="plan-content">
                <div>
                  <div class="plan-title">Langganan Bulanan</div>
                  <div class="muted">Akses penuh + support</div>
                </div>
                <div class="plan-price">Rp95.000</div>
              </div>
            </label>
          </div>
          <div class="inline">
            <label class="checkbox">
              <input type="checkbox" name="pay_now" value="1" checked>
              Bayar sekarang (aktif 30 hari)
            </label>
          </div>
          <div class="modal-actions">
            <button type="submit">Buat Admin</button>
          </div>
        </div>
      </div>
      <div class="auth-foot">
        <span class="muted">Sudah punya akun?</span>
        <a href="/login">Login</a>
      </div>
    </form>
  </div>

  <div class="auth-side right">
    <div class="doodle woman"></div>
    <div class="doodle dots"></div>
    <div class="doodle stack"></div>
  </div>
</div>
