<div class="grid two">
  <div class="card">
    <h1>Add Room</h1>
    <?php if (!empty($notice)): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Nama Room</label>
        <input type="text" name="name" required>
      </div>
      <div>
        <label>Kapasitas</label>
        <input type="number" name="capacity" min="1" required>
      </div>
      <button type="submit">Tambah</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar Room</h2>
    <table class="table">
      <thead><tr><th>Nama</th><th>Kapasitas</th></tr></thead>
      <tbody>
        <?php foreach ($rooms as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo (int)$row['capacity']; ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$rooms): ?>
          <tr><td colspan="2" class="muted">Belum ada room.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
