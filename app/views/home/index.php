<?php
$user = current_user();
?>
<section class="home-hero">
  <div class="home-hero-text">
    <h1>Solusi Booking Meeting yang Rapi dan Terukur</h1>
    <p class="muted">FCOM Inti Teknologi membantu perusahaan mengelola ruang meeting, jadwal, dan pengguna secara terpusat agar kolaborasi makin cepat dan tertib.</p>
    <?php if (!$user): ?>
      <div class="home-cta">
        <a class="btn" href="/register">Mulai Sekarang</a>
        <a class="btn ghost" href="/login">Login</a>
        <a class="btn ghost" href="/articles">Artikel</a>
      </div>
      
      <div class="home-badges">
        <span class="badge">Multi Admin</span>
        <span class="badge">Anti Bentrok</span>
        <span class="badge">Trial 10 Hari</span>
      </div>
    <?php else: ?>
      <div class="home-user">
        <div class="home-user-name">
          <?= htmlspecialchars($user['name']) ?>
        </div>
        <div class="home-user-meta">
          <span class="role"><?= ucfirst($user['role']) ?></span>
          <?php if ($user['role'] !== 'admin'): ?>
            <span class="sep">•</span>
            <span class="admin">
              Admin: <?= htmlspecialchars($user['owner_admin_name'] ?? '-') ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
      <div class="home-cta">
        <a class="btn ghost" href="/articles">Artikel</a>
      </div>
    <?php endif; ?>

  </div>
  <div class="home-hero-card">
    <div class="home-card">
      <h2>MeetFlow</h2>
      <p class="muted">Aplikasi booking meeting room internal dengan dashboard admin & user.</p>
      <ul class="home-list">
        <li>Tambah user & room dengan mudah</li>
        <li>Penjadwalan otomatis cek bentrok</li>
        <li>Notifikasi masa trial/pembayaran</li>
      </ul>
    </div>
  </div>
</section>

<section class="home-grid">
  <div class="card">
    <h3>Profil Perusahaan</h3>
    <p class="muted">FCOM Inti Teknologi fokus pada solusi internal workflow, termasuk pengelolaan meeting, kolaborasi, dan penjadwalan terpadu.</p>
  </div>
  <div class="card">
    <h3>Layanan Utama</h3>
    <p class="muted">Implementasi sistem booking, integrasi kalender, dan monitoring penggunaan ruang meeting untuk efisiensi kantor.</p>
  </div>
  <div class="card">
    <h3>Hubungi Kami</h3>
    <p class="muted">info@fcominti.co.id</p>
    <p class="muted">+62 21 555 0101</p>
  </div>
</section>
