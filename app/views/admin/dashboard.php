<div class="grid two">
  <div class="card">
    <h1>Dashboard Admin</h1>
    <?php if (!empty($plan_message)): ?>
      <div class="alert"><?php echo htmlspecialchars($plan_message); ?></div>
    <?php endif; ?>
    <?php if (!empty($blocked)): ?>
      <div class="alert">Akses scheduling diblokir karena masa trial/pembayaran habis.</div>
    <?php endif; ?>
    <div class="grid">
      <a href="/users">Add User</a>
      <a href="/rooms">Add Room</a>
      <a href="/bookings">Scheduling</a>
    </div>
  </div>
  <div class="card">
    <h2>Kelola Paket</h2>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="mark_paid">
      <button class="secondary" type="submit">Bayar / Aktifkan 30 Hari</button>
    </form>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="extend_paid">
      <label>Atur Tanggal Paid Until</label>
      <input type="datetime-local" name="paid_until">
      <button type="submit">Simpan</button>
    </form>
    <form method="post" class="grid">
      <input type="hidden" name="action" value="reset_trial">
      <button type="submit">Reset Trial 10 Hari</button>
    </form>
  </div>
</div>

<div class="card">
  <h2>Recent Bookings</h2>
  <table class="table">
    <thead>
      <tr><th>User</th><th>Room</th><th>Mulai</th><th>Selesai</th></tr>
    </thead>
    <tbody>
    <?php foreach ($recent as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$recent): ?>
      <tr><td colspan="4" class="muted">Belum ada booking.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
