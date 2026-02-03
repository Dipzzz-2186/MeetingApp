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
                                    <tr>
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
                                                <button class="action-btn edit">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button class="action-btn delete">
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
                            <button class="action-btn" onclick="window.location.href='?page=1'">
                                <i class="fas fa-redo"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength indicator (contoh)
            const passwordInput = document.querySelector('input[name="password"]');
            const form = document.querySelector('form');
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const password = passwordInput.value;
                
                // if (password.length < 8) {
                //     e.preventDefault();
                //     showAlert('Password harus minimal 8 karakter.', 'error');
                //     return false;
                // }
                
                // Add loading state to submit button
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
                submitBtn.disabled = true;
                
                return true;
            });
            
            // Delete button confirmation
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                        // Here you would typically make an AJAX request or submit a form
                        console.log('User deletion confirmed');
                    }
                });
            });
            
            // Edit button functionality
            const editButtons = document.querySelectorAll('.action-btn.edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = this.closest('tr');
                    const userName = row.querySelector('.user-name').textContent;
                    const userEmail = row.querySelector('.user-email').textContent;
                    
                    alert(`Edit user: ${userName}\nEmail: ${userEmail}`);
                    // Here you would typically open a modal or redirect to edit page
                });
            });
            
            // Helper function to show alerts
            function showAlert(message, type) {
                // Remove existing alerts
                const existingAlerts = document.querySelectorAll('.alert');
                existingAlerts.forEach(alert => alert.remove());
                
                // Create new alert
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert ${type}`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
                    ${message}
                `;
                
                // Insert after the h1
                const card = document.querySelector('.card');
                const h1 = card.querySelector('h1');
                h1.insertAdjacentElement('afterend', alertDiv);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }
            
            // Cegah form resubmission warning
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        });
        
        // Fungsi untuk navigasi pagination
        function goToPage(page) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', page);
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
        
        // Fungsi untuk refresh tanpa parameter page
        function refreshPage() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('page');
            window.location.href = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
        }
    </script>
</body>
</html>
