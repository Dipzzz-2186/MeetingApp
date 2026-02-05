<?php /** @var array $users */ ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Manage Users</title>
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
            --pink: #ff57b3;
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

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .secondary-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        /* Stats Bar */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(5, 6, 9, 0.7);
            border-color: rgba(247, 200, 66, 0.3);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--ink);
        }

        .stat-icon.total {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, var(--success) 0%, #8dffa4 100%);
        }

        .stat-icon.booking {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--muted);
        }

        /* Filters Bar */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 300px;
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

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover, .filter-btn.active {
            background: rgba(247, 200, 66, 0.1);
            border-color: var(--accent);
            color: var(--accent);
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
            min-width: 900px;
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

        /* User Avatar */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 16px;
            text-transform: uppercase;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            background: rgba(247, 200, 66, 0.1);
            color: var(--accent);
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(247, 200, 66, 0.3);
        }

        .admin-badge i {
            font-size: 10px;
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

        .action-btn.delete:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-active {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .status-inactive {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        .status-suspended {
            background: rgba(255, 87, 87, 0.1);
            color: var(--error);
            border: 1px solid rgba(255, 87, 87, 0.3);
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

        /* Modal Styles - IMPROVED */
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
            max-width: 700px;
            max-height: 85vh;
            overflow-y: auto;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            animation: slideUp 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--stroke);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            background: var(--card);
            border-radius: 20px 20px 0 0;
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
            padding: 25px 30px;
            flex: 1;
            overflow-y: auto;
        }

        /* Compact User Info */
        .user-info-compact {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--stroke);
        }

        .user-avatar-medium {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 28px;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .user-info-main {
            flex: 1;
        }

        .user-name {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 5px;
        }

        .user-email {
            font-size: 15px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .user-meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .meta-item-compact {
            padding: 8px 12px;
            background: rgba(17, 21, 28, 0.5);
            border-radius: 8px;
            border: 1px solid var(--stroke);
        }

        .meta-label-compact {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 3px;
            display: block;
        }

        .meta-value-compact {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            display: block;
        }

        /* Stats Grid - Compact */
        .stats-grid-compact {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }

        .stat-item-compact {
            background: rgba(17, 21, 28, 0.5);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid var(--stroke);
            text-align: center;
        }

        .stat-value-compact {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 3px;
            display: block;
        }

        .stat-label-compact {
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: block;
        }

    /* Admin Info Compact - Updated Style */
    .admin-info-compact {
        background: rgba(17, 21, 28, 0.5);
        border-radius: 12px;
        padding: 15px;
        border: 1px solid var(--stroke);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-avatar-small {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 18px;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .admin-info-content {
        flex: 1;
    }

    .admin-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 3px;
    }

    .admin-role {
        font-size: 12px;
        color: var(--accent);
        font-weight: 500;
        background: rgba(247, 200, 66, 0.1);
        padding: 3px 8px;
        border-radius: 4px;
        display: inline-block;
    }

        /* Booking History - Compact */
        .booking-section {
            margin-bottom: 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title {
            font-family: "Fraunces", serif;
            font-size: 18px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--accent);
        }

        .booking-count {
            background: rgba(247, 200, 66, 0.1);
            color: var(--accent);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .booking-list-compact {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .booking-item-compact {
            background: rgba(17, 21, 28, 0.5);
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid var(--stroke);
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        .booking-item-compact:hover {
            background: rgba(17, 21, 28, 0.7);
            border-color: var(--accent);
        }

        .booking-room-compact {
            font-weight: 600;
            color: var(--ink);
            font-size: 14px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .booking-room-compact i {
            color: var(--purple);
            font-size: 12px;
        }

        .booking-details-compact {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--muted);
        }

        .booking-time-compact {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .booking-duration-compact {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }

        .empty-state-compact {
            text-align: center;
            padding: 30px 20px;
            color: var(--muted);
        }

        .empty-state-compact i {
            font-size: 32px;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        .empty-state-compact p {
            font-size: 13px;
            margin: 0;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid var(--stroke);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
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
                grid-template-columns: repeat(2, 1fr);
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

            .user-info-compact {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .user-meta-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid-compact {
                grid-template-columns: 1fr;
            }

            .stats-bar {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                max-width: 95%;
                max-height: 90vh;
            }
            
            .modal-body {
                padding: 20px;
            }
            
            .modal-header {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .table th,
            .table td {
                padding: 12px 10px;
                font-size: 12px;
            }

            .modal-content {
                max-width: 98%;
            }

            .modal-body {
                padding: 15px;
            }

            .filters-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: 100%;
            }
            
            .user-name {
                font-size: 20px;
            }
            
            .stats-grid-compact {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .modal-footer {
                padding: 15px;
                flex-direction: column;
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
                    <i class="fas fa-users"></i>
                    Manage Users
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
            $totalUsers = count($users);
            $activeUsers = $totalUsers; // Assuming all are active
            $usersWithBookings = 0; // This would come from database
            ?>
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= number_format($totalUsers) ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon active">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= number_format($activeUsers) ?></div>
                    <div class="stat-label">Active Users</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon booking">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= number_format($usersWithBookings) ?></div>
                    <div class="stat-label">With Bookings</div>
                </div>
            </div>
        </div>

        <!-- Filters Bar -->
        <div class="filters-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" 
                       class="search-input" 
                       placeholder="Cari user berdasarkan nama, email, atau admin..."
                       onkeyup="searchUsers(this.value)">
            </div>

            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterUsers('all')">
                    <i class="fas fa-layer-group"></i>
                    Semua
                </button>
                <button class="filter-btn" onclick="filterUsers('active')">
                    <i class="fas fa-check-circle"></i>
                    Aktif
                </button>
                <button class="filter-btn" onclick="filterUsers('with_bookings')">
                    <i class="fas fa-calendar-check"></i>
                    Ada Booking
                </button>
            </div>
        </div>

        <!-- User Table -->
        <div class="table-container">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Daftar User</h2>
                <div class="table-actions">
                    <button class="action-btn" onclick="refreshUsers()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table" id="userTable">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Admin Pemilik</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): 
                            $joinDate = date('d M Y', strtotime($u['created_at'] ?? 'now'));
                            $initial = strtoupper(substr($u['name'], 0, 1));
                            $adminName = $u['admin_name'] ?? '-';
                        ?>
                            <tr data-name="<?= htmlspecialchars(strtolower($u['name'])) ?>" 
                                data-email="<?= htmlspecialchars(strtolower($u['email'])) ?>"
                                data-admin="<?= htmlspecialchars(strtolower($adminName)) ?>"
                                data-status="active">
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div class="user-avatar">
                                            <?= $initial ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: var(--ink);">
                                                <?= htmlspecialchars($u['name']) ?>
                                            </div>
                                            <div style="font-size: 12px; color: var(--muted); margin-top: 2px;">
                                                ID: <?= (int)$u['id'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-envelope" style="color: var(--muted); font-size: 12px;"></i>
                                        <?= htmlspecialchars($u['email']) ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($adminName !== '-'): ?>
                                        <span class="admin-badge">
                                            <i class="fas fa-user-shield"></i>
                                            <?= htmlspecialchars($adminName) ?>
                                        </span>
                                    <?php else: ?>
                                        <span style="color: var(--muted); font-style: italic;">
                                            Tidak ada
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-badge status-active">
                                        <i class="fas fa-check-circle"></i>
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 13px; color: var(--ink);">
                                        <?= $joinDate ?>
                                    </div>
                                    <div style="font-size: 11px; color: var(--muted);">
                                        <?= date('H:i', strtotime($u['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn view" onclick="openUserDetail(<?= (int)$u['id'] ?>)">
                                            <i class="fas fa-eye"></i>
                                            Detail
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
                    dari <span id="totalItems"><?= $totalUsers ?></span> user
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

    <!-- User Detail Modal - COMPACT VERSION -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-user"></i> Detail User</h2>
                <button class="modal-close" onclick="closeUserModal()">&times;</button>
            </div>
            
            <div class="modal-body">
                <!-- User Info Compact -->
                <div class="user-info-compact">
                    <div class="user-avatar-medium" id="userAvatar">U</div>
                    <div class="user-info-main">
                        <div class="user-name" id="userName">User Name</div>
                        <div class="user-email">
                            <i class="fas fa-envelope"></i>
                            <span id="userEmail">email@example.com</span>
                        </div>
                        <div class="user-meta-grid">
                            <div class="meta-item-compact">
                                <span class="meta-label-compact">ID User</span>
                                <span class="meta-value-compact" id="userId">-</span>
                            </div>
                            <div class="meta-item-compact">
                                <span class="meta-label-compact">Status</span>
                                <span class="meta-value-compact" id="userStatus">-</span>
                            </div>
                            <!-- Admin dipindahkan ke sini di dalam grid -->
                            <div class="admin-info-compact" style="margin: 0; padding: 8px 12px; width: 100%;">
                                <div class="admin-avatar-small" id="adminAvatar">A</div>
                                <div class="admin-info-content">
                                    <div class="admin-name" id="adminName">-</div>
                                    <div class="admin-role" id="adminRole">Admin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking History Compact -->
                <div class="booking-section">
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-history"></i>
                            Riwayat Booking
                        </div>
                        <div class="booking-count" id="bookingCount">0 bookings</div>
                    </div>
                    
                    <div class="booking-list-compact" id="userRooms">
                        <div class="empty-state-compact">
                            <i class="fas fa-calendar-times"></i>
                            <p>Belum ada booking</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button class="action-btn" onclick="closeUserModal()">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        // State
        let currentPage = 1;
        const itemsPerPage = 10;
        let currentFilter = 'all';
        let currentSearch = '';
        let currentUserId = null;

        document.addEventListener('DOMContentLoaded', function() {
            initializePagination();
        });

        // Search functionality
        function searchUsers(query) {
            currentSearch = query.toLowerCase();
            currentPage = 1;
            
            const rows = document.querySelectorAll('#userTable tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const email = row.getAttribute('data-email');
                const admin = row.getAttribute('data-admin');
                const status = row.getAttribute('data-status');
                
                let show = true;
                
                if (currentSearch) {
                    show = name.includes(currentSearch) || email.includes(currentSearch) || admin.includes(currentSearch);
                }
                
                if (currentFilter !== 'all') {
                    if (currentFilter === 'active') {
                        show = show && status === 'active';
                    } else if (currentFilter === 'with_bookings') {
                        // This would need additional data attribute
                        show = show && row.hasAttribute('data-has-bookings');
                    }
                }
                
                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            
            updatePaginationInfo(visibleCount);
            updatePagination();
        }

        // Filter functionality
        function filterUsers(filter) {
            currentFilter = filter;
            currentPage = 1;
            
            // Update active filter button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            searchUsers(currentSearch);
        }

        // Pagination functions
        function initializePagination() {
            updatePagination();
        }

        function updatePagination() {
            const rows = document.querySelectorAll('#userTable tbody tr');
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
            const rows = document.querySelectorAll('#userTable tbody tr');
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
        async function openUserDetail(id) {
            try {
                currentUserId = id;
                
                const response = await fetch('/super/user-detail?id=' + id);
                const data = await response.json();
                
                // Set user info
                const user = data.user;
                document.getElementById('userName').textContent = user.name;
                document.getElementById('userEmail').textContent = user.email;
                document.getElementById('userAvatar').textContent = user.name.charAt(0).toUpperCase();
                document.getElementById('userId').textContent = user.id;
                document.getElementById('userStatus').textContent = 'Active';
                
                // Set admin info - sesuai dengan gambar
                if (data.admin_name) {
                    document.getElementById('adminName').textContent = data.admin_name;
                    document.getElementById('adminRole').textContent = 'Admin';
                    document.getElementById('adminAvatar').textContent = data.admin_name.charAt(0).toUpperCase();
                } else {
                    document.getElementById('adminName').textContent = 'Tidak ada admin';
                    document.getElementById('adminRole').textContent = '-';
                }
                
                // Set booking stats and count
                const totalBookings = data.total_bookings || 0;
                document.getElementById('bookingCount').textContent = totalBookings + ' booking' + (totalBookings !== 1 ? 's' : '');
                
                // Set booking history
                const roomsList = document.getElementById('userRooms');
                roomsList.innerHTML = '';
                
                if (data.rooms && data.rooms.length > 0) {
                    data.rooms.slice(0, 5).forEach(room => { // Show only last 5 bookings
                        const bookingItem = document.createElement('div');
                        bookingItem.className = 'booking-item-compact';
                        
                        // Format dates
                        const startDate = new Date(room.start_time);
                        const endDate = new Date(room.end_time);
                        const durationMs = endDate - startDate;
                        const hours = Math.floor(durationMs / (1000 * 60 * 60));
                        const minutes = Math.floor((durationMs % (1000 * 60 * 60)) / (1000 * 60));
                        
                        bookingItem.innerHTML = `
                            <div class="booking-room-compact">
                                <i class="fas fa-door-open"></i>
                                ${room.room_name}
                            </div>
                            <div class="booking-details-compact">
                                <div class="booking-time-compact">
                                    <i class="fas fa-clock"></i>
                                    ${startDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })} 
                                    ${startDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute:'2-digit' })}
                                </div>
                                <div class="booking-duration-compact">
                                    ${hours > 0 ? hours + 'h ' : ''}${minutes}m
                                </div>
                            </div>
                        `;
                        roomsList.appendChild(bookingItem);
                    });
                    
                    // Show "view more" if there are more bookings
                    if (data.rooms.length > 5) {
                        const viewMore = document.createElement('div');
                        viewMore.className = 'booking-item-compact';
                        viewMore.style.textAlign = 'center';
                        viewMore.style.cursor = 'pointer';
                        viewMore.innerHTML = `
                            <div style="color: var(--accent); font-size: 12px; font-weight: 600;">
                                <i class="fas fa-ellipsis-h"></i>
                                Tampilkan ${data.rooms.length - 5} booking lainnya
                            </div>
                        `;
                        viewMore.onclick = function() {
                            alert('Menampilkan semua ' + data.rooms.length + ' booking');
                        };
                        roomsList.appendChild(viewMore);
                    }
                } else {
                    roomsList.innerHTML = `
                        <div class="empty-state-compact">
                            <i class="fas fa-calendar-times"></i>
                            <p>Belum ada booking</p>
                        </div>
                    `;
                }
                
                // Show modal
                document.getElementById('userModal').classList.add('active');
                
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengambil data user');
            }
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.remove('active');
            currentUserId = null;
        }

        function deleteUser() {
            if (!currentUserId) return;
            
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                fetch('/super/delete-user?id=' + currentUserId, {
                    method: 'DELETE'
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        alert('User berhasil dihapus');
                        closeUserModal();
                        location.reload();
                    } else {
                        alert('Gagal menghapus user: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus user');
                });
            }
        }

        function addNewUser() {
            alert('Fitur tambah user baru akan segera hadir!');
            // Implement add user functionality here
        }

        function exportUsers() {
            alert('Fitur export akan segera hadir!');
            // Implement export functionality here
        }

        function refreshUsers() {
            location.reload();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('userModal');
            if (event.target === modal) {
                closeUserModal();
            }
        };
    </script>
</body>
</html>