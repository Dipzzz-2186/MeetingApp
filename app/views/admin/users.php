<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Tambah User</title>
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
        }

        .card h2 {
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card h2 i {
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

        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-badge.admin {
            background: rgba(247, 200, 66, 0.15);
            color: var(--accent);
            border: 1px solid rgba(247, 200, 66, 0.3);
        }

        .role-badge.user {
            background: rgba(154, 160, 170, 0.15);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
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

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
            margin-right: 12px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-name {
            font-weight: 600;
            color: var(--ink);
        }

        .user-email {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
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

        .action-btn.delete:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
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
            align-items: center;
            justify-content: center;
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
            animation: slideUp 0.3s ease;
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
        }

        .modal-close:hover {
            color: var(--accent);
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

            .actions {
                flex-direction: column;
                gap: 6px;
            }

            .action-btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-users"></i> Manajemen User</h1>
            <a href="/dashboard_admin" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
        
        <div class="grid-two">
            <!-- Form Tambah User -->
            <div class="card">
                <h1><i class="fas fa-user-plus"></i> Tambah User Baru</h1>
                
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
                
                <form method="post" class="grid">
                    <input type="hidden" name="action" value="create">
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama user" required>
                        </div>
                        <div>
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" placeholder="user@example.com" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                            <small style="color: var(--muted); font-size: 12px; margin-top: 5px;">Password akan dienkripsi</small>
                        </div>
                        <div>
                            <label><i class="fas fa-user-tag"></i> Role</label>
                            <select name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit">
                        <i class="fas fa-plus"></i>
                        Tambah User
                    </button>
                </form>
            </div>
            
            <!-- Daftar User -->
            <div class="card">
                <h2><i class="fas fa-list"></i> Daftar User</h2>
                
                <?php 
                // Konfigurasi pagination
                $itemsPerPage = 5;
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $totalUsers = count($users);
                $totalPages = ceil($totalUsers / $itemsPerPage);
                
                // Validasi page number
                if ($currentPage < 1) $currentPage = 1;
                if ($currentPage > $totalPages) $currentPage = $totalPages;
                
                // Potong data untuk halaman saat ini
                $startIndex = ($currentPage - 1) * $itemsPerPage;
                $paginatedUsers = array_slice($users, $startIndex, $itemsPerPage);
                ?>
                
                <?php if (!$users): ?>
                    <div class="empty-state">
                        <i class="fas fa-users-slash"></i>
                        <h3>Belum ada user</h3>
                        <p>Tambahkan user pertama Anda menggunakan form di samping</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paginatedUsers as $row): ?>
                                    <tr data-user-id="<?php echo $row['id']; ?>">
                                        <td data-label="User">
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <div class="user-name"><?php echo htmlspecialchars($row['name']); ?></div>
                                                    <div class="user-email"><?php echo htmlspecialchars($row['email']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Role">
                                            <span class="role-badge <?php echo htmlspecialchars($row['role']); ?>">
                                                <?php echo htmlspecialchars($row['role']); ?>
                                            </span>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="actions">
                                                <button class="action-btn edit" data-user-id="<?php echo $row['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button class="action-btn delete" data-user-id="<?php echo $row['id']; ?>" data-user-name="<?php echo htmlspecialchars($row['name']); ?>" data-user-email="<?php echo htmlspecialchars($row['email']); ?>">
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
                    
                    <!-- Info Pagination -->
                    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 14px;">
                        <div>
                            <i class="fas fa-users"></i>
                            Menampilkan <?php echo min($itemsPerPage, count($paginatedUsers)); ?> dari <?php echo $totalUsers; ?> user
                            (Halaman <?php echo $currentPage; ?> dari <?php echo $totalPages; ?>)
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
    
    <!-- Modal Edit User -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" id="closeEditModal">
                <i class="fas fa-times"></i>
            </button>
            
            <h2 style="font-family: 'Fraunces', serif; font-size: 24px; margin-bottom: 25px; color: var(--ink);">
                <i class="fas fa-user-edit"></i> Edit User
            </h2>
            
            <form id="editForm" method="post">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editUserId">
                
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" id="editName" placeholder="Masukkan nama user" required>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="editEmail" placeholder="user@example.com" required>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-lock"></i> Password (Opsional)</label>
                            <input type="password" name="password" id="editPassword" placeholder="Biarkan kosong jika tidak diubah">
                            <small style="color: var(--muted); font-size: 12px; margin-top: 5px;">Isi hanya jika ingin mengganti password</small>
                        </div>
                        
                        <div>
                            <label><i class="fas fa-user-tag"></i> Role</label>
                            <select name="role" id="editRole" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <button type="submit" id="editSubmitBtn" style="flex: 1; background: var(--accent); color: #1a1a1a; border: none; padding: 15px; border-radius: 10px; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" id="cancelEdit" style="flex: 0 0 auto; padding: 15px 20px; border-radius: 10px; border: 1px solid var(--stroke); background: rgba(17, 21, 28, 0.7); color: var(--muted); font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.2s ease;">
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
                    Hapus User
                </h3>
                <p style="color: var(--muted); font-size: 14px; line-height: 1.5;">
                    Apakah Anda yakin ingin menghapus user <span id="deleteUserName" style="color: var(--ink); font-weight: 600;"></span>?
                </p>
                <p style="color: var(--error); font-size: 13px; margin-top: 10px; background: rgba(255, 87, 87, 0.1); padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 87, 87, 0.2);">
                    <i class="fas fa-info-circle"></i> Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            
            <form id="deleteForm" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="deleteUserId">
                
                <div style="display: flex; gap: 10px;">
                    <button type="submit" id="deleteSubmitBtn" style="flex: 1; background: var(--error); color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fas fa-trash"></i>
                        Ya, Hapus
                    </button>
                    <button type="button" id="cancelDelete" style="flex: 1; padding: 12px; border-radius: 10px; border: 1px solid var(--stroke); background: rgba(17, 21, 28, 0.7); color: var(--muted); font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s ease;">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');
            const editForm = document.getElementById('editForm');
            const deleteForm = document.getElementById('deleteForm');
            const closeEditModalBtn = document.getElementById('closeEditModal');
            const closeDeleteModalBtn = document.getElementById('closeDeleteModal');
            const cancelEditBtn = document.getElementById('cancelEdit');
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            const editSubmitBtn = document.getElementById('editSubmitBtn');
            const deleteSubmitBtn = document.getElementById('deleteSubmitBtn');
            
            // State
            let isLoading = false;
            
            // Edit button functionality
            const editButtons = document.querySelectorAll('.action-btn.edit');
            editButtons.forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    if (isLoading) return;
                    
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.closest('tr').querySelector('.user-name').textContent;
                    const userEmail = this.closest('tr').querySelector('.user-email').textContent;
                    
                    // Show loading in modal
                    editSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Memuat...';
                    editSubmitBtn.disabled = true;
                    
                    // Show modal first
                    editModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    
                    try {
                        // Load user data via AJAX
                        const response = await fetch(`?ajax=get_user&id=${userId}&_=${Date.now()}`);
                        
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        
                        const userData = await response.json();
                        
                        if (userData.error) {
                            showAlert(userData.error, 'error');
                            closeEditModal();
                            return;
                        }
                        
                        // Populate edit form
                        document.getElementById('editUserId').value = userData.id;
                        document.getElementById('editName').value = userData.name;
                        document.getElementById('editEmail').value = userData.email;
                        document.getElementById('editRole').value = userData.role;
                        document.getElementById('editPassword').value = '';
                        
                        // Reset button
                        editSubmitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
                        editSubmitBtn.disabled = false;
                        
                    } catch (error) {
                        console.error('Error loading user data:', error);
                        showAlert('Gagal memuat data user. Silakan coba lagi.', 'error');
                        closeEditModal();
                    } finally {
                        isLoading = false;
                    }
                });
            });
            
            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');
                    const userEmail = this.getAttribute('data-user-email');
                    
                    // Populate delete modal
                    document.getElementById('deleteUserName').textContent = `${userName} (${userEmail})`;
                    document.getElementById('deleteUserId').value = userId;
                    
                    // Show modal
                    deleteModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });
            
            // Close modal functions
            function closeEditModal() {
                editModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                editSubmitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
                editSubmitBtn.disabled = false;
            }
            
            function closeDeleteModal() {
                deleteModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                deleteSubmitBtn.innerHTML = '<i class="fas fa-trash"></i> Ya, Hapus';
                deleteSubmitBtn.disabled = false;
            }
            
            // Event listeners for modal close buttons
            closeEditModalBtn.addEventListener('click', closeEditModal);
            closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
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
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (editModal.style.display === 'flex') {
                        closeEditModal();
                    }
                    if (deleteModal.style.display === 'flex') {
                        closeDeleteModal();
                    }
                }
            });
            
            // Edit form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (isLoading) return;
                isLoading = true;
                
                const formData = new FormData(this);
                const password = formData.get('password');
                
                // Validate password if provided
                // if (password && password.length < 8) {
                //     showAlert('Password harus minimal 8 karakter jika diisi.', 'error');
                //     isLoading = false;
                //     return;
                // }
                
                // Show loading state
                editSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menyimpan...';
                editSubmitBtn.disabled = true;
                
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
                        // If redirected, reload the page
                        window.location.href = response.url;
                    } else {
                        return response.text();
                    }
                })
                .then(data => {
                    if (data) {
                        // Parse HTML response to check for alerts
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const alert = doc.querySelector('.alert');
                        
                        if (alert) {
                            showAlert(alert.textContent.trim(), alert.classList.contains('error') ? 'error' : 'success');
                            closeEditModal();
                            
                            // Refresh the page after a short delay if successful
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
                });
            });
            
            // Delete form submission
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (isLoading) return;
                isLoading = true;
                
                // Show loading state
                deleteSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menghapus...';
                deleteSubmitBtn.disabled = true;
                
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
                    showAlert('Terjadi kesalahan saat menghapus user.', 'error');
                })
                .finally(() => {
                    isLoading = false;
                });
            });
            
            // Main form submission (create user)
            const mainForm = document.querySelector('form.grid');
            if (mainForm) {
                mainForm.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin spinner"></i> Menambahkan...';
                    submitBtn.disabled = true;
                    
                    // Allow form to submit normally
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