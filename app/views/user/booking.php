<div class="grid two">
  <div class="card">
    <h1>Buat Booking</h1>
    <?php if (!empty($notice)): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
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
      <button type="submit">Booking</button>
    </form>
  </div>
  <div class="card">
    <h2>Room Tersedia</h2>
    <div class="grid">
      <?php foreach ($rooms as $row): ?>
        <div class="badge"><?php echo htmlspecialchars($row['name']); ?> (<?php echo (int)$row['capacity']; ?>)</div>
      <?php endforeach; ?>
      <?php if (!$rooms): ?>
        <p class="muted">Belum ada room.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
