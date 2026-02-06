<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Articles</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --bg: #0b0d12;
            --ink: #f2f3f5;
            --accent: #f7c842;
            --accent-2: #ffd86b;
            --card: #1a1f28;
            --muted: #9aa0aa;
            --stroke: #2a313d;
            --shadow: 0 22px 55px rgba(5, 6, 9, 0.65);
            --success: #57ff75;
            --error: #ff5757;
            --info: #57b8ff;
            --warning: #ffa857;
            --purple: #b366ff;
            --radius-sm: 15px;
            --radius-md: 20px;
            --radius-lg: 25px;
        }

        /* ===== RESET & BASE ===== */
        * { 
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at top left, #1a1f28 0%, #101319 55%, #0b0d12 100%);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* ===== TYPOGRAPHY ===== */
        .home-kicker {
            text-transform: uppercase;
            letter-spacing: 1.4px;
            font-size: 12px;
            color: var(--accent);
            margin: 0 0 12px;
            font-weight: 700;
        }

        .heading-1 {
            font-family: "Fraunces", serif;
            font-size: 48px;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .heading-2 {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            line-height: 1.3;
        }

        .heading-3 {
            font-family: "Space Grotesk", sans-serif;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.4;
        }

        .text-muted {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.6;
        }

        .text-small {
            font-size: 14px;
            color: var(--muted);
        }

        .text-xsmall {
            font-size: 12px;
        }

        .meta-text {
            font-size: 14px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* ===== COMPONENTS ===== */
        .card {
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(247, 200, 66, 0.3);
            box-shadow: 0 15px 30px rgba(5, 6, 9, 0.8);
        }

        .badge {
            padding: 10px 20px;
            border-radius: var(--radius-lg);
            background: rgba(17, 21, 28, 0.7);
            border: 1px solid var(--stroke);
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .badge:hover,
        .badge.active {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            border-color: var(--accent);
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(247, 200, 66, 0.2);
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius-lg);
            background: rgba(247, 200, 66, 0.1);
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid rgba(247, 200, 66, 0.3);
        }

        .read-more:hover {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(247, 200, 66, 0.2);
        }

        /* ===== LAYOUT ===== */
        .main-layout {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        /* Header Section */
        .header-section {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Search Section */
        .search-section {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .search-section input {
            width: 100%;
            padding: 18px 24px 18px 50px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            color: var(--ink);
            font-size: 16px;
            font-family: "Space Grotesk", sans-serif;
            transition: all 0.3s ease;
        }

        .search-section input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        .search-section input::placeholder {
            color: var(--muted);
        }

        .search-section::before {
            content: "\f002";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
            z-index: 1;
        }

        /* Tags Filter */
        .tags-section {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 20px 0;
        }

        /* Empty State */
        .empty-state-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 400px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--muted);
            max-width: 500px;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h2 {
            font-family: "Fraunces", serif;
            font-size: 28px;
            margin-bottom: 15px;
            color: var(--muted);
        }

        .empty-state p {
            font-size: 16px;
            line-height: 1.6;
        }

        /* Featured Articles */
        .featured-section {
            margin: 40px 0;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .featured-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .featured-media {
            height: 200px;
            overflow: hidden;
            border-radius: var(--radius-md) var(--radius-md) 0 0;
        }

        .featured-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .featured-card:hover .featured-media img {
            transform: scale(1.05);
        }

        .featured-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Articles Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        /* Article Card */
        .article-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .article-media {
            height: 180px;
            overflow: hidden;
            border-radius: var(--radius-sm) var(--radius-sm) 0 0;
        }

        .article-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-media img {
            transform: scale(1.05);
        }

        .article-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* ===== UTILITIES ===== */
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(247, 200, 66, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .flex-center {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .text-center {
            text-align: center;
        }

        .mt-25 { margin-top: 25px; }
        .mt-10 { margin-top: 10px; }
        .mb-15 { margin-bottom: 15px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-25 { margin-bottom: 25px; }
        .mb-40 { margin-bottom: 40px; }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 30px 15px;
            }
            
            .heading-1 {
                font-size: 36px;
            }
            
            .text-muted {
                font-size: 16px;
            }
            
            .search-section input {
                padding: 15px 20px 15px 45px;
                font-size: 14px;
            }
            
            .tags-section {
                padding: 10px 0;
                gap: 8px;
            }
            
            .badge {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .featured-media {
                height: 180px;
            }
            
            .featured-body {
                padding: 20px;
            }
            
            .heading-2 {
                font-size: 24px;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 480px) {
            .heading-1 {
                font-size: 28px;
            }
            
            .heading-2 {
                font-size: 20px;
            }
            
            .featured-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-layout">
            <!-- Header -->
            <section class="header-section fade-in-up">
                <p class="home-kicker">RUANGMEET ARTICLES</p>
                <h1 class="heading-1">Artikel & Insight</h1>
                <p class="text-muted">Inspirasi dan panduan untuk mengelola meeting dengan rapi, efisien, dan kolaboratif.</p>
            </section>

            <!-- Search -->
            <section class="search-section fade-in-up" style="animation-delay: 0.1s;">
                <input type="text" placeholder="Cari artikel, topik, atau kata kunci...">
            </section>

            <!-- Tags Filter -->
            <section class="tags-section fade-in-up" style="animation-delay: 0.2s;">
                <span class="badge active">Semua</span>
                <span class="badge">Teknologi</span>
                <span class="badge">Produktivitas</span>
                <span class="badge">Manajemen</span>
                <span class="badge">Ruang Meeting</span>
                <span class="badge">Tips</span>
                <span class="badge">Kolaborasi</span>
                <span class="badge">Best Practice</span>
            </section>

            <!-- Content -->
            <?php if (empty($articles)): ?>
                <!-- Empty State -->
                <section class="empty-state-container fade-in-up">
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h2>Belum ada artikel</h2>
                        <p>Super admin bisa menambahkan artikel di dashboard.</p>
                    </div>
                </section>
            <?php else: ?>
                <?php
                // Pisahkan artikel menjadi featured dan regular
                $featuredArticles = array_slice($articles, 0, 3);
                $regularArticles = array_slice($articles, 3);
                ?>
                
                <!-- Featured Articles -->
                <?php if (!empty($featuredArticles)): ?>
                    <section class="featured-section fade-in-up">
                        <div class="featured-grid">
                            <?php foreach ($featuredArticles as $index => $item): ?>
                                <article class="card featured-card" style="animation-delay: <?php echo 0.3 + ($index * 0.1); ?>s;">
                                    <?php if (!empty($item['cover_url'])): ?>
                                        <div class="featured-media">
                                            <img src="<?php echo htmlspecialchars($item['cover_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="featured-body">
                                        <p class="meta-text mb-15">
                                            <?php echo htmlspecialchars($item['category'] ?? 'Umum'); ?>
                                        </p>
                                        <h3 class="heading-3 mb-15"><?php echo htmlspecialchars($item['title']); ?></h3>
                                        <p class="text-small mb-20"><?php echo htmlspecialchars(substr($item['excerpt'] ?? '', 0, 100) . '...'); ?></p>
                                        <div class="flex-between mt-25">
                                            <?php if (!empty($item['author'])): ?>
                                                <div class="flex-center">
                                                    <div class="author-avatar">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <div style="font-weight: 600; color: var(--ink);"><?php echo htmlspecialchars($item['author']); ?></div>
                                                        <div class="text-xsmall text-muted">Penulis</div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <a href="#" class="read-more">
                                                Baca <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Regular Articles Grid -->
                <?php if (!empty($regularArticles)): ?>
                    <section class="articles-grid fade-in-up" style="animation-delay: 0.4s;">
                        <?php foreach ($regularArticles as $index => $item): ?>
                            <article class="card article-card" style="animation-delay: <?php echo 0.5 + ($index * 0.05); ?>s;">
                                <?php if (!empty($item['cover_url'])): ?>
                                    <div class="article-media">
                                        <img src="<?php echo htmlspecialchars($item['cover_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="article-body">
                                    <p class="meta-text mb-15">
                                        <?php echo htmlspecialchars($item['category'] ?? 'Umum'); ?>
                                        <span style="margin-left: 10px;">
                                            <i class="far fa-clock"></i> <?php echo htmlspecialchars($item['read_time'] ?? '5 min read'); ?>
                                        </span>
                                    </p>
                                    <h3 class="heading-3 mb-15"><?php echo htmlspecialchars($item['title']); ?></h3>
                                    <p class="text-small mb-20"><?php echo htmlspecialchars(substr($item['excerpt'] ?? '', 0, 80) . '...'); ?></p>
                                    <div class="flex-between mt-25">
                                        <?php if (!empty($item['author'])): ?>
                                            <div class="flex-center">
                                                <div class="author-avatar" style="width: 30px; height: 30px;">
                                                    <i class="fas fa-user" style="font-size: 12px;"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--ink); font-size: 13px;"><?php echo htmlspecialchars($item['author']); ?></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <a href="#" class="read-more" style="padding: 8px 16px; font-size: 13px;">
                                            Baca <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>

                <!-- Load More Button -->
                <?php if (count($articles) > 12): ?>
                    <div class="text-center mt-40">
                        <button id="loadMore" class="read-more" style="padding: 15px 40px; font-size: 16px;">
                            <i class="fas fa-sync-alt"></i> Muat Lebih Banyak
                        </button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.querySelector('.search-section input');
            const articleCards = document.querySelectorAll('.featured-card, .article-card');
            
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                
                articleCards.forEach(card => {
                    const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                    const excerpt = card.querySelector('.text-small')?.textContent.toLowerCase() || '';
                    const category = card.querySelector('.meta-text')?.textContent.toLowerCase() || '';
                    
                    if (searchTerm === '' || title.includes(searchTerm) || excerpt.includes(searchTerm) || category.includes(searchTerm)) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.5s ease forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
            
            // Tag filtering
            const tags = document.querySelectorAll('.tags-section .badge');
            tags.forEach(tag => {
                tag.addEventListener('click', function() {
                    tags.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.textContent.toLowerCase();
                    
                    articleCards.forEach(card => {
                        const cardCategory = card.querySelector('.meta-text')?.textContent.toLowerCase() || '';
                        
                        if (filter === 'semua' || cardCategory.includes(filter)) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.5s ease forwards';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Load more button
            const loadMoreBtn = document.getElementById('loadMore');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const btn = this;
                    const originalHTML = btn.innerHTML;
                    
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                    btn.disabled = true;
                    
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                        btn.style.display = 'none';
                        
                        const successMsg = document.createElement('div');
                        successMsg.className = 'alert success';
                        successMsg.style.cssText = 'max-width: 400px; margin: 20px auto; text-align: center; padding: 15px; background: rgba(87, 255, 117, 0.1); border: 1px solid var(--success); border-radius: var(--radius-sm); color: var(--success);';
                        successMsg.innerHTML = '<i class="fas fa-check-circle"></i> Semua artikel telah dimuat';
                        btn.parentElement.appendChild(successMsg);
                        
                        setTimeout(() => successMsg.remove(), 3000);
                    }, 1500);
                });
            }
            
            // Read more buttons
            document.querySelectorAll('.read-more').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const articleTitle = this.closest('article').querySelector('h3')?.textContent || 'Artikel';
                    alert(`Membuka artikel: "${articleTitle}"\n\nFitur ini akan diimplementasikan kemudian.`);
                });
            });
            
            // Intersection Observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
            
            articleCards.forEach(card => observer.observe(card));
        });
    </script>
</body>
</html>