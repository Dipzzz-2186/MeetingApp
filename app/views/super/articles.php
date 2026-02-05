<?php
/** @var array $articles */
/** @var string $error */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Manage Articles</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            --cyan: #57d7ff;
        }

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
            padding: 30px 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--stroke);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header h1 {
            font-family: "Fraunces", serif;
            font-size: 36px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header h1 i {
            color: var(--accent);
            font-size: 32px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(242, 243, 245, 0.2);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--muted);
            background: rgba(17, 21, 28, 0.7);
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            border-color: rgba(247, 200, 66, 0.4);
            color: var(--accent);
            background: rgba(17, 21, 28, 0.9);
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: #1a1a1a;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        /* Card Styles */
        .card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card-header-content {
            flex: 1;
        }

        .admin-kicker {
            font-size: 12px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .card h2 {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
        }

        /* Alert */
        .alert {
            background: rgba(255, 87, 87, 0.1);
            border: 1px solid rgba(255, 87, 87, 0.3);
            color: var(--error);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert.success {
            background: rgba(87, 255, 117, 0.1);
            border-color: rgba(87, 255, 117, 0.3);
            color: var(--success);
        }

        /* Table Styles */
        .table-container {
            overflow: hidden;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.8);
        }

        .table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--stroke);
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(42, 49, 61, 0.3);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .table td {
            padding: 20px;
            color: var(--ink);
            font-size: 14px;
            vertical-align: middle;
        }

        /* Article Preview */
        .article-preview {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .article-cover {
            width: 60px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--purple) 0%, #d19cff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .article-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-cover.no-image {
            background: rgba(17, 21, 28, 0.5);
            border: 1px solid var(--stroke);
        }

        .article-cover.no-image i {
            color: var(--muted);
            font-size: 14px;
        }

        .article-info {
            flex: 1;
            min-width: 0;
        }

        .article-title {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-excerpt {
            font-size: 12px;
            color: var(--muted);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Category Badge */
        .category-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background: rgba(87, 184, 255, 0.1);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-badge.published {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .status-badge.draft {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        .status-badge.scheduled {
            background: rgba(255, 168, 87, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 168, 87, 0.3);
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-secondary {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
        }

        .btn-icon {
            padding: 8px;
            min-width: 36px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-family: "Fraunces", serif;
            font-size: 22px;
            margin-bottom: 10px;
            color: var(--ink);
        }

        .empty-state p {
            font-size: 14px;
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(11, 13, 18, 0.98);
            z-index: 10000;
            animation: fadeIn 0.3s ease;
            overflow-y: auto;
            padding: 80px 20px 20px;
        }

        .modal.active {
            display: block;
        }

        .modal-content {
            background: var(--card);
            border-radius: 20px;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--stroke);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: var(--card);
            border-radius: 20px 20px 0 0;
            z-index: 2;
        }

        .modal-header h2 {
            font-family: "Fraunces", serif;
            font-size: 22px;
            margin: 0;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-header h2 i {
            color: var(--accent);
        }

        .modal-close {
            background: rgba(154, 160, 170, 0.1);
            border: 1px solid var(--stroke);
            color: var(--muted);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: var(--error);
            border-color: var(--error);
            color: var(--ink);
        }

        .modal-body {
            padding: 30px;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        /* Form Styles in Modal */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.span-two {
            grid-column: span 2;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        input[type="text"],
        input[type="datetime-local"],
        textarea,
        select {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--ink);
            font-family: "Space Grotesk", sans-serif;
            font-size: 14px;
            transition: all 0.2s ease;
            width: 100%;
        }

        input[type="text"]:focus,
        input[type="datetime-local"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.9);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[type="file"] {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px dashed var(--stroke);
            background: rgba(17, 21, 28, 0.5);
            color: var(--ink);
            cursor: pointer;
            width: 100%;
        }

        input[type="file"]:hover {
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.7);
        }

        .small-text {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 10px;
            padding-top: 20px;
            border-top: 1px solid var(--stroke);
        }

        /* Preview Modal */
        .preview-content {
            line-height: 1.8;
            color: var(--ink);
        }

        .preview-content h1,
        .preview-content h2,
        .preview-content h3 {
            font-family: "Fraunces", serif;
            margin: 20px 0 10px 0;
            color: var(--ink);
        }

        .preview-content p {
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 28px;
            }

            .card {
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .table th,
            .table td {
                padding: 12px 10px;
                font-size: 12px;
            }

            .article-preview {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .article-cover {
                width: 100%;
                height: 120px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .modal {
                padding: 60px 10px 10px;
            }

            .modal-content {
                margin: 0;
            }

            .modal-header,
            .modal-body {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-two {
                grid-column: span 1;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .table td {
                padding: 10px 8px;
            }

            .modal-content {
                border-radius: 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions button {
                width: 100%;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <h1>
                    <i class="fas fa-newspaper"></i>
                    Manage Articles
                </h1>
            </div>
            <div class="header-actions">
                <a href="/dashboard_superadmin" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
                <button class="primary-btn" onclick="openCreateModal()">
                    <i class="fas fa-plus"></i>
                    Buat Artikel
                </button>
            </div>
        </div>

        <!-- Articles List -->
        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <p class="admin-kicker">Super Admin</p>
                    <h2>Daftar Artikel</h2>
                </div>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if (empty($articles)): ?>
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3>Belum Ada Artikel</h3>
                    <p>Mulai buat artikel pertama Anda dengan menekan tombol "Buat Artikel" di atas.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Artikel</th>
                                <th>Kategori</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): 
                                $publishedAt = strtotime($article['published_at']);
                                $now = time();
                                
                                if ($publishedAt > $now) {
                                    $status = 'scheduled';
                                    $statusText = 'Terjadwal';
                                    $statusIcon = 'fa-clock';
                                } else {
                                    $status = 'published';
                                    $statusText = 'Terpublikasi';
                                    $statusIcon = 'fa-check-circle';
                                }
                                
                                $category = $article['category'] ?? 'Uncategorized';
                            ?>
                                <tr>
                                    <td>
                                        <div class="article-preview">
                                            <div class="article-cover <?php echo empty($article['cover_url']) ? 'no-image' : ''; ?>">
                                                <?php if (!empty($article['cover_url'])): ?>
                                                    <img src="<?php echo htmlspecialchars($article['cover_url']); ?>" alt="Cover">
                                                <?php else: ?>
                                                    <i class="fas fa-image"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="article-info">
                                                <div class="article-title">
                                                    <?php echo htmlspecialchars($article['title']); ?>
                                                </div>
                                                <div class="article-excerpt">
                                                    <?php echo htmlspecialchars(substr($article['excerpt'] ?? '', 0, 100) . '...'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-badge"><?php echo htmlspecialchars($category); ?></span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--ink);">
                                            <?php echo htmlspecialchars($article['author'] ?? 'Anonymous'); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-badge <?php echo $status; ?>">
                                            <i class="fas <?php echo $statusIcon; ?>"></i>
                                            <?php echo $statusText; ?>
                                        </div>
                                        <div style="font-size: 11px; color: var(--muted); margin-top: 4px;">
                                            <?php echo date('d M Y, H:i', $publishedAt); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-secondary btn-icon" onclick="previewArticle(<?php echo (int)$article['id']; ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form method="post" onsubmit="return confirm('Hapus artikel ini?');" style="display: inline;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo (int)$article['id']; ?>">
                                                <button class="btn-secondary btn-icon" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Create Article Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-plus-circle"></i> Buat Artikel Baru</h2>
                <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="articleForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="create">
                    
                    <div class="form-grid">
                        <div class="form-group span-two">
                            <label>Judul Artikel *</label>
                            <input type="text" name="title" placeholder="Masukkan judul artikel" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category">
                                <option value="">Pilih Kategori</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Bisnis">Bisnis</option>
                                <option value="Tips">Tips & Trik</option>
                                <option value="Produktivitas">Produktivitas</option>
                                <option value="Kolaborasi">Kolaborasi</option>
                                <option value="News">News</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Author *</label>
                            <input type="text" name="author" placeholder="Nama penulis" required>
                        </div>

                        <div class="form-group span-two">
                            <label>Cover URL (opsional)</label>
                            <input type="text" name="cover_url" placeholder="https://example.com/image.jpg">
                            <p class="small-text">Masukkan URL gambar cover atau upload file di bawah</p>
                        </div>

                        <div class="form-group span-two">
                            <label>Upload Foto Cover</label>
                            <input type="file" name="cover_file" accept="image/jpeg,image/png,image/webp" id="coverFile">
                            <p class="small-text">Maksimal 5MB. Format: JPG, PNG, atau WEBP.</p>
                        </div>

                        <div class="form-group span-two">
                            <label>Excerpt / Ringkasan</label>
                            <textarea name="excerpt" rows="3" placeholder="Ringkasan singkat artikel yang akan ditampilkan di halaman utama"></textarea>
                        </div>

                        <div class="form-group span-two">
                            <label>Konten Artikel *</label>
                            <textarea name="content" rows="8" placeholder="Tulis konten artikel di sini..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Publikasi *</label>
                            <input type="datetime-local" name="published_at" id="publishedAt" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="back-btn" onclick="closeCreateModal()">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                        <button type="submit" class="primary-btn">
                            <i class="fas fa-save"></i>
                            Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-eye"></i> Preview Artikel</h2>
                <button class="modal-close" onclick="closePreviewModal()">&times;</button>
            </div>
            <div class="modal-body" id="previewContent">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Set default publish date to now
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const datetimeLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
            if (document.getElementById('publishedAt')) {
                document.getElementById('publishedAt').value = datetimeLocal;
            }
        });

        // Modal functions
        function openCreateModal() {
            document.getElementById('createModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function previewArticle(id) {
            const articles = <?php echo json_encode($articles); ?>;
            const article = articles.find(a => a.id == id);
            
            if (article) {
                const previewContent = document.getElementById('previewContent');
                previewContent.innerHTML = `
                    <div style="margin-bottom: 30px;">
                        <h1 style="font-family: 'Fraunces', serif; font-size: 32px; margin-bottom: 20px; color: var(--ink);">
                            ${article.title}
                        </h1>
                        <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-user" style="color: var(--muted);"></i>
                                <span style="color: var(--ink); font-weight: 600;">${article.author || 'Anonymous'}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-tag" style="color: var(--muted);"></i>
                                <span class="category-badge">${article.category || 'Uncategorized'}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-calendar" style="color: var(--muted);"></i>
                                <span style="color: var(--muted);">
                                    ${new Date(article.published_at).toLocaleDateString('id-ID', { 
                                        day: 'numeric', 
                                        month: 'long', 
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    })}
                                </span>
                            </div>
                        </div>
                        ${article.cover_url ? `
                            <div style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
                                <img src="${article.cover_url}" alt="Cover" style="width: 100%; max-height: 400px; object-fit: cover;">
                            </div>
                        ` : ''}
                        ${article.excerpt ? `
                            <div style="margin-bottom: 30px; padding: 20px; background: rgba(17, 21, 28, 0.5); border-radius: 12px; border-left: 4px solid var(--accent);">
                                <p style="font-style: italic; color: var(--ink); margin: 0; line-height: 1.6;">
                                    ${article.excerpt}
                                </p>
                            </div>
                        ` : ''}
                        <div class="preview-content">
                            ${article.content ? article.content.replace(/\n/g, '<br>') : '<p style="color: var(--muted); font-style: italic;">Tidak ada konten.</p>'}
                        </div>
                    </div>
                `;
                
                document.getElementById('previewModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const createModal = document.getElementById('createModal');
            const previewModal = document.getElementById('previewModal');
            
            if (event.target === createModal) {
                closeCreateModal();
            }
            if (event.target === previewModal) {
                closePreviewModal();
            }
        };

        // Close modals with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                if (document.getElementById('createModal').classList.contains('active')) {
                    closeCreateModal();
                }
                if (document.getElementById('previewModal').classList.contains('active')) {
                    closePreviewModal();
                }
            }
        });

        // File size validation
        document.getElementById('coverFile')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert('File terlalu besar. Maksimal ukuran file adalah 5MB.');
                    e.target.value = '';
                }
                
                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau WEBP.');
                    e.target.value = '';
                }
            }
        });

        // Form submission handling
        document.getElementById('articleForm')?.addEventListener('submit', function(e) {
            const title = this.querySelector('input[name="title"]').value.trim();
            const author = this.querySelector('input[name="author"]').value.trim();
            const content = this.querySelector('textarea[name="content"]').value.trim();
            
            if (!title || !author || !content) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi (judul, author, dan konten).');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            // Re-enable after 5 seconds if still processing
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });
    </script>
</body>
</html>