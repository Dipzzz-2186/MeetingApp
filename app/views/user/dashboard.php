<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
/* Dashboard User Styles */
.user-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid rgba(42, 49, 61, 0.5);
}

.header-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

.header-avatar {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #1a1a1a;
  font-weight: 700;
  box-shadow: 0 8px 20px rgba(247, 200, 66, 0.3);
}

.header-info h1 {
  font-family: "Fraunces", serif;
  font-size: 28px;
  font-weight: 600;
  color: var(--ink);
  margin-bottom: 4px;
}

.header-info p {
  color: var(--muted);
  font-size: 14px;
  margin: 0;
}

.user-badge {
  padding: 8px 16px;
  border-radius: 20px;
  background: rgba(87, 184, 255, 0.15);
  color: var(--info);
  font-weight: 700;
  font-size: 13px;
  border: 1px solid rgba(87, 184, 255, 0.3);
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Stats Grid for User */
.user-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.user-stat-card {
  background: linear-gradient(145deg, rgba(26, 31, 40, 0.9) 0%, rgba(22, 27, 36, 0.9) 100%);
  border-radius: 18px;
  padding: 24px;
  border: 1px solid var(--stroke);
  box-shadow: 0 10px 30px rgba(5, 6, 9, 0.5);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.user-stat-card::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 100px;
  height: 100px;
  background: radial-gradient(circle, rgba(247, 200, 66, 0.1) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(30%, -30%);
}

.user-stat-card:hover {
  transform: translateY(-5px);
  border-color: rgba(247, 200, 66, 0.3);
  box-shadow: 0 15px 40px rgba(5, 6, 9, 0.7);
}

.stat-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
}

.stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  background: rgba(247, 200, 66, 0.15);
  color: var(--accent);
}

.stat-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.stat-value {
  font-family: "Fraunces", serif;
  font-size: 32px;
  font-weight: 600;
  color: var(--ink);
  line-height: 1;
}

/* Quick Action Section */
.quick-action-section {
  background: linear-gradient(135deg, rgba(247, 200, 66, 0.15) 0%, rgba(255, 216, 107, 0.08) 100%);
  border: 1px solid rgba(247, 200, 66, 0.25);
  border-radius: 20px;
  padding: 32px;
  margin-bottom: 28px;
  box-shadow: 0 10px 30px rgba(247, 200, 66, 0.08);
  text-align: center;
}

.quick-action-section h2 {
  font-family: "Fraunces", serif;
  font-size: 24px;
  margin: 0 0 12px 0;
  color: var(--ink);
}

.quick-action-section p {
  color: var(--muted);
  margin: 0 0 24px 0;
  font-size: 15px;
}

.btn-large {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 32px;
  background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
  color: #1a1a1a;
  text-decoration: none;
  border-radius: 999px;
  font-weight: 700;
  font-size: 16px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 8px 20px rgba(247, 200, 66, 0.3);
}

.btn-large:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 28px rgba(247, 200, 66, 0.4);
}

/* Dashboard Grid */
.user-dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
  margin-bottom: 30px;
}

/* Card Styles */
.user-card {
  background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
  border-radius: 20px;
  padding: 28px;
  border: 1px solid var(--stroke);
  box-shadow: 0 22px 55px rgba(5, 6, 9, 0.65);
}

.user-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 18px;
  border-bottom: 1px solid rgba(42, 49, 61, 0.5);
}

.user-card-title {
  font-family: "Fraunces", serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--ink);
  display: flex;
  align-items: center;
  gap: 12px;
}

.user-card-title i {
  color: var(--accent);
  font-size: 20px;
}

/* Room Grid */
.rooms-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 14px;
}

.room-card {
  background: linear-gradient(135deg, rgba(26, 31, 40, 0.6) 0%, rgba(20, 24, 32, 0.8) 100%);
  border: 1px solid var(--stroke);
  border-radius: 16px;
  padding: 20px;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.room-card:hover {
  border-color: rgba(247, 200, 66, 0.4);
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(10, 30, 45, 0.4);
}

.room-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  background: rgba(247, 200, 66, 0.15);
  color: var(--accent-2);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 12px;
  font-size: 24px;
}

.room-name {
  font-weight: 700;
  color: var(--ink);
  font-size: 15px;
  margin-bottom: 8px;
}

.room-capacity {
  font-size: 12px;
  color: var(--muted);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

/* Bookings Table */
.bookings-table-container {
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid var(--stroke);
  background: rgba(17, 21, 28, 0.5);
}

.bookings-table {
  width: 100%;
  border-collapse: collapse;
}

.bookings-table thead {
  background: linear-gradient(90deg, rgba(17, 21, 28, 0.9) 0%, rgba(26, 31, 40, 0.9) 100%);
}

.bookings-table th {
  padding: 16px 18px;
  text-align: left;
  font-weight: 600;
  font-size: 12px;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.6px;
  border-bottom: 1px solid var(--stroke);
}

.bookings-table tbody tr {
  border-bottom: 1px solid rgba(42, 49, 61, 0.5);
  transition: all 0.2s ease;
}

.bookings-table tbody tr:hover {
  background: rgba(247, 200, 66, 0.05);
}

.bookings-table tbody tr:last-child {
  border-bottom: none;
}

.bookings-table td {
  padding: 18px;
  color: var(--ink);
  font-size: 14px;
  font-weight: 500;
}

.booking-time {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--muted);
  font-size: 13px;
}

.booking-time i {
  color: var(--accent);
  font-size: 12px;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--muted);
}

.empty-state i {
  font-size: 56px;
  margin-bottom: 16px;
  opacity: 0.3;
  color: var(--accent);
}

.empty-state h3 {
  font-size: 18px;
  margin-bottom: 8px;
  color: var(--muted);
  font-family: "Fraunces", serif;
}

.empty-state p {
  font-size: 14px;
  margin-bottom: 20px;
}

.btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: rgba(17, 21, 28, 0.9);
  color: var(--ink);
  border: 1px solid var(--stroke);
  text-decoration: none;
  border-radius: 999px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: rgba(24, 28, 37, 0.9);
  border-color: var(--accent);
  color: var(--accent);
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 1024px) {
  .user-dashboard-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .user-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .header-left {
    width: 100%;
  }
  
  .user-badge {
    width: 100%;
    justify-content: center;
  }
  
  .user-stats-grid {
    grid-template-columns: 1fr;
  }
  
  .quick-action-section {
    padding: 24px;
  }
  
  .user-card {
    padding: 20px;
  }
  
  .rooms-grid {
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
  }
}

@media (max-width: 640px) {
  .header-info h1 {
    font-size: 22px;
  }
  
  .user-stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
  
  .user-stat-card {
    padding: 18px;
  }
  
  .stat-value {
    font-size: 26px;
  }
  
  .bookings-table-container {
    overflow-x: auto;
  }
  
  .bookings-table {
    min-width: 600px;
  }
}
</style>

<!-- User Header -->
<header class="user-header">
  <div class="header-left">
    <div class="header-avatar">
      <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
    </div>
    <div class="header-info">
      <h1>Halo, <?php echo htmlspecialchars($user['name']); ?>!</h1>
      <p>Selamat datang kembali di dashboard Anda</p>
    </div>
  </div>
  <div class="user-badge">
    <i class="bi bi-person-circle"></i>
    Member
  </div>
</header>

<!-- User Stats -->
<div class="user-stats-grid">
  <div class="user-stat-card">
    <div class="stat-header">
      <div class="stat-icon">
        <i class="bi bi-calendar-check"></i>
      </div>
      <div class="stat-label">Booking Aktif</div>
    </div>
    <div class="stat-value"><?php echo count($my_bookings); ?></div>
  </div>
  
  <div class="user-stat-card">
    <div class="stat-header">
      <div class="stat-icon">
        <i class="bi bi-door-open"></i>
      </div>
      <div class="stat-label">Room Tersedia</div>
    </div>
    <div class="stat-value"><?php echo count($rooms); ?></div>
  </div>
  
  <div class="user-stat-card">
    <div class="stat-header">
      <div class="stat-icon">
        <i class="bi bi-clock-history"></i>
      </div>
      <div class="stat-label">Meeting Bulan Ini</div>
    </div>
    <div class="stat-value">
      <?php 
        $thisMonth = date('Y-m');
        $monthlyCount = 0;
        foreach ($my_bookings as $booking) {
          if (date('Y-m', strtotime($booking['start_time'])) === $thisMonth) {
            $monthlyCount++;
          }
        }
        echo $monthlyCount;
      ?>
    </div>
  </div>
</div>

<!-- Quick Action -->
<div class="quick-action-section">
  <h2><i class="bi bi-lightning-charge-fill"></i> Jadwalkan Meeting Anda</h2>
  <p>Pesan ruang meeting dengan cepat dan mudah. Pilih waktu yang sesuai dengan kebutuhan Anda.</p>
  <a href="/booking_user" class="btn-large">
    <i class="bi bi-calendar-plus"></i>
    Buat Booking Baru
  </a>
</div>

<!-- Dashboard Grid -->
<div class="user-dashboard-grid">
  <!-- Room Tersedia -->
  <div class="user-card">
    <div class="user-card-header">
      <h2 class="user-card-title">
        <i class="bi bi-building"></i>
        Ruang Meeting
      </h2>
    </div>
    
    <?php if ($rooms): ?>
      <div class="rooms-grid">
        <?php foreach ($rooms as $room): ?>
          <div class="room-card">
            <div class="room-icon">
              <i class="bi bi-door-closed"></i>
            </div>
            <div class="room-name"><?php echo htmlspecialchars($room['name']); ?></div>
            <div class="room-capacity">
              <i class="bi bi-people-fill"></i>
              <?php echo (int)$room['capacity']; ?> orang
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h3>Belum Ada Ruangan</h3>
        <p>Tidak ada ruang meeting yang tersedia saat ini</p>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- My Bookings -->
  <div class="user-card">
    <div class="user-card-header">
      <h2 class="user-card-title">
        <i class="bi bi-calendar-event"></i>
        Jadwal Saya
      </h2>
    </div>
    
    <?php if ($my_bookings): ?>
      <div class="bookings-table-container">
        <table class="bookings-table">
          <thead>
            <tr>
              <th>Ruangan</th>
              <th>Waktu</th>
              <th>Tujuan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (array_slice($my_bookings, 0, 5) as $row): ?>
              <tr>
                <td>
                  <strong><?php echo htmlspecialchars($row['room_name']); ?></strong>
                </td>
                <td>
                  <div class="booking-time">
                    <i class="bi bi-clock"></i>
                    <?php 
                      $start = date('d/m H:i', strtotime($row['start_time']));
                      $end = date('H:i', strtotime($row['end_time']));
                      echo $start . ' - ' . $end;
                    ?>
                  </div>
                </td>
                <td><?php echo htmlspecialchars($row['purpose'] ?? '-'); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php if (count($my_bookings) > 5): ?>
        <div style="margin-top: 16px; text-align: center;">
          <a href="/my-bookings" class="btn-secondary">
            <i class="bi bi-list-ul"></i>
            Lihat Semua Booking
          </a>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="empty-state">
        <i class="bi bi-calendar-x"></i>
        <h3>Belum Ada Booking</h3>
        <p>Anda belum memiliki jadwal meeting</p>
        <a href="/booking_user" class="btn-secondary">
          <i class="bi bi-plus-circle"></i>
          Buat Booking Pertama
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>