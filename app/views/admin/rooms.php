<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Kelola Room</title>
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
            
            .actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-door-closed"></i> Manajemen Ruangan</h1>
            <a href="/dashboard" class="back-btn">
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
                
                <form method="post" class="grid">
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
                                ?>
                                    <tr>
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
                                                <button class="action-btn edit" onclick="editRoom(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['name']); ?>', <?php echo $row['capacity']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button class="action-btn delete" onclick="deleteRoom(<?php echo $row['id']; ?>)">
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
                    
                    <!-- Info Summary -->
                    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 14px;">
                        <div>
                            <i class="fas fa-door-open"></i>
                            Total: <?php echo count($rooms); ?> ruangan
                            <?php 
                            $totalCapacity = array_sum(array_column($rooms, 'capacity'));
                            if ($totalCapacity > 0): ?>
                                | Total kapasitas: <?php echo $totalCapacity; ?> orang
                            <?php endif; ?>
                        </div>
                        <div style="display: flex; gap: 15px;">
                            <button class="action-btn" onclick="window.location.reload()">
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
            const form = document.querySelector('form');
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const capacityInput = document.querySelector('input[name="capacity"]');
                const capacity = parseInt(capacityInput.value);
                
                if (capacity < 1 || capacity > 100) {
                    e.preventDefault();
                    showAlert('Kapasitas harus antara 1-100 orang.', 'error');
                    return false;
                }
                
                // Add loading state to submit button
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
                submitBtn.disabled = true;
                
                return true;
            });
            
            // Cegah form resubmission warning
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        });
        
        // Fungsi untuk edit ruangan
        function editRoom(roomId, currentName, currentCapacity) {
            const newName = prompt('Nama ruangan baru:', currentName);
            if (newName === null) return;
            
            const newCapacity = prompt('Kapasitas baru:', currentCapacity);
            if (newCapacity === null) return;
            
            if (newName.trim() === '') {
                alert('Nama ruangan tidak boleh kosong!');
                return;
            }
            
            const capacityNum = parseInt(newCapacity);
            if (isNaN(capacityNum) || capacityNum < 1 || capacityNum > 100) {
                alert('Kapasitas harus angka antara 1-100!');
                return;
            }
            
            if (confirm(`Konfirmasi perubahan:\nNama: ${currentName} → ${newName}\nKapasitas: ${currentCapacity} → ${newCapacity}\n\nApakah Anda yakin?`)) {
                // Kirim AJAX request untuk edit
                fetch(`/room/${roomId}/edit`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        name: newName,
                        capacity: capacityNum
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Ruangan berhasil diperbarui!', 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showAlert(data.error || 'Gagal memperbarui ruangan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan.', 'error');
                });
            }
        }
        
        function deleteRoom(roomId) {
            if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?\n\nSemua booking yang terkait juga akan dihapus.')) {
                // Kirim AJAX request untuk delete
                fetch(`/room/${roomId}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Ruangan berhasil dihapus!', 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showAlert(data.error || 'Gagal menghapus ruangan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan.', 'error');
                });
            }
        }
        
        // Helper function untuk menampilkan alert
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
    </script>
</body>
</html>
