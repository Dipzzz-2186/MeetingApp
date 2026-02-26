<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Kelola Room</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--stroke);
        }

        .header h1 {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
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

        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }

        @media (max-width: 1024px) {
            .grid-two {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
        }

        .card h1, .card h2 {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card h1 i, .card h2 i {
            color: var(--accent);
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        .alert.success {
            background: rgba(87, 255, 117, 0.1);
            border: 1px solid rgba(87, 255, 117, 0.3);
            color: var(--success);
        }

        .alert.error {
            background: rgba(255, 87, 87, 0.1);
            border: 1px solid rgba(255, 87, 87, 0.3);
            color: var(--error);
        }

        .alert.info {
            background: rgba(87, 184, 255, 0.1);
            border: 1px solid rgba(87, 184, 255, 0.3);
            color: var(--info);
        }

        .alert.warning {
            background: rgba(255, 168, 87, 0.1);
            border: 1px solid rgba(255, 168, 87, 0.3);
            color: var(--warning);
        }

        .alert i {
            font-size: 16px;
        }

        form.grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        form.grid > div {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label i {
            color: var(--accent);
            font-size: 12px;
        }

        input, select {
            width: 100%;
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            font-size: 15px;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            transition: all 0.2s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        input::placeholder {
            color: rgba(154, 160, 170, 0.6);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        button[type="submit"] {
            background: var(--accent);
            color: #1a1a1a;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            font-family: "Space Grotesk", sans-serif;
            width: 100%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        button[type="submit"]:hover {
            background: var(--accent-2);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.7);
            border-bottom: 2px solid var(--stroke);
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(42, 49, 61, 0.5);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .table td {
            padding: 18px 15px;
            color: var(--ink);
            font-size: 14px;
        }

        .table td:last-child {
            text-align: center;
        }

        .capacity-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .capacity-badge.small {
            background: rgba(87, 255, 117, 0.15);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .capacity-badge.medium {
            background: rgba(87, 184, 255, 0.15);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        .capacity-badge.large {
            background: rgba(255, 168, 87, 0.15);
            color: var(--warning);
            border: 1px solid rgba(255, 168, 87, 0.3);
        }

        .capacity-badge.xlarge {
            background: rgba(247, 200, 66, 0.15);
            color: var(--accent);
            border: 1px solid rgba(247, 200, 66, 0.3);
        }

        .room-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
            margin-right: 12px;
        }

        .room-info {
            display: flex;
            align-items: center;
        }

        .room-name {
            font-weight: 600;
            color: var(--ink);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--muted);
        }

        .empty-state p {
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .action-btn.active {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.16);
        }

        .edit-wallpaper-gallery {
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            gap: 10px;
        }

        .edit-wallpaper-thumb {
            position: relative;
            border: 1px solid var(--stroke);
            border-radius: 12px;
            overflow: hidden;
            background: rgba(17, 21, 28, 0.75);
            aspect-ratio: 16 / 9;
        }

        .edit-wallpaper-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            cursor: zoom-in;
        }

        .edit-wallpaper-remove {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 87, 87, 0.9);
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }


        .action-btn.edit:hover {
            border-color: var(--info);
            color: var(--info);
            background: rgba(87, 184, 255, 0.1);
        }

        .action-btn.delete:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
        }

        .action-btn.view:hover {
            border-color: var(--success);
            color: var(--success);
            background: rgba(87, 255, 117, 0.1);
        }

        .wallpaper-input-row {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
        }

        .wallpaper-input-field {
            flex: 1;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--stroke);
        }

        .pagination-btn {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: "Space Grotesk", sans-serif;
            font-weight: 500;
        }

        .pagination-btn:hover:not(:disabled) {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .pagination-btn.active {
            background: var(--accent);
            color: #1a1a1a;
            border-color: var(--accent);
            font-weight: 600;
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 14px;
            margin: 0 15px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: flex-start;
            justify-content: center;
            overflow-y: auto;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: var(--card);
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            position: relative;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            margin: 20px 0;
            animation: slideUp 0.3s ease;
        }

        body.modal-open .header,
        body.modal-open .topbar,
        body.modal-open .tabbar,
        body.modal-open .mobile-brand {
            display: none !important;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: var(--muted);
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1;
        }

        .modal-close:hover {
            color: var(--accent);
        }

        .modal-title {
            font-family: "Fraunces", serif;
            font-size: 24px;
            margin-bottom: 25px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-title i {
            color: var(--accent);
        }

        /* HOVER EFFECT UNTUK TOMBOL BATAL DENGAN BORDER MERAH */
        #cancelEdit,
        #cancelDelete {
            flex: 0 0 auto;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: "Space Grotesk", sans-serif;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Gradient background hover */
        #cancelEdit::before,
        #cancelDelete::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 87, 87, 0.1),
                transparent
            );
            transition: left 0.5s ease;
            z-index: -1;
        }

        /* Hover Effects untuk tombol Batal dengan border merah */
        #cancelEdit:hover,
        #cancelDelete:hover {
            color: var(--ink);
            border-color: var(--error); /* WARNA MERAH */
            background: rgba(255, 87, 87, 0.08); /* Background merah transparan */
            transform: translateY(-2px);
            box-shadow: 
                0 5px 15px rgba(255, 87, 87, 0.2), /* Shadow merah */
                0 0 0 1px rgba(255, 87, 87, 0.3); /* Glow merah */
        }

        /* Gradient slide effect */
        #cancelEdit:hover::before,
        #cancelDelete:hover::before {
            left: 100%;
        }

        /* Active state untuk tombol Batal */
        #cancelEdit:active,
        #cancelDelete:active {
            transform: translateY(0);
            transition: transform 0.1s ease;
            border-color: rgba(255, 87, 87, 0.5);
            background: rgba(255, 87, 87, 0.12);
        }

        /* Focus untuk aksesibilitas */
        #cancelEdit:focus,
        #cancelDelete:focus {
            outline: 2px solid var(--error);
            outline-offset: 2px;
        }

        /* Disabled state */
        #cancelEdit:disabled,
        #cancelDelete:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            border-color: rgba(255, 87, 87, 0.2) !important;
        }

        /* Responsive untuk tombol Batal */
        @media (max-width: 768px) {
            #cancelEdit,
            #cancelDelete {
                padding: 12px 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            #cancelEdit,
            #cancelDelete {
                padding: 10px 14px;
                font-size: 13px;
            }
        }

        /* Loading Spinner */
        .spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wallpaper-lightbox-content {
            width: min(96vw, 1200px);
            height: min(92vh, 760px);
            padding: 12px;
            background: rgba(9, 12, 18, 0.96);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .wallpaper-lightbox-content img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
            background: #06090f;
        }

        #closeWallpaperModal {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            color: var(--ink);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .card {
                padding: 20px;
            }
            
            .table th, .table td {
                padding: 12px 10px;
            }
            
            .pagination {
                flex-wrap: wrap;
                gap: 5px;
            }
            
            .pagination-info {
                margin: 10px 0;
                width: 100%;
                text-align: center;
            }

            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tbody tr {
                border: 1px solid rgba(42, 49, 61, 0.7);
                border-radius: 14px;
                padding: 12px;
                margin-bottom: 12px;
            }

            .table td {
                padding: 10px 6px;
                border-bottom: 1px dashed rgba(42, 49, 61, 0.6);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }

            .table td:last-child {
                border-bottom: 0;
                justify-content: flex-end;
            }

            .table td::before {
                content: attr(data-label);
                text-transform: uppercase;
                letter-spacing: 0.6px;
                font-size: 11px;
                color: var(--muted);
                font-weight: 700;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
                max-width: 90%;
            }
            
            .actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px 10px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .card h1, .card h2 {
                font-size: 20px;
            }
            
            input, select, button[type="submit"] {
                padding: 12px 14px;
            }
            
            .pagination-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <?php if (!empty($plan_expiry_reminder)): ?>
            <div class="alert warning">
                <i class="fas fa-hourglass-half"></i>
                Langganan akan berakhir dalam <?php echo (int)$plan_expiry_reminder['days_left']; ?> hari
                (<?php echo htmlspecialchars($plan_expiry_reminder['until']); ?>).
            </div>
        <?php endif; ?>

        <div class="header">
            <h1><i class="fas fa-door-closed"></i> Manajemen Ruangan</h1>
            <a href="/dashboard_admin" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
        
        <div class="grid-two">
            <!-- Form Tambah Room -->
            <div class="card">
                <h1><i class="fas fa-plus-circle"></i> Tambah Ruangan Baru</h1>
                
                <?php if (!empty($notice)): ?>
                    <div class="alert success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($notice); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($error)): ?>
                    <div class="alert error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" class="grid" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="create">
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-door-open"></i> Nama Ruangan</label>
                            <input type="text" name="name" placeholder="Contoh: Ruang Rapat Utama" required>
                        </div>
                        <div>
                            <label><i class="fas fa-users"></i> Kapasitas</label>
                            <input type="number" name="capacity" min="1" max="100" placeholder="Jumlah orang" required>
                        </div>
                    </div>
                    <div>
                        <label><i class="fas fa-image"></i> Wallpaper (Upload)</label>
                        <div id="createWallpaperInputs"></div>
                        <button type="button" class="action-btn" id="addCreateWallpaperInput">
                            <i class="fas fa-plus"></i> Tambah File Wallpaper
                        </button>
                        <div id="createWallpaperPreview" style="margin-top: 10px; border: 1px dashed var(--stroke); border-radius: 10px; padding: 10px;">
                            <div style="font-size: 12px; color: var(--muted); margin-bottom: 6px;">Preview Wallpaper</div>
                            <div id="createSelectedWallpaperGrid" class="edit-wallpaper-gallery"></div>
                            <div id="createSelectedWallpaperEmpty" style="color: var(--muted); font-size: 12px; text-align: center;">Belum ada file dipilih.</div>
                        </div>
                        <small style="color: var(--muted); font-size: 12px;">Bisa pilih lebih dari 1 file. Semua format gambar didukung. Disarankan 1920x1080, max 5MB per file.</small>
                    </div>
                    <button type="submit">
                        <i class="fas fa-plus"></i>
                        Tambah Ruangan
                    </button>
                </form>
            </div>
            
            <!-- Daftar Room -->
            <div class="card">
                <h2><i class="fas fa-list"></i> Daftar Ruangan</h2>
                
                <?php 
                // Fungsi untuk menentukan badge kapasitas
                function getCapacityBadge($capacity) {
                    if ($capacity <= 5) return 'small';
                    if ($capacity <= 10) return 'medium';
                    if ($capacity <= 20) return 'large';
                    return 'xlarge';
                }

                function getPrimaryWallpaper($value) {
                    $raw = trim((string)$value);
                    if ($raw === '') return '';
                    $parts = preg_split('/\r\n|\r|\n/', $raw);
                    $first = trim((string)($parts[0] ?? ''));
                    return trim($first, " \t\n\r\0\x0B'\",");
                }

                function getWallpaperList($value) {
                    $raw = trim((string)$value);
                    if ($raw === '') return [];
                    $parts = preg_split('/\r\n|\r|\n/', $raw);
                    $list = array_values(array_filter(array_map(static function($item) {
                        return trim((string)$item, " \t\n\r\0\x0B'\",");
                    }, $parts), static function($item) {
                        return $item !== '';
                    }));
                    return $list;
                }
                ?>
                
                <?php if (!$rooms): ?>
                    <div class="empty-state">
                        <i class="fas fa-door-closed"></i>
                        <h3>Belum ada ruangan</h3>
                        <p>Tambahkan ruangan pertama Anda menggunakan form di samping</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ruangan</th>
                                    <th>Kapasitas</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rooms as $row): 
                                    $capacityBadge = getCapacityBadge($row['capacity']);
                                    $createdDate = date('d/m/Y', strtotime($row['created_at']));
                                    $wallpaperUrl = getPrimaryWallpaper($row['wallpaper_url'] ?? '');
                                    $wallpaperList = getWallpaperList($row['wallpaper_url'] ?? '');
                                    $wallpaperListJson = htmlspecialchars(json_encode($wallpaperList, JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                                ?>
                                    <tr data-room-id="<?php echo $row['id']; ?>">
                                        <td data-label="Ruangan">
                                            <div class="room-info">
                                                <div class="room-icon">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <div>
                                                    <div class="room-name"><?php echo htmlspecialchars($row['name']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Kapasitas">
                                            <span class="capacity-badge <?php echo $capacityBadge; ?>">
                                                <i class="fas fa-users"></i>
                                                <?php echo (int)$row['capacity']; ?> orang
                                            </span>
                                        </td>
                                        <td data-label="Tanggal Dibuat">
                                            <span style="color: var(--muted); font-size: 13px;">
                                                <?php echo $createdDate; ?>
                                            </span>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="actions">
                                                <button class="action-btn edit" 
                                                        data-room-id="<?php echo $row['id']; ?>"
                                                        data-room-name="<?php echo htmlspecialchars($row['name']); ?>"
                                                        data-room-capacity="<?php echo $row['capacity']; ?>"
                                                        data-room-wallpaper="<?php echo htmlspecialchars($wallpaperUrl); ?>"
                                                        data-room-wallpapers="<?php echo $wallpaperListJson; ?>">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button class="action-btn delete" 
                                                        data-room-id="<?php echo $row['id']; ?>"
                                                        data-room-name="<?php echo htmlspecialchars($row['name']); ?>">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                    <div class="pagination">
                        <!-- Previous Button -->
                        <button class="pagination-btn" 
                                onclick="goToPage(<?php echo $currentPage - 1; ?>)" 
                                <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <!-- Page Numbers -->
                        <?php 
                        // Tampilkan maksimal 5 halaman di sekitar current page
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $currentPage + 2);
                        
                        // Jika di awal, pastikan tampil 5 halaman
                        if ($currentPage <= 3) {
                            $startPage = 1;
                            $endPage = min(5, $totalPages);
                        }
                        
                        // Jika di akhir, pastikan tampil 5 halaman
                        if ($currentPage >= $totalPages - 2) {
                            $startPage = max(1, $totalPages - 4);
                            $endPage = $totalPages;
                        }
                        
                        // Tampilkan tombol pertama jika tidak termasuk
                        if ($startPage > 1): ?>
                            <button class="pagination-btn" onclick="goToPage(1)">1</button>
                            <?php if ($startPage > 2): ?>
                                <span class="pagination-btn" style="border: none; background: transparent; cursor: default;">...</span>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                            <button class="pagination-btn <?php echo $page == $currentPage ? 'active' : ''; ?>" 
                                    onclick="goToPage(<?php echo $page; ?>)">
                                <?php echo $page; ?>
                            </button>
                        <?php endfor; ?>
                        
                        <!-- Tampilkan tombol terakhir jika tidak termasuk -->
                        <?php if ($endPage < $totalPages): ?>
                            <?php if ($endPage < $totalPages - 1): ?>
                                <span class="pagination-btn" style="border: none; background: transparent; cursor: default;">...</span>
                            <?php endif; ?>
                            <button class="pagination-btn" onclick="goToPage(<?php echo $totalPages; ?>)">
                                <?php echo $totalPages; ?>
                            </button>
                        <?php endif; ?>
                        
                        <!-- Next Button -->
                        <button class="pagination-btn" 
                                onclick="goToPage(<?php echo $currentPage + 1; ?>)" 
                                <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Info Summary -->
                    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 14px;">
                        <div>
                            <i class="fas fa-door-open"></i>
                            Halaman <?php echo $currentPage; ?> dari <?php echo $totalPages; ?>
                            (Total: <?php echo $totalRooms; ?> ruangan)
                        </div>
                        <div style="display: flex; gap: 15px;">
                            <button class="action-btn" onclick="refreshPage()">
                                <i class="fas fa-redo"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit Room -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" id="closeEditModal">
                <i class="fas fa-times"></i>
            </button>
            
            <h2 class="modal-title">
                <i class="fas fa-edit"></i> Edit Ruangan
            </h2>
            
            <form id="editForm" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editRoomId">
                
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label><i class="fas fa-door-open"></i> Nama Ruangan</label>
                        <input type="text" name="name" id="editRoomName" placeholder="Contoh: Ruang Rapat Utama" required>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-users"></i> Kapasitas</label>
                        <input type="number" name="capacity" id="editRoomCapacity" min="1" max="100" placeholder="Jumlah orang" required>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-image"></i> Wallpaper (Upload)</label>
                        <div id="editWallpaperInputs"></div>
                        <div id="editRemovedWallpapers"></div>
                        <button type="button" class="action-btn" id="addEditWallpaperInput">
                            <i class="fas fa-plus"></i> Tambah File Wallpaper
                        </button>
                        <div id="editWallpaperPreview" style="margin-top: 10px; border: 1px dashed var(--stroke); border-radius: 10px; padding: 10px;">
                            <div id="editWallpaperCurrentLabel" style="font-size: 12px; color: var(--muted); margin-bottom: 6px;">Wallpaper Saat Ini</div>
                            <div id="editWallpaperGrid" class="edit-wallpaper-gallery"></div>
                            <div id="editWallpaperEmpty" style="color: var(--muted); font-size: 12px; text-align: center;">Belum ada wallpaper.</div>
                            <div id="editWallpaperUploadLabel" style="font-size: 12px; color: var(--muted); margin: 12px 0 6px;">File Akan Diupload</div>
                            <div id="editSelectedWallpaperGrid" class="edit-wallpaper-gallery"></div>
                            <div id="editSelectedWallpaperEmpty" style="color: var(--muted); font-size: 12px; text-align: center;">Belum ada file baru dipilih.</div>
                        </div>
                        <small id="editWallpaperHint" style="color: var(--muted); font-size: 12px;">Bisa pilih lebih dari 1 file. Biarkan kosong untuk mempertahankan wallpaper lama.</small>
                    </div>
                    
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <button type="submit" id="editSubmitBtn" style="flex: 1; background: var(--accent); color: #1a1a1a; border: none; padding: 15px; border-radius: 10px; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" id="cancelEdit">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Delete Confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" id="closeDeleteModal">
                <i class="fas fa-times"></i>
            </button>
            
            <div style="text-align: center; margin-bottom: 25px;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(255, 87, 87, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; border: 2px solid rgba(255, 87, 87, 0.3);">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px; color: var(--error);"></i>
                </div>
                <h3 style="font-family: 'Fraunces', serif; font-size: 20px; color: var(--ink); margin-bottom: 10px;">
                    Hapus Ruangan
                </h3>
                <p style="color: var(--muted); font-size: 14px; line-height: 1.5;">
                    Apakah Anda yakin ingin menghapus ruangan <span id="deleteRoomName" style="color: var(--ink); font-weight: 600;"></span>?
                </p>
                <p style="color: var(--error); font-size: 13px; margin-top: 10px; background: rgba(255, 87, 87, 0.1); padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 87, 87, 0.2);">
                    <i class="fas fa-info-circle"></i> Semua booking yang terkait juga akan dihapus.
                </p>
            </div>
            
            <form id="deleteForm" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="deleteRoomId">
                
                <div style="display: flex; gap: 10px;">
                    <button type="submit" id="deleteSubmitBtn" style="flex: 1; background: var(--error); color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fas fa-trash"></i>
                        Ya, Hapus
                    </button>
                    <button type="button" id="cancelDelete">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview Wallpaper -->
    <div id="wallpaperModal" class="modal">
        <div class="wallpaper-lightbox-content">
            <button type="button" id="closeWallpaperModal" aria-label="Tutup preview">
                <i class="fas fa-times"></i>
            </button>
            <img id="wallpaperModalImage" src="" alt="Preview wallpaper">
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');
            const wallpaperModal = document.getElementById('wallpaperModal');
            const wallpaperModalImage = document.getElementById('wallpaperModalImage');
            const closeWallpaperModalBtn = document.getElementById('closeWallpaperModal');
            const editForm = document.getElementById('editForm');
            const deleteForm = document.getElementById('deleteForm');
            const closeEditModalBtn = document.getElementById('closeEditModal');
            const closeDeleteModalBtn = document.getElementById('closeDeleteModal');
            const cancelEditBtn = document.getElementById('cancelEdit');
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            const editSubmitBtn = document.getElementById('editSubmitBtn');
            const deleteSubmitBtn = document.getElementById('deleteSubmitBtn');
            const editRoomNameInput = document.getElementById('editRoomName');
            const editRoomCapacityInput = document.getElementById('editRoomCapacity');
            const createWallpaperInputs = document.getElementById('createWallpaperInputs');
            const editWallpaperInputs = document.getElementById('editWallpaperInputs');
            const addCreateWallpaperInputBtn = document.getElementById('addCreateWallpaperInput');
            const addEditWallpaperInputBtn = document.getElementById('addEditWallpaperInput');
            const createSelectedWallpaperGrid = document.getElementById('createSelectedWallpaperGrid');
            const createSelectedWallpaperEmpty = document.getElementById('createSelectedWallpaperEmpty');
            const editRemovedWallpapers = document.getElementById('editRemovedWallpapers');
            const editWallpaperGrid = document.getElementById('editWallpaperGrid');
            const editWallpaperEmpty = document.getElementById('editWallpaperEmpty');
            const editWallpaperCurrentLabel = document.getElementById('editWallpaperCurrentLabel');
            const editWallpaperUploadLabel = document.getElementById('editWallpaperUploadLabel');
            const editSelectedWallpaperGrid = document.getElementById('editSelectedWallpaperGrid');
            const editSelectedWallpaperEmpty = document.getElementById('editSelectedWallpaperEmpty');
            const editWallpaperHint = document.getElementById('editWallpaperHint');
            let previewObjectUrls = [];
            let createPreviewObjectUrls = [];
            let createSelectedUploadEntries = [];
            let existingWallpaperUrls = [];
            let removedExistingWallpapers = [];
            let selectedUploadEntries = [];
            let hasExistingWallpaper = false;
            let hasSelectedWallpaper = false;

            function setModalOpenState() {
                const isOpen =
                    (editModal && editModal.style.display === 'flex') ||
                    (deleteModal && deleteModal.style.display === 'flex') ||
                    (wallpaperModal && wallpaperModal.style.display === 'flex');
                document.body.classList.toggle('modal-open', !!isOpen);
            }

            function openWallpaperModal(src, altText) {
                if (!wallpaperModal || !wallpaperModalImage || !src) return;
                wallpaperModalImage.src = src;
                wallpaperModalImage.alt = altText || 'Preview wallpaper';
                wallpaperModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                setModalOpenState();
            }

            function closeWallpaperModal() {
                if (!wallpaperModal || !wallpaperModalImage) return;
                wallpaperModal.style.display = 'none';
                wallpaperModalImage.src = '';
                if (editModal.style.display !== 'flex' && deleteModal.style.display !== 'flex') {
                    document.body.style.overflow = 'auto';
                }
                setModalOpenState();
            }

            function normalizeWallpaperUrl(url) {
                if (!url) return '';
                const cleaned = String(url)
                    .replace(/^[\s'",\\]+/, '')
                    .replace(/[\s'",\\]+$/, '');
                if (!cleaned) return '';
                if (
                    cleaned.startsWith('data:') ||
                    cleaned.startsWith('blob:') ||
                    cleaned.startsWith('http://') ||
                    cleaned.startsWith('https://') ||
                    cleaned.startsWith('/')
                ) {
                    return cleaned;
                }
                return '/' + cleaned;
            }

            function getWallpaperCandidates(url) {
                const base = normalizeWallpaperUrl(url);
                if (!base) return [];
                const candidates = [base];
                if (base.startsWith('/uploads/')) {
                    candidates.push('/public' + base);
                } else if (base.startsWith('/public/uploads/')) {
                    candidates.push(base.replace(/^\/public/, ''));
                }
                return [...new Set(candidates)];
            }

            function clearPreviewObjectUrls() {
                previewObjectUrls.forEach(url => URL.revokeObjectURL(url));
                previewObjectUrls = [];
                selectedUploadEntries = [];
            }

            function clearCreatePreviewObjectUrls() {
                createPreviewObjectUrls.forEach(url => URL.revokeObjectURL(url));
                createPreviewObjectUrls = [];
                createSelectedUploadEntries = [];
            }

            function syncRemovedWallpaperInputs() {
                if (!editRemovedWallpapers) return;
                editRemovedWallpapers.innerHTML = '';
                removedExistingWallpapers.forEach(path => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'remove_wallpapers[]';
                    input.value = path;
                    editRemovedWallpapers.appendChild(input);
                });
            }

            function updateWallpaperPreviewVisibility() {
                const isCompletelyEmpty = !hasExistingWallpaper && !hasSelectedWallpaper;

                if (editWallpaperCurrentLabel) {
                    editWallpaperCurrentLabel.style.display = isCompletelyEmpty ? 'none' : 'block';
                }

                if (editWallpaperUploadLabel) {
                    editWallpaperUploadLabel.style.display = isCompletelyEmpty ? 'none' : 'block';
                }

                if (editSelectedWallpaperGrid) {
                    editSelectedWallpaperGrid.style.display = isCompletelyEmpty ? 'none' : 'grid';
                }

                if (editSelectedWallpaperEmpty) {
                    if (isCompletelyEmpty || hasSelectedWallpaper) {
                        editSelectedWallpaperEmpty.style.display = 'none';
                    } else {
                        editSelectedWallpaperEmpty.style.display = 'block';
                    }
                }

                if (editWallpaperHint) {
                    editWallpaperHint.style.display = isCompletelyEmpty ? 'none' : 'block';
                }

                if (editWallpaperEmpty) {
                    if (hasExistingWallpaper) {
                        editWallpaperEmpty.style.display = 'none';
                    } else {
                        editWallpaperEmpty.style.display = 'block';
                        editWallpaperEmpty.textContent = 'Belum ada wallpaper.';
                    }
                }
            }

            function setWallpaperPreview(urls) {
                if (!editWallpaperGrid || !editWallpaperEmpty) return;
                const list = Array.isArray(urls) ? urls : (urls ? [urls] : []);
                editWallpaperGrid.innerHTML = '';

                const valid = list.map(item => String(item || '').trim()).filter(Boolean);
                hasExistingWallpaper = valid.length > 0;
                if (!valid.length) {
                    updateWallpaperPreviewVisibility();
                    return;
                }

                valid.forEach((url, index) => {
                    const wrap = document.createElement('div');
                    wrap.className = 'edit-wallpaper-thumb';
                    const img = document.createElement('img');
                    img.alt = `Wallpaper ${index + 1}`;

                    const candidates = getWallpaperCandidates(url);
                    if (candidates.length) {
                        let i = 0;
                        const tryLoad = () => {
                            const current = candidates[i];
                            if (!current) {
                                wrap.remove();
                                if (!editWallpaperGrid.children.length) {
                                    editWallpaperEmpty.style.display = 'block';
                                    editWallpaperEmpty.textContent = 'Wallpaper gagal dimuat.';
                                }
                                return;
                            }
                            img.onerror = () => {
                                i += 1;
                                tryLoad();
                            };
                            img.src = current;
                        };
                        tryLoad();
                    } else {
                        wrap.remove();
                    }

                    wrap.appendChild(img);
                    img.addEventListener('click', () => openWallpaperModal(img.src, img.alt));
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'edit-wallpaper-remove';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.title = 'Hapus wallpaper';
                    removeBtn.addEventListener('click', () => {
                        removedExistingWallpapers.push(url);
                        removedExistingWallpapers = Array.from(new Set(removedExistingWallpapers));
                        existingWallpaperUrls = existingWallpaperUrls.filter(item => item !== url);
                        syncRemovedWallpaperInputs();
                        setWallpaperPreview(existingWallpaperUrls);
                    });
                    wrap.appendChild(removeBtn);
                    editWallpaperGrid.appendChild(wrap);
                });

                updateWallpaperPreviewVisibility();
            }

            function setSelectedWallpaperPreview(entries) {
                if (!editSelectedWallpaperGrid || !editSelectedWallpaperEmpty) return;
                editSelectedWallpaperGrid.innerHTML = '';
                const list = Array.isArray(entries) ? entries : [];
                hasSelectedWallpaper = list.length > 0;
                if (!list.length) {
                    updateWallpaperPreviewVisibility();
                    return;
                }
                updateWallpaperPreviewVisibility();

                list.forEach((entry, index) => {
                    const wrap = document.createElement('div');
                    wrap.className = 'edit-wallpaper-thumb';
                    const img = document.createElement('img');
                    img.alt = `File baru ${index + 1}`;
                    img.src = entry.objectUrl;
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'edit-wallpaper-remove';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.title = 'Hapus file ini';
                    removeBtn.addEventListener('click', () => {
                        const targetInput = entry.input;
                        if (!targetInput || !targetInput.files) return;

                        const dt = new DataTransfer();
                        const files = Array.from(targetInput.files);
                        files.forEach(file => {
                            const key = `${file.name}__${file.size}__${file.lastModified}`;
                            if (key !== entry.fileKey) {
                                dt.items.add(file);
                            }
                        });

                        targetInput.files = dt.files;
                        if (targetInput.classList.contains('edit-extra-wallpaper-input') && dt.files.length === 0) {
                            targetInput.remove();
                        }
                        updateEditPreviewFromSelectedFiles();
                    });
                    wrap.appendChild(img);
                    img.addEventListener('click', () => openWallpaperModal(img.src, img.alt));
                    wrap.appendChild(removeBtn);
                    editSelectedWallpaperGrid.appendChild(wrap);
                });
            }

            function setCreateSelectedWallpaperPreview(entries) {
                if (!createSelectedWallpaperGrid || !createSelectedWallpaperEmpty) return;
                createSelectedWallpaperGrid.innerHTML = '';
                const list = Array.isArray(entries) ? entries : [];

                if (!list.length) {
                    createSelectedWallpaperEmpty.style.display = 'block';
                    return;
                }

                createSelectedWallpaperEmpty.style.display = 'none';
                list.forEach((entry, index) => {
                    const wrap = document.createElement('div');
                    wrap.className = 'edit-wallpaper-thumb';
                    const img = document.createElement('img');
                    img.alt = `Preview create ${index + 1}`;
                    img.src = entry.objectUrl;
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'edit-wallpaper-remove';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.title = 'Hapus file ini';
                    removeBtn.addEventListener('click', () => {
                        const targetInput = entry.input;
                        if (!targetInput || !targetInput.files) return;

                        const dt = new DataTransfer();
                        const files = Array.from(targetInput.files);
                        files.forEach(file => {
                            const key = `${file.name}__${file.size}__${file.lastModified}`;
                            if (key !== entry.fileKey) {
                                dt.items.add(file);
                            }
                        });

                        targetInput.files = dt.files;
                        if (targetInput.classList.contains('create-extra-wallpaper-input') && dt.files.length === 0) {
                            targetInput.remove();
                        }
                        updateCreatePreviewFromSelectedFiles();
                    });
                    wrap.appendChild(img);
                    img.addEventListener('click', () => openWallpaperModal(img.src, img.alt));
                    wrap.appendChild(removeBtn);
                    createSelectedWallpaperGrid.appendChild(wrap);
                });
            }

            function parseWallpaperArray(raw) {
                if (!raw) return [];
                try {
                    const parsed = JSON.parse(raw);
                    if (Array.isArray(parsed)) {
                        return parsed.map(item => String(item || '').trim()).filter(Boolean);
                    }
                } catch (e) {}
                return [];
            }

            function updateEditPreviewFromSelectedFiles() {
                if (!editWallpaperInputs) return;
                clearPreviewObjectUrls();
                const inputs = Array.from(editWallpaperInputs.querySelectorAll('input[type="file"]'));
                const entries = [];
                inputs.forEach(input => {
                    const files = input.files ? Array.from(input.files) : [];
                    files.forEach(file => {
                        const objectUrl = URL.createObjectURL(file);
                        previewObjectUrls.push(objectUrl);
                        const fileKey = `${file.name}__${file.size}__${file.lastModified}`;
                        entries.push({ input, objectUrl, fileKey });
                    });
                });
                selectedUploadEntries = entries;
                setSelectedWallpaperPreview(selectedUploadEntries);
            }

            function updateCreatePreviewFromSelectedFiles() {
                if (!createWallpaperInputs) return;
                clearCreatePreviewObjectUrls();
                const inputs = Array.from(createWallpaperInputs.querySelectorAll('input[type="file"][name="wallpaper_files[]"]'));
                const entries = [];
                inputs.forEach(input => {
                    const files = input.files ? Array.from(input.files) : [];
                    files.forEach(file => {
                        const objectUrl = URL.createObjectURL(file);
                        createPreviewObjectUrls.push(objectUrl);
                        const fileKey = `${file.name}__${file.size}__${file.lastModified}`;
                        entries.push({ input, objectUrl, fileKey });
                    });
                });
                createSelectedUploadEntries = entries;
                setCreateSelectedWallpaperPreview(createSelectedUploadEntries);
            }

            function bindEditWallpaperPreview(inputEl) {
                if (!inputEl || inputEl.dataset.previewBound === '1') return;
                inputEl.dataset.previewBound = '1';
                inputEl.addEventListener('change', function () {
                    updateEditPreviewFromSelectedFiles();
                });
            }

            function bindCreateWallpaperPreview(inputEl) {
                if (!inputEl || inputEl.dataset.previewBound === '1') return;
                inputEl.dataset.previewBound = '1';
                inputEl.addEventListener('change', function () {
                    updateCreatePreviewFromSelectedFiles();
                });
            }

            if (addCreateWallpaperInputBtn && createWallpaperInputs) {
                addCreateWallpaperInputBtn.addEventListener('click', function() {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.name = 'wallpaper_files[]';
                    input.accept = 'image/*';
                    input.multiple = true;
                    input.className = 'create-extra-wallpaper-input';
                    input.style.display = 'none';
                    bindCreateWallpaperPreview(input);
                    input.addEventListener('change', function() {
                        const files = this.files ? Array.from(this.files) : [];
                        if (!files.length) {
                            this.remove();
                            return;
                        }
                        updateCreatePreviewFromSelectedFiles();
                    });
                    createWallpaperInputs.appendChild(input);
                    input.click();
                });
            }

            if (addEditWallpaperInputBtn && editWallpaperInputs) {
                addEditWallpaperInputBtn.addEventListener('click', function() {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.name = 'wallpaper_files[]';
                    input.accept = 'image/*';
                    input.multiple = true;
                    input.className = 'edit-extra-wallpaper-input';
                    input.style.display = 'none';
                    input.addEventListener('change', function() {
                        const files = this.files ? Array.from(this.files) : [];
                        if (!files.length) {
                            this.remove();
                            return;
                        }
                        updateEditPreviewFromSelectedFiles();
                    });
                    editWallpaperInputs.appendChild(input);
                    input.click();
                });
            }

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-wallpaper-input');
                if (!btn) return;
                const row = btn.closest('.wallpaper-input-row');
                if (!row) return;
                const parent = row.parentElement;
                if (parent && parent.children.length <= 1) {
                    const input = row.querySelector('input[type="file"]');
                    if (input) input.value = '';
                    if (parent.id === 'createWallpaperInputs') {
                        updateCreatePreviewFromSelectedFiles();
                    } else {
                        updateEditPreviewFromSelectedFiles();
                    }
                    return;
                }
                row.remove();
                if (parent && parent.id === 'createWallpaperInputs') {
                    updateCreatePreviewFromSelectedFiles();
                } else {
                    updateEditPreviewFromSelectedFiles();
                }
            });
            
            // State
            let isLoading = false;
            
            // Edit button functionality
            const editButtons = document.querySelectorAll('.action-btn.edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (isLoading) return;
                    
                    const roomId = this.getAttribute('data-room-id');
                    const roomName = this.getAttribute('data-room-name');
                    const roomCapacity = this.getAttribute('data-room-capacity');
                    const roomWallpaper = this.getAttribute('data-room-wallpaper') || '';
                    const roomWallpapers = parseWallpaperArray(this.getAttribute('data-room-wallpapers') || '[]');
                    
                    // Load room data via AJAX for more accurate data
                    loadRoomData(roomId, roomName, roomCapacity, roomWallpaper, roomWallpapers);
                });
            });
            
            // Function to load room data
            async function loadRoomData(roomId, roomName, roomCapacity, roomWallpaper, roomWallpapers) {
                // Show loading in modal
                editSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Memuat...';
                editSubmitBtn.disabled = true;
                removedExistingWallpapers = [];
                syncRemovedWallpaperInputs();
                
                // Disable cancel button during loading
                if (cancelEditBtn) cancelEditBtn.disabled = true;
                
                // Show modal first
                editModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                setModalOpenState();
                
                try {
                    // Try to load fresh data via AJAX
                    const response = await fetch(`?ajax=get_room&id=${roomId}&_=${Date.now()}`);
                    
                    if (response.ok) {
                        const roomData = await response.json();
                        
                        if (roomData.error) {
                            // Fallback to data attributes
                            document.getElementById('editRoomId').value = roomId;
                            editRoomNameInput.value = roomName;
                            editRoomCapacityInput.value = roomCapacity;
                            existingWallpaperUrls = roomWallpapers && roomWallpapers.length ? roomWallpapers : [roomWallpaper];
                            setWallpaperPreview(existingWallpaperUrls);
                            setSelectedWallpaperPreview([]);
                        } else {
                            // Use fresh data from server
                            document.getElementById('editRoomId').value = roomData.id;
                            editRoomNameInput.value = roomData.name;
                            editRoomCapacityInput.value = roomData.capacity;
                            existingWallpaperUrls = roomData.wallpaper_urls || roomWallpapers || [roomData.wallpaper_url || roomWallpaper];
                            setWallpaperPreview(existingWallpaperUrls);
                            setSelectedWallpaperPreview([]);
                        }
                    } else {
                        // Fallback to data attributes
                        document.getElementById('editRoomId').value = roomId;
                        editRoomNameInput.value = roomName;
                        editRoomCapacityInput.value = roomCapacity;
                        existingWallpaperUrls = roomWallpapers && roomWallpapers.length ? roomWallpapers : [roomWallpaper];
                        setWallpaperPreview(existingWallpaperUrls);
                        setSelectedWallpaperPreview([]);
                    }
                } catch (error) {
                    console.error('Error loading room data:', error);
                    // Fallback to data attributes
                    document.getElementById('editRoomId').value = roomId;
                    editRoomNameInput.value = roomName;
                    editRoomCapacityInput.value = roomCapacity;
                    existingWallpaperUrls = roomWallpapers && roomWallpapers.length ? roomWallpapers : [roomWallpaper];
                    setWallpaperPreview(existingWallpaperUrls);
                    setSelectedWallpaperPreview([]);
                } finally {
                    // Reset button
                    editSubmitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
                    editSubmitBtn.disabled = false;
                    if (cancelEditBtn) cancelEditBtn.disabled = false;
                    isLoading = false;
                }
            }
            
            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const roomId = this.getAttribute('data-room-id');
                    const roomName = this.getAttribute('data-room-name');
                    
                    // Populate delete modal
                    document.getElementById('deleteRoomName').textContent = roomName;
                    document.getElementById('deleteRoomId').value = roomId;
                    
                    // Show modal
                    deleteModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    setModalOpenState();
                });
            });
            
            // Close modal functions
            function closeEditModal() {
                editModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                editSubmitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
                editSubmitBtn.disabled = false;
                if (cancelEditBtn) cancelEditBtn.disabled = false;
                editForm.reset();
                if (editWallpaperInputs) {
                    const extraInputs = editWallpaperInputs.querySelectorAll('input.edit-extra-wallpaper-input');
                    extraInputs.forEach(input => input.remove());
                }
                clearPreviewObjectUrls();
                removedExistingWallpapers = [];
                syncRemovedWallpaperInputs();
                setWallpaperPreview([]);
                setSelectedWallpaperPreview([]);
                setModalOpenState();
            }

            
            function closeDeleteModal() {
                deleteModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                deleteSubmitBtn.innerHTML = '<i class="fas fa-trash"></i> Ya, Hapus';
                deleteSubmitBtn.disabled = false;
                if (cancelDeleteBtn) cancelDeleteBtn.disabled = false;
                setModalOpenState();
            }
            
            // Event listeners for modal close buttons
            closeEditModalBtn.addEventListener('click', closeEditModal);
            closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
            if (closeWallpaperModalBtn) closeWallpaperModalBtn.addEventListener('click', closeWallpaperModal);
            cancelEditBtn.addEventListener('click', closeEditModal);
            cancelDeleteBtn.addEventListener('click', closeDeleteModal);
            
            // Close modal when clicking outside
            editModal.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    closeEditModal();
                }
            });
            
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    closeDeleteModal();
                }
            });

            if (wallpaperModal) {
                wallpaperModal.addEventListener('click', function(e) {
                    if (e.target === wallpaperModal) {
                        closeWallpaperModal();
                    }
                });
            }
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (wallpaperModal && wallpaperModal.style.display === 'flex') {
                        closeWallpaperModal();
                        return;
                    }
                    if (editModal.style.display === 'flex') {
                        closeEditModal();
                    }
                    if (deleteModal.style.display === 'flex') {
                        closeDeleteModal();
                    }
                }
            });
            
            // Edit form validation
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (isLoading) return;
                
                const capacity = parseInt(editRoomCapacityInput.value);
                
                if (capacity < 1 || capacity > 100) {
                    showAlert('Kapasitas harus antara 1-100 orang.', 'error');
                    return;
                }
                
                if (editRoomNameInput.value.trim() === '') {
                    showAlert('Nama ruangan tidak boleh kosong.', 'error');
                    return;
                }

                const fileInputs = Array.from(editForm.querySelectorAll('input[type="file"][name="wallpaper_files[]"]'));
                const hasFile = fileInputs.some(input => input.files && input.files.length > 0);
                if (hasFile) {
                    // Use normal form submit for file uploads to avoid AJAX issues
                    editForm.submit();
                    return;
                }

                submitEditForm();
            });
            
            // Function to submit edit form
            function submitEditForm() {
                isLoading = true;
                
                // Show loading state
                editSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menyimpan...';
                editSubmitBtn.disabled = true;
                
                // Disable cancel button during submission
                if (cancelEditBtn) cancelEditBtn.disabled = true;
                
                const formData = new FormData(editForm);
                
                // Submit form via AJAX
                fetch(window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.text();
                    }
                })
                .then(data => {
                    if (data) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const alert = doc.querySelector('.alert');
                        
                        if (alert) {
                            showAlert(alert.textContent.trim(), alert.classList.contains('error') ? 'error' : 'success');
                            closeEditModal();
                            
                            if (alert.classList.contains('success')) {
                                setTimeout(() => {
                                    refreshPage();
                                }, 1500);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat menyimpan data.', 'error');
                })
                .finally(() => {
                    isLoading = false;
                    // Enable cancel button
                    if (cancelEditBtn) cancelEditBtn.disabled = false;
                });
            }
            
            // Delete form submission
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (isLoading) return;
                isLoading = true;
                
                // Show loading state
                deleteSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menghapus...';
                deleteSubmitBtn.disabled = true;
                
                // Disable cancel button during submission
                if (cancelDeleteBtn) cancelDeleteBtn.disabled = true;
                
                const formData = new FormData(this);
                
                // Submit form via AJAX
                fetch(window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.text();
                    }
                })
                .then(data => {
                    if (data) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const alert = doc.querySelector('.alert');
                        
                        if (alert) {
                            showAlert(alert.textContent.trim(), alert.classList.contains('error') ? 'error' : 'success');
                            closeDeleteModal();
                            
                            if (alert.classList.contains('success')) {
                                setTimeout(() => {
                                    refreshPage();
                                }, 1500);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat menghapus ruangan.', 'error');
                })
                .finally(() => {
                    isLoading = false;
                    // Enable cancel button
                    if (cancelDeleteBtn) cancelDeleteBtn.disabled = false;
                });
            });
            
            // Main form submission (create room)
            const mainForm = document.querySelector('form.grid');
            if (mainForm) {
                mainForm.addEventListener('submit', function(e) {
                    const capacityInput = this.querySelector('input[name="capacity"]');
                    const capacity = parseInt(capacityInput.value);
                    
                    if (capacity < 1 || capacity > 100) {
                        e.preventDefault();
                        showAlert('Kapasitas harus antara 1-100 orang.', 'error');
                        return false;
                    }
                    
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menambahkan...';
                    submitBtn.disabled = true;
                    
                    return true;
                });
            }
            
            // Helper function to show alerts
            function showAlert(message, type) {
                // Remove existing alerts
                const existingAlerts = document.querySelectorAll('.alert');
                existingAlerts.forEach(alert => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                });
                
                // Create new alert
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert ${type}`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
                    ${message}
                `;
                
                // Insert after the h1 in the first card
                const card = document.querySelector('.card');
                const h1 = card.querySelector('h1');
                if (h1 && h1.parentNode) {
                    h1.parentNode.insertBefore(alertDiv, h1.nextSibling);
                }
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }
            
            // Prevent form resubmission warning
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        });
        
        // Function for pagination navigation
        function goToPage(page) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', page);
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
        
        // Function to refresh without page parameter
        function refreshPage() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('page');
            window.location.href = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
        }
    </script>
</body>
</html>
