<div class="card admin-card">
  <div class="admin-head">
    <div>
      <p class="admin-kicker">Super Admin</p>
      <h2>Manage Articles</h2>
    </div>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="post" class="grid three">
    <input type="hidden" name="action" value="create">
    <div class="span-two">
      <label>Judul</label>
      <input type="text" name="title" required>
    </div>
    <div>
      <label>Kategori</label>
      <input type="text" name="category" placeholder="Teknologi / Bisnis / Tips">
    </div>
    <div>
      <label>Author</label>
      <input type="text" name="author" placeholder="Nama penulis">
    </div>
    <div class="span-two">
      <label>Cover URL (optional)</label>
      <input type="text" name="cover_url" placeholder="https://...">
    </div>
    <div class="span-two">
      <label>Excerpt</label>
      <textarea name="excerpt" rows="3" placeholder="Ringkasan singkat"></textarea>
    </div>
    <div class="span-two">
      <label>Konten</label>
      <textarea name="content" rows="6" placeholder="Isi artikel"></textarea>
    </div>
    <div>
      <label>Publish At</label>
      <input type="datetime-local" name="published_at">
    </div>
    <div class="inline">
      <button type="submit">Simpan Artikel</button>
    </div>
  </form>
</div>

<div class="card admin-card admin-table">
  <div class="admin-head">
    <div>
      <p class="admin-kicker">Artikel</p>
      <h2>Daftar Artikel</h2>
    </div>
  </div>
  <table class="table">
    <thead>
      <tr><th>Judul</th><th>Kategori</th><th>Author</th><th>Publish</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
      <tr>
        <td><?php echo htmlspecialchars($article['title']); ?></td>
        <td><?php echo htmlspecialchars($article['category'] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($article['author'] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($article['published_at'] ?? '-'); ?></td>
        <td>
          <form method="post" onsubmit="return confirm('Hapus artikel ini?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo (int)$article['id']; ?>">
            <button class="secondary" type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$articles): ?>
      <tr><td colspan="5" class="muted">Belum ada artikel.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
