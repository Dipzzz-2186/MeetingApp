<?php
$user = current_user();
?>

<style>
/* ============================================
   HOME HERO SECTION - Modern & Sophisticated
   ============================================ */

.home-hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 4rem 2rem;
  background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #1e2530 100%);
}

/* Fullscreen layout override for home */
.container {
  max-width: 100%;
  margin: 0;
  padding: 0;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 0;
}

.hero-background::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(circle at 20% 30%, rgba(234, 179, 8, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(251, 191, 36, 0.1) 0%, transparent 50%);
  animation: pulse 8s ease-in-out infinite;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    linear-gradient(90deg, rgba(234, 179, 8, 0.03) 1px, transparent 1px),
    linear-gradient(rgba(234, 179, 8, 0.03) 1px, transparent 1px);
  background-size: 50px 50px;
  opacity: 0.3;
}

@keyframes pulse {
  0%, 100% { opacity: 0.5; }
  50% { opacity: 0.8; }
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 1200px;
  width: 100%;
  text-align: center;
  margin-bottom: 3rem;
}

.hero-header {
  margin-bottom: 3rem;
}

.hero-title {
  font-size: clamp(2rem, 5vw, 3.5rem);
  font-weight: 700;
  line-height: 1.2;
  color: #ffffff;
  margin-bottom: 1.5rem;
  text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
}

.brand-name {
  color: #eab308;
  font-weight: 800;
}

.highlight {
  background: linear-gradient(120deg, #eab308, #fbbf24);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-subtitle {
  font-size: clamp(1rem, 2vw, 1.25rem);
  color: #cbd5e1;
  max-width: 800px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Hero Features */
.hero-features {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.feature-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #ffffff;
  text-decoration: none;
  font-size: 1rem;
  padding: 0.75rem 1.5rem;
  border-bottom: 2px solid transparent;
  transition: all 0.3s ease;
  position: relative;
}

.feature-link::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #eab308, #fbbf24);
  transition: width 0.3s ease;
}

.feature-link:hover {
  color: #eab308;
}

.feature-link:hover::before {
  width: 100%;
}

.feature-link svg {
  width: 14px;
  height: 14px;
  opacity: 0.7;
}

/* Carousel Dots */
.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 0.75rem;
  margin-top: 2rem;
}

.dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  cursor: pointer;
  transition: all 0.3s ease;
}

.dot.active {
  background: #eab308;
  width: 30px;
  border-radius: 5px;
}

.dot:hover {
  background: rgba(255, 255, 255, 0.6);
}

/* Hero Demo Section */
.hero-demo {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1200px;
  margin-top: 2rem;
}

.demo-window {
  background: #1e293b;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 
    0 20px 60px rgba(0, 0, 0, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.1);
}

.window-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  background: #0f172a;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.window-controls {
  display: flex;
  gap: 0.5rem;
}

.control {
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.control.red { background: #ef4444; }
.control.yellow { background: #eab308; }
.control.green { background: #22c55e; }

.window-url {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex: 1;
  margin: 0 2rem;
  padding: 0.5rem 1rem;
  background: #1e293b;
  border-radius: 6px;
  font-size: 0.875rem;
  color: #94a3b8;
}

.window-url svg {
  width: 12px;
  height: 12px;
  opacity: 0.5;
}

.download-btn {
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #eab308, #ca8a04);
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.download-btn:hover {
  background: linear-gradient(135deg, #ca8a04, #a16207);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3);
}

/* Demo Content */
.demo-content {
  display: flex;
  min-height: 500px;
}

.demo-sidebar {
  width: 280px;
  background: #0f172a;
  padding: 1.5rem;
  border-right: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
  color: #ffffff;
  font-weight: 600;
  font-size: 1.125rem;
}

.brand-icon {
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #eab308, #fbbf24);
  border-radius: 8px;
}

.new-booking-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.875rem;
  background: linear-gradient(135deg, #eab308, #ca8a04);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  margin-bottom: 2rem;
  transition: all 0.3s ease;
}

.new-booking-btn:hover {
  background: linear-gradient(135deg, #ca8a04, #a16207);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(234, 179, 8, 0.4);
}

.folder-section {
  margin-top: 1.5rem;
}

.folder-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #94a3b8;
  font-size: 0.875rem;
  margin-bottom: 0.75rem;
  font-weight: 500;
}

.folder-header button {
  background: none;
  border: none;
  color: #94a3b8;
  cursor: pointer;
  font-size: 1.25rem;
  padding: 0;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: color 0.2s;
}

.folder-header button:hover {
  color: #ffffff;
}

.folder-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.folder-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.625rem 0.75rem;
  color: #cbd5e1;
  font-size: 0.875rem;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  margin-bottom: 0.25rem;
}

.folder-item:hover {
  background: rgba(234, 179, 8, 0.1);
  color: #ffffff;
}

.folder-item svg {
  width: 14px;
  height: 14px;
  opacity: 0.6;
}

/* Demo Main Area */
.demo-main {
  flex: 1;
  padding: 2rem;
  background: #1e293b;
}

.section-title {
  font-size: 1.5rem;
  color: #ffffff;
  margin-bottom: 0.5rem;
}

.section-subtitle {
  color: #94a3b8;
  margin-bottom: 2rem;
  font-size: 0.95rem;
}

.select-wrapper {
  margin-bottom: 2rem;
}

.room-select {
  width: 100%;
  max-width: 300px;
  padding: 0.875rem 1rem;
  background: #0f172a;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  color: #cbd5e1;
  font-size: 0.95rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.room-select:hover {
  border-color: rgba(234, 179, 8, 0.5);
}

.room-select:focus {
  outline: none;
  border-color: #eab308;
  box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
}

/* Booking Cards */
.booking-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

.booking-card {
  background: #0f172a;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s ease;
  cursor: pointer;
}

.booking-card:hover {
  border-color: rgba(234, 179, 8, 0.5);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.card-icon {
  width: 48px;
  height: 48px;
  border-radius: 8px;
  margin-bottom: 1rem;
}

.card-icon.general {
  background: linear-gradient(135deg, #fbbf24, #eab308);
}

.card-icon.ux-writer {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.card-icon.ux-researcher {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.booking-card h4 {
  color: #ffffff;
  font-size: 1.125rem;
  margin-bottom: 0.75rem;
  font-weight: 600;
}

.booking-card p {
  color: #94a3b8;
  font-size: 0.875rem;
  line-height: 1.6;
}

/* ============================================
   CTA SECTION
   ============================================ */

.cta-section {
  position: relative;
  z-index: 2;
  text-align: center;
  padding: 3rem 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

.cta-buttons {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.btn {
  padding: 1rem 2.5rem;
  font-size: 1rem;
  font-weight: 600;
  text-decoration: none;
  border-radius: 8px;
  transition: all 0.3s ease;
  display: inline-block;
  border: 2px solid transparent;
}

.btn.primary {
  background: linear-gradient(135deg, #eab308, #ca8a04);
  color: white;
}

.btn.primary:hover {
  background: linear-gradient(135deg, #ca8a04, #a16207);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(234, 179, 8, 0.3);
}

.btn.secondary {
  background: transparent;
  color: #ffffff;
  border-color: rgba(255, 255, 255, 0.2);
}

.btn.secondary:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.4);
}

.btn.tertiary {
  background: transparent;
  color: #cbd5e1;
  border-color: transparent;
}

.btn.tertiary:hover {
  color: #ffffff;
  background: rgba(255, 255, 255, 0.05);
}

.trust-badges {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  flex-wrap: wrap;
}

.badge {
  padding: 0.75rem 1.5rem;
  background: rgba(234, 179, 8, 0.1);
  border: 1px solid rgba(234, 179, 8, 0.3);
  border-radius: 24px;
  color: #fde047;
  font-size: 0.875rem;
  font-weight: 500;
}

/* ============================================
   USER WELCOME SECTION
   ============================================ */

.user-welcome {
  position: relative;
  z-index: 2;
  padding: 3rem 2rem;
  max-width: 800px;
  margin: 0 auto;
}

.welcome-card {
  background: rgba(30, 41, 59, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 2.5rem;
  text-align: center;
}

.welcome-card h2 {
  color: #ffffff;
  font-size: 1.75rem;
  margin-bottom: 1.5rem;
}

.user-info {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.role-badge {
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #eab308, #ca8a04);
  color: white;
  border-radius: 6px;
  font-size: 0.875rem;
  font-weight: 600;
}

.divider {
  color: #64748b;
}

.admin-info {
  color: #94a3b8;
  font-size: 0.95rem;
}

/* ============================================
   INFO GRID SECTION
   ============================================ */

.info-grid {
  max-width: 1200px;
  margin: 4rem auto;
  padding: 0 2rem 4rem;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2rem;
}

.info-card {
  background: rgba(30, 41, 59, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 2rem;
  transition: all 0.3s ease;
}

.info-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
  border-color: rgba(234, 179, 8, 0.3);
}

.card-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.icon-wrapper {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-wrapper.company {
  background: linear-gradient(135deg, #eab308, #ca8a04);
}

.icon-wrapper.service {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.icon-wrapper.contact {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.icon-wrapper svg {
  width: 24px;
  height: 24px;
  color: white;
}

.info-card h3 {
  color: #ffffff;
  font-size: 1.25rem;
  font-weight: 600;
}

.info-card p {
  color: #cbd5e1;
  line-height: 1.7;
  font-size: 0.95rem;
}

.contact-info {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.contact-info p {
  margin: 0;
}

.contact-info strong {
  color: #ffffff;
  font-weight: 600;
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */

@media (max-width: 1024px) {
  .demo-content {
    flex-direction: column;
  }
  
  .demo-sidebar {
    width: 100%;
    border-right: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .booking-cards {
    grid-template-columns: 1fr;
  }

  .room-select {
    max-width: 100%;
  }
}

@media (max-width: 768px) {
  .home-hero {
    padding: 2rem 1rem;
    min-height: auto;
  }
  
  .hero-features {
    flex-direction: column;
    gap: 1rem;
  }

  .feature-link {
    justify-content: center;
    width: 100%;
  }
  
  .window-header {
    flex-wrap: wrap;
    gap: 0.5rem;
  }
  
  .window-url {
    margin: 0;
    width: 100%;
    overflow: hidden;
  }

  .window-url span {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }
  
  .demo-main {
    padding: 1.5rem;
  }

  .demo-content {
    min-height: auto;
  }
  
  .cta-buttons {
    flex-direction: column;
    align-items: stretch;
  }
  
  .btn {
    text-align: center;
  }
  
  .info-grid {
    grid-template-columns: 1fr;
    padding: 0 1rem 2rem;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 1.75rem;
  }
  
  .hero-subtitle {
    font-size: 0.95rem;
  }
  
  .window-controls,
  .window-actions {
    display: none;
  }
  
  .demo-sidebar {
    padding: 1rem;
  }
  
  .welcome-card {
    padding: 1.5rem;
  }

  .cta-section {
    padding: 2rem 1rem;
  }

  .trust-badges {
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
  }

  .user-info {
    flex-direction: column;
  }

  .booking-card {
    padding: 1.25rem;
  }
}
</style>
<section class="home-hero">
  <div class="hero-background">
    <div class="hero-overlay"></div>
  </div>
  
  <div class="hero-content">
    <div class="hero-header">
      <h1 class="hero-title">
        <span class="brand-name">RuangMeet</span>:
        Booking Ruang Meeting Tanpa Bentrok,
        Lebih <span class="highlight">Rapi</span> dan <span class="highlight">Terukur</span>
      </h1>
      <p class="hero-subtitle">Atur jadwal rapat, kapasitas ruangan, dan akses tim dalam satu dashboard yang simpel untuk operasional harian.</p>
    </div>

    <div class="hero-features">
      <a href="#multi-admin" class="feature-link">
        <span>Multi Admin</span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M8 0L10 6H16L11 10L13 16L8 12L3 16L5 10L0 6H6L8 0Z"/>
        </svg>
      </a>
      <a href="#smart-scheduling" class="feature-link">
        <span>Smart Scheduling</span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M8 0L10 6H16L11 10L13 16L8 12L3 16L5 10L0 6H6L8 0Z"/>
        </svg>
      </a>
      <a href="#trial" class="feature-link">
        <span>Trial 10 Hari</span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M8 0L10 6H16L11 10L13 16L8 12L3 16L5 10L0 6H6L8 0Z"/>
        </svg>
      </a>
    </div>

    <div class="carousel-dots">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </div>

  <div class="hero-demo">
    <div class="demo-window">
      <div class="window-header">
        <div class="window-controls">
          <span class="control red"></span>
          <span class="control yellow"></span>
          <span class="control green"></span>
        </div>
        <div class="window-url">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
            <path d="M6 0C2.7 0 0 2.7 0 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6z"/>
          </svg>
          <span>https://www.ruangmeet.id</span>
        </div>
        <div class="window-actions">
          <button class="download-btn">Lihat Demo</button>
        </div>
      </div>
      
      <div class="demo-content">
        <div class="demo-sidebar">
          <div class="sidebar-brand">
            <div class="brand-icon"></div>
            <span>RuangMeet</span>
          </div>
          
          <button class="new-booking-btn">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
              <path d="M8 0v16M0 8h16" stroke="currentColor" stroke-width="2"/>
            </svg>
            Buat Booking
          </button>

          <div class="folder-section">
            <div class="folder-header">
              <span>Folder</span>
              <button>+</button>
            </div>
            <ul class="folder-list">
              <li class="folder-item">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                  <path d="M2 2h3l1 1h4v7H2V2z"/>
                </svg>
              <span>Rapat Harian</span>
              </li>
              <li class="folder-item">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                  <path d="M2 2h3l1 1h4v7H2V2z"/>
                </svg>
              <span>Tim Produk</span>
              </li>
              <li class="folder-item">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                  <path d="M2 2h3l1 1h4v7H2V2z"/>
                </svg>
              <span>Client Utama</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="demo-main">
          <h3 class="section-title">Buat booking baru</h3>
          <p class="section-subtitle">Pilih jenis ruangan dan tanggal, sistem otomatis cek bentrok.</p>
          
          <div class="select-wrapper">
            <select class="room-select">
              <option>Pilih Ruangan</option>
            </select>
          </div>

          <div class="booking-cards">
            <div class="booking-card">
              <div class="card-icon general"></div>
              <h4>Meeting Umum</h4>
              <p>Ruang serbaguna untuk rapat koordinasi lintas tim dan update mingguan.</p>
            </div>
            <div class="booking-card">
              <div class="card-icon ux-writer"></div>
              <h4>Rapat Produk</h4>
              <p>Diskusi roadmap, review backlog, dan sinkronisasi fitur dengan tim terkait.</p>
            </div>
            <div class="booking-card">
              <div class="card-icon ux-researcher"></div>
              <h4>Client Meeting</h4>
              <p>Jadwalkan presentasi dan kickoff dengan waktu yang bebas bentrok.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (!$user): ?>
  <section class="cta-section">
    <div class="cta-buttons">
      <a class="btn primary" href="/register">Mulai Trial</a>
      <a class="btn secondary" href="/login">Masuk</a>
    </div>
    
    <div class="trust-badges">
      <span class="badge">✓ Multi Admin</span>
      <span class="badge">✓ Anti Bentrok</span>
      <span class="badge">✓ Trial 10 Hari</span>
    </div>
  </section>
<?php else: ?>
  <section class="user-welcome">
    <div class="welcome-card">
      <h2>Selamat datang di RuangMeet, <?= htmlspecialchars($user['name']) ?>!</h2>
      <div class="user-info">
        <span class="role-badge"><?= ucfirst($user['role']) ?></span>
        <?php if ($user['role'] === 'user'): ?>
          <span class="divider">•</span>
          <span class="admin-info">Admin: <?= htmlspecialchars($user['owner_admin_name']) ?></span>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="info-grid">
  <div class="info-card">
    <div class="card-header">
      <div class="icon-wrapper company">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
        </svg>
      </div>
      <h3>Tentang RuangMeet</h3>
    </div>
    <p>RuangMeet membantu tim mengelola ruang meeting, jadwal, dan akses pengguna dengan alur yang jelas serta minim bentrok.</p>
  </div>
  
  <div class="info-card">
    <div class="card-header">
      <div class="icon-wrapper service">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2z"/>
        </svg>
      </div>
      <h3>Fitur Utama</h3>
    </div>
    <p>Booking otomatis, pengelolaan user & ruangan, serta rekap pemakaian untuk keputusan operasional yang lebih cepat.</p>
  </div>
  
  <div class="info-card">
    <div class="card-header">
      <div class="icon-wrapper contact">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
        </svg>
      </div>
      <h3>Kontak</h3>
    </div>
    <div class="contact-info">
      <p><strong>Email:</strong> hello@ruangmeet.id</p>
      <p><strong>Telp:</strong> +62 21 555 0101</p>
      <p><strong>Jam Kerja:</strong> Senin - Jumat, 09:00 - 17:00 WIB</p>
    </div>
  </div>
</section>
