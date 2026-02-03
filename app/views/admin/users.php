<div class="grid two">
  <div class="card">
    <h1>Add User</h1>
    <?php if (!empty($notice)): ?><div class="alert"><?php echo htmlspecialchars($notice); ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" class="grid">
      <div>
        <label>Nama</label>
        <input type="text" name="name" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit">Tambah</button>
    </form>
  </div>
  <div class="card">
    <h2>Daftar User</h2>
    <table class="table">
      <thead><tr><th>Nama</th><th>Email</th><th>Role</th></tr></thead>
      <tbody>
        <?php foreach ($users as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$users): ?>
          <tr><td colspan="3" class="muted">Belum ada user.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
