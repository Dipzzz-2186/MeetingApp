<div class="grid two">
  <div class="card">
    <h1>Scheduling</h1>
    <?php if (!empty($notice)): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>User</label>
        <select name="user_id" required>
          <option value="">Pilih user</option>
          <?php foreach ($users as $row): ?>
            <option value="<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
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
      <button type="submit">Buat Booking</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar Booking</h2>
    <table class="table">
      <thead><tr><th>User</th><th>Room</th><th>Mulai</th><th>Selesai</th></tr></thead>
      <tbody>
        <?php foreach ($bookings as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['room_name']); ?></td>
            <td><?php echo htmlspecialchars($row['start_time']); ?></td>
            <td><?php echo htmlspecialchars($row['end_time']); ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$bookings): ?>
          <tr><td colspan="4" class="muted">Belum ada booking.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
