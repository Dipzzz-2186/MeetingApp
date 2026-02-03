<section class="articles-hero">
  <div>
    <p class="home-kicker">RuangMeet Articles</p>
    <h1>Artikel & Insight</h1>
    <p class="muted">Inspirasi dan panduan untuk mengelola meeting dengan rapi, efisien, dan kolaboratif.</p>
  </div>
  <div class="articles-search">
    <input type="text" placeholder="Cari artikel, topik, atau kata kunci...">
  </div>
</section>

<section class="articles-tags">
  <span class="badge">Teknologi</span>
  <span class="badge">Produktivitas</span>
  <span class="badge">Manajemen</span>
  <span class="badge">Ruang Meeting</span>
  <span class="badge">Tips</span>
</section>

<?php
$featured = $articles ? $articles[0] : null;
$side = $articles ? array_slice($articles, 1, 3) : [];
$rest = $articles ? array_slice($articles, 4) : [];
?>

<section class="articles-featured">
  <?php if ($featured): ?>
    <article class="card featured-card">
      <?php if (!empty($featured['cover_url'])): ?>
        <div class="featured-media">
          <img src="<?php echo htmlspecialchars($featured['cover_url']); ?>" alt="">
        </div>
      <?php endif; ?>
      <div class="featured-body">
        <p class="meta"><?php echo htmlspecialchars($featured['category'] ?? 'Umum'); ?> • <?php echo htmlspecialchars($featured['published_at'] ?? ''); ?></p>
        <h2><?php echo htmlspecialchars($featured['title']); ?></h2>
        <p class="muted"><?php echo htmlspecialchars($featured['excerpt'] ?? ''); ?></p>
        <?php if (!empty($featured['author'])): ?>
          <p class="muted">By <?php echo htmlspecialchars($featured['author']); ?></p>
        <?php endif; ?>
      </div>
    </article>
  <?php else: ?>
    <div class="card">
      <h2>Belum ada artikel.</h2>
      <p class="muted">Super admin bisa menambahkan artikel di dashboard.</p>
    </div>
  <?php endif; ?>

  <div class="articles-side">
    <?php foreach ($side as $item): ?>
      <article class="card side-card">
        <?php if (!empty($item['cover_url'])): ?>
          <img src="<?php echo htmlspecialchars($item['cover_url']); ?>" alt="">
        <?php endif; ?>
        <div>
          <p class="meta"><?php echo htmlspecialchars($item['category'] ?? 'Umum'); ?></p>
          <h3><?php echo htmlspecialchars($item['title']); ?></h3>
          <p class="muted"><?php echo htmlspecialchars($item['excerpt'] ?? ''); ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="articles-grid">
  <?php foreach ($rest as $item): ?>
    <article class="card article-card">
      <?php if (!empty($item['cover_url'])): ?>
        <div class="article-media">
          <img src="<?php echo htmlspecialchars($item['cover_url']); ?>" alt="">
        </div>
      <?php endif; ?>
      <div class="article-body">
        <p class="meta"><?php echo htmlspecialchars($item['category'] ?? 'Umum'); ?></p>
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
        <p class="muted"><?php echo htmlspecialchars($item['excerpt'] ?? ''); ?></p>
      </div>
    </article>
  <?php endforeach; ?>
</section>
