<?php
/** @var array $admins */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Manage Admins</title>
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
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        .search-container {
            margin-bottom: 30px;
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            font-size: 15px;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: var(--card);
            border-radius: 12px;
            border: 1px solid var(--stroke);
            min-width: 200px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--ink);
        }

        .stat-icon.total {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        .stat-icon.trial {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .stat-icon.paid {
            background: linear-gradient(135deg, var(--success) 0%, #8dffa4 100%);
        }

        .stat-content {
            flex: 1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
        }

        /* Table Container */
        .table-container {
            background: var(--card);
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-header h2 {
            font-family: "Fraunces", serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header h2 i {
            color: var(--accent);
        }

        /* Table Styles */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
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

        .table th:first-child {
            border-radius: 12px 0 0 0;
        }

        .table th:last-child {
            border-radius: 0 12px 0 0;
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

        /* Admin Avatar */
        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 16px;
            text-transform: uppercase;
        }

        /* Badge Styles */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-trial {
            background: rgba(87, 184, 255, 0.1);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        .badge-paid {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .badge-active {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .badge-inactive {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
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

        .action-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .action-btn.view:hover {
            border-color: var(--info);
            color: var(--info);
            background: rgba(87, 184, 255, 0.1);
        }

        .action-btn.edit:hover {
            border-color: var(--warning);
            color: var(--warning);
            background: rgba(255, 168, 87, 0.1);
        }

        .action-btn.delete:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding: 20px 0;
            border-top: 1px solid var(--stroke);
        }

        .pagination-info {
            font-size: 13px;
            color: var(--muted);
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--ink);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .pagination-btn:hover:not(:disabled) {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-numbers {
            display: flex;
            gap: 5px;
        }

        .page-number {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--ink);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .page-number:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .page-number.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(11, 13, 18, 0.85);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card);
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
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
            z-index: 1;
        }

        .modal-header h2 {
            font-family: "Fraunces", serif;
            font-size: 22px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
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
        }

        /* Admin Info Grid */
        .admin-info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 30px;
            margin-bottom: 30px;
            align-items: start;
        }

        .admin-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 36px;
            text-transform: uppercase;
        }

        .admin-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .admin-name {
            font-family: "Fraunces", serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--ink);
        }

        .admin-email {
            font-size: 16px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .admin-stat-item {
            background: rgba(17, 21, 28, 0.5);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid var(--stroke);
            text-align: center;
        }

        .admin-stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 5px;
        }

        .admin-stat-label {
            font-size: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Sections in Modal */
        .modal-section {
            margin-bottom: 30px;
        }

        .modal-section h3 {
            font-family: "Fraunces", serif;
            font-size: 18px;
            color: var(--ink);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--stroke);
        }

        .modal-section h3 i {
            color: var(--accent);
        }

        /* Users and Rooms Lists */
        .items-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .item-card {
            background: rgba(17, 21, 28, 0.5);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid var(--stroke);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s ease;
        }

        .item-card:hover {
            background: rgba(17, 21, 28, 0.7);
            border-color: var(--accent);
        }

        .item-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 16px;
        }

        .item-avatar.user {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .item-avatar.room {
            background: linear-gradient(135deg, var(--purple) 0%, #d19cff 100%);
        }

        .item-content {
            flex: 1;
        }

        .item-title {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 3px;
        }

        .item-subtitle {
            font-size: 12px;
            color: var(--muted);
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 14px;
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

            .stats-bar {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 28px;
            }

            .table-container {
                padding: 20px;
            }

            .table td {
                padding: 15px 12px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }

            .admin-info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .admin-avatar-large {
                width: 80px;
                height: 80px;
                font-size: 28px;
                justify-self: center;
            }

            .admin-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .stat-item {
                min-width: 100%;
            }

            .table th,
            .table td {
                padding: 12px 10px;
                font-size: 12px;
            }

            .admin-stats {
                grid-template-columns: 1fr;
            }

            .modal-content {
                max-width: 95%;
            }

            .modal-body {
                padding: 20px;
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
                transform: translateY(30px);
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
                    <i class="fas fa-user-shield"></i>
                    Manage Admins
                </h1>
            </div>
            <div class="header-actions">
                <a href="/dashboard_superadmin" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <?php
            $totalAdmins = count($admins);
            $trialAdmins = array_filter($admins, fn($a) => $a['plan_type'] === 'trial');
            $paidAdmins = array_filter($admins, fn($a) => $a['plan_type'] !== 'trial');
            ?>
            <div class="stat-item">
                <div class="stat-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Admin</div>
                    <div class="stat-value"><?= number_format($totalAdmins) ?></div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon trial">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Trial Accounts</div>
                    <div class="stat-value"><?= number_format(count($trialAdmins)) ?></div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon paid">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Paid Accounts</div>
                    <div class="stat-value"><?= number_format(count($paidAdmins)) ?></div>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" 
                       class="search-input" 
                       placeholder="Cari admin berdasarkan nama atau email..."
                       onkeyup="searchAdmins(this.value)">
            </div>
        </div>

        <!-- Admin Table -->
        <div class="table-container">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Daftar Admin</h2>
                <div class="table-actions">
                    <button class="action-btn" onclick="exportAdmins()">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table" id="adminTable">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $a): 
                            $joinDate = date('d M Y', strtotime($a['created_at'] ?? 'now'));
                            $initial = strtoupper(substr($a['name'], 0, 1));
                            $planBadge = $a['plan_type'] === 'trial' ? 'badge-trial' : 'badge-paid';
                            $planText = $a['plan_type'] === 'trial' ? 'Trial' : 'Paid';
                        ?>
                            <tr data-name="<?= htmlspecialchars(strtolower($a['name'])) ?>" 
                                data-email="<?= htmlspecialchars(strtolower($a['email'])) ?>"
                                data-plan="<?= $a['plan_type'] ?>">
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div class="admin-avatar">
                                            <?= $initial ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: var(--ink);">
                                                <?= htmlspecialchars($a['name']) ?>
                                            </div>
                                            <div style="font-size: 12px; color: var(--muted); margin-top: 2px;">
                                                ID: <?= (int)$a['id'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-envelope" style="color: var(--muted); font-size: 12px;"></i>
                                        <?= htmlspecialchars($a['email']) ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge <?= $planBadge ?>">
                                        <i class="fas <?= $a['plan_type'] === 'trial' ? 'fa-hourglass-half' : 'fa-crown' ?>"></i>
                                        <?= $planText ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-active">
                                        <i class="fas fa-check-circle"></i>
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 13px; color: var(--ink);">
                                        <?= $joinDate ?>
                                    </div>
                                    <div style="font-size: 11px; color: var(--muted);">
                                        <?= date('H:i', strtotime($a['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn view" onclick="openAdminDetail(<?= (int)$a['id'] ?>)">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </button>
                                        <button class="action-btn edit" onclick="editAdmin(<?= (int)$a['id'] ?>)">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan <span id="currentStart">1</span> - <span id="currentEnd">10</span> 
                    dari <span id="totalItems"><?= $totalAdmins ?></span> admin
                </div>
                <div class="pagination-controls">
                    <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                        <i class="fas fa-chevron-left"></i>
                        Sebelumnya
                    </button>
                    <div class="page-numbers" id="pageNumbers"></div>
                    <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                        Selanjutnya
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Detail Modal -->
    <div id="adminModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-user-shield"></i> Admin Details</h2>
                <button class="modal-close" onclick="closeAdminModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="admin-info-grid">
                    <div class="admin-avatar-large" id="adminAvatar">A</div>
                    <div class="admin-details">
                        <div class="admin-name" id="adminName">Admin Name</div>
                        <div class="admin-email">
                            <i class="fas fa-envelope"></i>
                            <span id="adminEmail">email@example.com</span>
                        </div>
                        <div class="admin-stats">
                            <div class="admin-stat-item">
                                <div class="admin-stat-value" id="userCount">0</div>
                                <div class="admin-stat-label">Users</div>
                            </div>
                            <div class="admin-stat-item">
                                <div class="admin-stat-value" id="roomCount">0</div>
                                <div class="admin-stat-label">Rooms</div>
                            </div>
                            <div class="admin-stat-item">
                                <div class="admin-stat-value" id="bookingCount">0</div>
                                <div class="admin-stat-label">Bookings</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <h3><i class="fas fa-users"></i> Users Managed</h3>
                    <div class="items-list" id="adminUsers">
                        <div class="empty-state">
                            <i class="fas fa-user-slash"></i>
                            <p>Belum ada user</p>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <h3><i class="fas fa-door-open"></i> Rooms Managed</h3>
                    <div class="items-list" id="adminRooms">
                        <div class="empty-state">
                            <i class="fas fa-door-closed"></i>
                            <p>Belum ada room</p>
                        </div>
                    </div>
                </div>

                <div class="modal-actions" style="margin-top: 30px;">
                    <button class="action-btn edit" onclick="editAdminFromModal()">
                        <i class="fas fa-edit"></i>
                        Edit Admin
                    </button>
                    <button class="action-btn delete" onclick="deleteAdmin()">
                        <i class="fas fa-trash"></i>
                        Delete Admin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State
        let currentPage = 1;
        const itemsPerPage = 10;
        let currentFilter = 'all';
        let currentSearch = '';

        document.addEventListener('DOMContentLoaded', function() {
            initializePagination();
        });

        // Search functionality
        function searchAdmins(query) {
            currentSearch = query.toLowerCase();
            currentPage = 1;
            
            const rows = document.querySelectorAll('#adminTable tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const email = row.getAttribute('data-email');
                const plan = row.getAttribute('data-plan');
                
                let show = true;
                
                if (currentSearch) {
                    show = name.includes(currentSearch) || email.includes(currentSearch);
                }
                
                if (currentFilter !== 'all') {
                    show = show && plan === currentFilter;
                }
                
                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            
            updatePaginationInfo(visibleCount);
            updatePagination();
        }

        // Pagination functions
        function initializePagination() {
            updatePagination();
        }

        function updatePagination() {
            const rows = document.querySelectorAll('#adminTable tbody tr');
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const totalItems = visibleRows.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            
            // Update info text
            const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('currentStart').textContent = start;
            document.getElementById('currentEnd').textContent = end;
            document.getElementById('totalItems').textContent = totalItems;
            
            // Show/hide rows for current page
            visibleRows.forEach((row, index) => {
                const rowPage = Math.floor(index / itemsPerPage) + 1;
                row.style.display = rowPage === currentPage ? '' : 'none';
            });
            
            // Update page numbers
            renderPageNumbers(totalPages);
            
            // Update prev/next buttons
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        }

        function renderPageNumbers(totalPages) {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            pageNumbersContainer.innerHTML = '';
            
            if (totalPages <= 1) return;
            
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            if (startPage > 1) {
                addPageNumber(1);
                if (startPage > 2) addPageDots();
            }
            
            for (let i = startPage; i <= endPage; i++) {
                addPageNumber(i);
            }
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) addPageDots();
                addPageNumber(totalPages);
            }
        }

        function addPageNumber(pageNum) {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const pageBtn = document.createElement('button');
            pageBtn.className = 'page-number' + (pageNum === currentPage ? ' active' : '');
            pageBtn.textContent = pageNum;
            pageBtn.onclick = () => goToPage(pageNum);
            pageNumbersContainer.appendChild(pageBtn);
        }

        function addPageDots() {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const dots = document.createElement('span');
            dots.className = 'page-number dots';
            dots.textContent = '...';
            pageNumbersContainer.appendChild(dots);
        }

        function goToPage(pageNum) {
            currentPage = pageNum;
            updatePagination();
        }

        function changePage(direction) {
            const rows = document.querySelectorAll('#adminTable tbody tr');
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
            
            currentPage += direction;
            currentPage = Math.max(1, Math.min(currentPage, totalPages));
            updatePagination();
        }

        function updatePaginationInfo(totalItems) {
            const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('currentStart').textContent = start;
            document.getElementById('currentEnd').textContent = end;
            document.getElementById('totalItems').textContent = totalItems;
        }

        // Modal functions
        function openAdminDetail(id) {
            fetch('/super/admin-detail?id=' + id)
                .then(r => r.json())
                .then(data => {
                    // Set admin info
                    const admin = data.admin;
                    document.getElementById('adminName').textContent = admin.name;
                    document.getElementById('adminEmail').textContent = admin.email;
                    document.getElementById('adminAvatar').textContent = admin.name.charAt(0).toUpperCase();
                    
                    // Set stats
                    document.getElementById('userCount').textContent = data.users.length;
                    document.getElementById('roomCount').textContent = data.rooms.length;
                    document.getElementById('bookingCount').textContent = data.bookings || 0;
                    
                    // Set users list
                    const usersList = document.getElementById('adminUsers');
                    usersList.innerHTML = '';
                    
                    if (data.users.length === 0) {
                        usersList.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>Belum ada user</p>
                            </div>
                        `;
                    } else {
                        data.users.forEach(user => {
                            const userCard = document.createElement('div');
                            userCard.className = 'item-card';
                            userCard.innerHTML = `
                                <div class="item-avatar user">${user.name.charAt(0).toUpperCase()}</div>
                                <div class="item-content">
                                    <div class="item-title">${user.name}</div>
                                    <div class="item-subtitle">${user.email}</div>
                                </div>
                            `;
                            usersList.appendChild(userCard);
                        });
                    }
                    
                    // Set rooms list
                    const roomsList = document.getElementById('adminRooms');
                    roomsList.innerHTML = '';
                    
                    if (data.rooms.length === 0) {
                        roomsList.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-door-closed"></i>
                                <p>Belum ada room</p>
                            </div>
                        `;
                    } else {
                        data.rooms.forEach(room => {
                            const roomCard = document.createElement('div');
                            roomCard.className = 'item-card';
                            roomCard.innerHTML = `
                                <div class="item-avatar room">${room.name.charAt(0).toUpperCase()}</div>
                                <div class="item-content">
                                    <div class="item-title">${room.name}</div>
                                    <div class="item-subtitle">Kapasitas: ${room.capacity} orang</div>
                                </div>
                            `;
                            roomsList.appendChild(roomCard);
                        });
                    }
                    
                    // Store current admin ID for edit/delete
                    window.currentAdminId = id;
                    
                    // Show modal
                    document.getElementById('adminModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data admin');
                });
        }

        function closeAdminModal() {
            document.getElementById('adminModal').classList.remove('active');
            window.currentAdminId = null;
        }

        function editAdminFromModal() {
            if (window.currentAdminId) {
                editAdmin(window.currentAdminId);
            }
        }

        function editAdmin(id) {
            alert('Edit admin dengan ID: ' + id);
            // Implement edit functionality here
        }

        function deleteAdmin() {
            if (!window.currentAdminId) return;
            
            if (confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                fetch('/super/delete-admin?id=' + window.currentAdminId, {
                    method: 'DELETE'
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        alert('Admin berhasil dihapus');
                        closeAdminModal();
                        location.reload();
                    } else {
                        alert('Gagal menghapus admin: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus admin');
                });
            }
        }

        function addNewAdmin() {
            alert('Fitur tambah admin baru akan segera hadir!');
            // Implement add admin functionality here
        }

        function exportAdmins() {
            alert('Fitur export akan segera hadir!');
            // Implement export functionality here
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('adminModal');
            if (event.target === modal) {
                closeAdminModal();
            }
        };

        // Filter by plan type
        function filterByPlan(planType) {
            currentFilter = planType;
            currentPage = 1;
            searchAdmins(currentSearch);
        }
    </script>
</body>
</html>