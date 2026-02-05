<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Scheduling</title>
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

        .monitor-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(242, 243, 245, 0.2);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: #1a1a1a;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .monitor-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        .fullscreen-mode .header {
            display: none;
        }

        .monitor-exit-btn {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 1200;
            display: none;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(247, 200, 66, 0.5);
            background: rgba(11, 13, 18, 0.85);
            color: var(--accent);
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .fullscreen-mode .monitor-exit-btn {
            display: inline-flex;
        }

        .fullscreen-mode .topbar,
        .fullscreen-mode .tabbar,
        .fullscreen-mode .mobile-brand {
            display: none !important;
        }

        .fullscreen-mode main.container {
            padding-top: 0;
        }

        .fullscreen-mode .action-btn.edit,
        .fullscreen-mode .action-btn.delete {
            display: none;
        }

        .monitor-error {
            color: var(--error);
            font-size: 12px;
            margin-top: 6px;
        }

        .monitor-confirm {
            background: rgba(247, 200, 66, 0.12);
            border-color: rgba(247, 200, 66, 0.5);
            color: var(--accent);
        }

        .monitor-confirm:hover {
            background: rgba(247, 200, 66, 0.2);
        }

        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-bottom: 30px;
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

        input, select, textarea {
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

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        input::placeholder, textarea::placeholder {
            color: rgba(154, 160, 170, 0.6);
        }

        form.grid > .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            form.grid > .form-row {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
                gap: 12px;
            }

            label {
                font-size: 12px;
            }

            input, select, textarea {
                padding: 12px 12px;
                font-size: 14px;
            }

            .time-helper {
                font-size: 11px;
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

        /* Tabel Styling */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.8);
        }

        .table th {
            padding: 18px 15px;
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
            padding: 20px 15px;
            color: var(--ink);
            font-size: 14px;
            vertical-align: middle;
        }

        /* User Avatar */
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
        }

        .room-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(179, 102, 255, 0.1);
            color: var(--purple);
            font-size: 11px;
            font-weight: 600;
            border: 1px solid rgba(179, 102, 255, 0.3);
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 8px;
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

        /* Filter Controls */
        .filter-controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn.active {
            background: rgba(247, 200, 66, 0.1);
            border-color: var(--accent);
            color: var(--accent);
        }

        .filter-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        /* Booking Status */
        .booking-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-upcoming {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .status-ongoing {
            background: rgba(87, 184, 255, 0.1);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        .status-completed {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        /* Duration Indicator */
        .duration-indicator {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            font-size: 11px;
            font-weight: 600;
        }

        /* Time Input Helper */
        .time-helper {
            font-size: 12px;
            color: var(--muted);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
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
            max-width: 400px;
            margin: 0 auto;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            padding: 15px;
            border-radius: 12px;
            border: 1px solid;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
                gap: 12px;
            }

            .stat-card {
                padding: 12px;
                border-radius: 10px;
            }

            .stat-label {
                font-size: 11px;
            }

            .stat-value {
                font-size: 20px;
            }
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
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

        .pagination-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
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

        .page-number.dots {
            border: none;
            background: transparent;
            cursor: default;
            pointer-events: none;
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

        @media (max-width: 768px) {
            .modal-content {
                max-width: 95%;
            }
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

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-item.full-width {
            grid-column: 1 / -1;
        }

        .detail-item label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value {
            font-size: 14px;
            color: var(--ink);
            padding: 12px;
            background: rgba(17, 21, 28, 0.5);
            border-radius: 10px;
            border: 1px solid var(--stroke);
            min-height: 44px;
            display: flex;
            align-items: center;
        }

        /* Modal Actions */
        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .modal-actions {
                flex-direction: column;
            }
        }

        .btn-primary {
            background: var(--accent);
            color: #1a1a1a;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-primary:hover {
            background: var(--accent-2);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid var(--stroke);
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-secondary:hover {
            background: rgba(154, 160, 170, 0.2);
            color: var(--ink);
        }

        .btn-danger {
            background: rgba(255, 87, 87, 0.1);
            color: var(--error);
            border: 1px solid rgba(255, 87, 87, 0.3);
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-danger:hover {
            background: var(--error);
            color: var(--ink);
        }

        /* Warning Message */
        .warning-message {
            text-align: center;
            padding: 20px 0;
        }

        .warning-message i {
            font-size: 48px;
            color: var(--warning);
            margin-bottom: 15px;
        }

        .warning-message h3 {
            font-size: 18px;
            color: var(--ink);
            margin-bottom: 10px;
        }

        .warning-message p {
            color: var(--muted);
            margin-bottom: 8px;
        }

        .warning-text {
            color: var(--error) !important;
            font-weight: 600;
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

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .container {
                padding: 0;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .back-btn {
                width: 100%;
                justify-content: center;
            }

            .monitor-btn {
                width: 100%;
                justify-content: center;
            }
            
            .card {
                padding: 20px;
            }
            
            .actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
            
            .filter-controls {
                justify-content: center;
            }

            .table th {
                padding: 12px 10px;
                font-size: 11px;
                letter-spacing: 0.3px;
            }

            .table td {
                padding: 12px 10px;
                font-size: 12px;
            }

            .user-avatar {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .booking-status,
            .room-badge,
            .duration-indicator {
                font-size: 10px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .table tr {
                border: 1px solid rgba(42, 49, 61, 0.6);
                border-radius: 12px;
                padding: 12px;
                margin: 0 0 12px;
                background: rgba(17, 21, 28, 0.55);
            }

            .table td {
                padding: 10px 0;
                border: none;
                display: flex;
                justify-content: space-between;
                gap: 12px;
                align-items: center;
            }

            .table td::before {
                content: attr(data-label);
                font-size: 11px;
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: 0.4px;
                flex: 0 0 38%;
            }

            .table td > div,
            .table td > span {
                flex: 1;
            }

            .actions {
                flex-direction: row;
                justify-content: flex-end;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .pagination-info {
                text-align: center;
            }

            .pagination-controls {
                flex-direction: column;
                width: 100%;
            }

            .page-numbers {
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

            .filter-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-btn {
                width: 100%;
                justify-content: center;
            }

            .table-container {
                margin-left: -10px;
                margin-right: -10px;
                border-radius: 0;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
                gap: 12px;
            }
        }
        
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.9;
            cursor: pointer;
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-alt"></i> Scheduling & Booking</h1>
            <div class="header-actions">
                <a href="/dashboard_admin" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <button type="button" class="monitor-exit-btn" id="monitorExitBtn">
            <i class="fas fa-unlock"></i> Keluar Monitor
        </button>

        <!-- Modal: Exit Monitor -->
        <div class="modal" id="monitorExitModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-lock"></i> Keluar Mode Monitor</h2>
                    <button class="modal-close" type="button" id="monitorExitClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color: var(--muted); margin-bottom: 16px;">
                        Masukkan password akun admin untuk keluar dari mode monitor.
                    </p>
                    <div class="detail-item">
                        <label><i class="fas fa-key"></i> Password</label>
                        <input type="password" id="monitor_password" placeholder="Password admin" autocomplete="current-password">
                        <div class="monitor-error" id="monitor_password_error" style="display:none;"></div>
                    </div>
                    <div class="modal-actions" style="margin-top: 20px;">
                        <button class="action-btn" type="button" id="monitorExitCancel">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button class="action-btn monitor-confirm" type="button" id="monitorExitConfirm">
                            <i class="fas fa-unlock"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid-two">
            <!-- Form Buat Booking -->
            <div class="card">
                <h1><i class="fas fa-plus-circle"></i> Buat Booking Baru</h1>
                
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
                            <label><i class="fas fa-door-open"></i> Room</label>
                            <select name="room_id" required>
                                <option value="">Pilih room</option>
                                <?php foreach ($rooms as $row): ?>
                                    <option value="<?php echo (int)$row['id']; ?>" data-capacity="<?php echo $row['capacity']; ?>">
                                        <?php echo htmlspecialchars($row['name']); ?> (<?php echo $row['capacity']; ?> orang)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-calendar-day"></i> Mulai</label>
                            <input type="datetime-local" name="start_time" id="start_time" required 
                                  min="<?php echo date('Y-m-d\TH:i'); ?>"
                                  placeholder="Pilih waktu mulai">
                            <div class="time-helper">
                                <i class="fas fa-clock"></i>
                                <span id="start_time_display">Belum dipilih</span>
                            </div>
                        </div>
                        <div>
                            <label><i class="fas fa-calendar-check"></i> Selesai</label>
                            <input type="datetime-local" name="end_time" id="end_time" required
                                  min="<?php echo date('Y-m-d\TH:i'); ?>"
                                  placeholder="Pilih waktu selesai">
                            <div class="time-helper">
                                <i class="fas fa-clock"></i>
                                <span id="end_time_display">Belum dipilih</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-bullseye"></i> Tujuan Meeting</label>
                        <input type="text" name="purpose" placeholder="Contoh: Rapat Tim Marketing, Presentasi Klien, dll.">
                    </div>

                    <button type="submit">
                        <i class="fas fa-calendar-plus"></i>
                        Buat Booking
                    </button>
                </form>
            </div>
            
            <!-- Daftar Booking -->
            <div class="card">
                <h2><i class="fas fa-list"></i> Daftar Booking</h2>
                
                <!-- Filter Controls -->
                <div class="filter-controls">
                    <button class="filter-btn active" onclick="filterBookings('all')">
                        <i class="fas fa-layer-group"></i>
                        Semua
                    </button>
                    <button class="filter-btn" onclick="filterBookings('upcoming')">
                        <i class="fas fa-clock"></i>
                        Akan Datang
                    </button>
                    <button class="filter-btn" onclick="filterBookings('ongoing')">
                        <i class="fas fa-play-circle"></i>
                        Berlangsung
                    </button>
                    <button class="filter-btn" onclick="filterBookings('completed')">
                        <i class="fas fa-check-circle"></i>
                        Selesai
                    </button>
                    <button class="filter-btn" onclick="filterBookings('today')">
                        <i class="fas fa-calendar-day"></i>
                        Hari Ini
                    </button>
                </div>
                
                <?php if (!$bookings): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h3>Belum ada booking</h3>
                        <p>Buat booking pertama Anda menggunakan form di samping</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User & Room</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bookingTableBody">
                                <?php foreach ($bookings as $row): 
                                    // Hitung durasi dan status dengan error handling
                                    try {
                                        $start = new DateTime($row['start_time']);
                                        $end = new DateTime($row['end_time']);
                                    } catch (Exception $e) {
                                        // Jika format datetime tidak valid, gunakan waktu sekarang sebagai fallback
                                        $start = new DateTime();
                                        $end = new DateTime('+1 hour');
                                    }
                                    
                                    $duration = $start->diff($end);
                                    $hours = $duration->h + ($duration->days * 24);
                                    $minutes = $duration->i;
                                    
                                    // Tentukan status dengan lebih akurat
                                    $now = new DateTime();
                                    $status = isset($row['status_override']) ? $row['status_override'] : 'upcoming'; // default
                                    
                                    if ($now >= $start && $now <= $end) {
                                        $status = 'ongoing';
                                    } elseif ($now > $end) {
                                        $status = 'completed';
                                    }
                                    
                                    // Format waktu untuk display
                                    $startDate = $start->format('d/m/Y');
                                    $startTime = $start->format('H:i');
                                    $endTime = $end->format('H:i');
                                    
                                    // Warna berdasarkan status
                                    $statusClass = 'status-' . $status;
                                    $statusText = $status == 'upcoming' ? 'Akan Datang' : 
                                                ($status == 'ongoing' ? 'Berlangsung' : 'Selesai');
                                ?>
                                    <tr data-status="<?php echo $status; ?>" 
                                        data-date="<?php echo $start->format('Y-m-d'); ?>"
                                        class="booking-row">
                                        <td data-label="User & Room">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--ink);">
                                                        <?php echo htmlspecialchars($user['name']); ?>
                                                    </div>
                                                    <div style="font-size: 12px; color: var(--muted); margin-top: 2px;">
                                                        <span class="room-badge">
                                                            <i class="fas fa-door-open"></i>
                                                            <?php echo htmlspecialchars($row['room_name']); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Waktu">
                                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                                <div style="font-size: 13px; color: var(--muted);">
                                                    <?php echo $startDate; ?>
                                                </div>
                                                <div style="font-weight: 600; color: var(--ink);">
                                                    <?php echo $startTime; ?> - <?php echo $endTime; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Durasi">
                                            <span class="duration-indicator">
                                                <?php 
                                                if ($hours > 0) echo $hours . ' jam ';
                                                if ($minutes > 0) echo $minutes . ' menit';
                                                if ($hours == 0 && $minutes == 0) echo '< 1 menit';
                                                ?>
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="booking-status <?php echo $statusClass; ?>">
                                                <i class="fas <?php 
                                                    echo $status == 'upcoming' ? 'fa-clock' : 
                                                        ($status == 'ongoing' ? 'fa-play-circle' : 'fa-check-circle'); 
                                                ?>"></i>
                                                <?php echo $statusText; ?>
                                            </span>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="actions">
                                                <button class="action-btn view" onclick="viewBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" onclick="editBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" onclick="deleteBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan <span id="currentStart">1</span> - <span id="currentEnd">5</span> 
                            dari <span id="totalItems">0</span> booking
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
                    
                    <!-- Stats Summary -->
                    <div class="stats-grid">
                        <div class="stat-card" style="background: rgba(87, 255, 117, 0.1); border-color: rgba(87, 255, 117, 0.3);">
                            <div class="stat-label" style="color: var(--success);">AKAN DATANG</div>
                            <div class="stat-value" id="stat-upcoming">
                                <?php 
                                $upcomingCount = 0;
                                foreach ($bookings as $row) {
                                    $start = new DateTime($row['start_time']);
                                    $now = new DateTime();
                                    if ($now < $start) $upcomingCount++;
                                }
                                echo $upcomingCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(87, 184, 255, 0.1); border-color: rgba(87, 184, 255, 0.3);">
                            <div class="stat-label" style="color: var(--info);">BERLANGSUNG</div>
                            <div class="stat-value" id="stat-ongoing">
                                <?php 
                                $ongoingCount = 0;
                                foreach ($bookings as $row) {
                                    $start = new DateTime($row['start_time']);
                                    $end = new DateTime($row['end_time']);
                                    $now = new DateTime();
                                    if ($now >= $start && $now <= $end) $ongoingCount++;
                                }
                                echo $ongoingCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(154, 160, 170, 0.1); border-color: rgba(154, 160, 170, 0.3);">
                            <div class="stat-label" style="color: var(--muted);">SELESAI</div>
                            <div class="stat-value" id="stat-completed">
                                <?php 
                                $completedCount = 0;
                                foreach ($bookings as $row) {
                                    $end = new DateTime($row['end_time']);
                                    $now = new DateTime();
                                    if ($now > $end) $completedCount++;
                                }
                                echo $completedCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(247, 200, 66, 0.1); border-color: rgba(247, 200, 66, 0.3);">
                            <div class="stat-label" style="color: var(--accent);">TOTAL</div>
                            <div class="stat-value" id="stat-total">
                                <?php echo count($bookings); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Booking -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-info-circle"></i> Detail Booking</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <label><i class="fas fa-user"></i> User</label>
                        <div id="detail-user" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-door-open"></i> Room</label>
                        <div id="detail-room" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-calendar-day"></i> Tanggal</label>
                        <div id="detail-date" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-clock"></i> Waktu</label>
                        <div id="detail-time" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-hourglass-half"></i> Durasi</label>
                        <div id="detail-duration" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-bullseye"></i> Tujuan</label>
                        <div id="detail-purpose" class="detail-value">-</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-calendar-plus"></i> Dibuat</label>
                        <div id="detail-created" class="detail-value">-</div>
                    </div>
                    <div class="detail-item full-width">
                        <label><i class="fas fa-tag"></i> Status</label>
                        <div id="detail-status" class="detail-value">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Booking -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-edit"></i> Edit Booking</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" method="post" class="grid">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="ajax" value="true">
                    <input type="hidden" name="booking_id" id="edit_booking_id">
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-door-open"></i> Room</label>
                            <select name="edit_room_id" id="edit_room_id" required>
                                <option value="">Pilih room</option>
                                <?php foreach ($rooms as $row): ?>
                                    <option value="<?php echo (int)$row['id']; ?>" data-capacity="<?php echo $row['capacity']; ?>">
                                        <?php echo htmlspecialchars($row['name']); ?> (<?php echo $row['capacity']; ?> orang)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-calendar-day"></i> Mulai</label>
                            <input type="datetime-local" name="edit_start_time" id="edit_start_time" required>
                        </div>
                        <div>
                            <label><i class="fas fa-calendar-check"></i> Selesai</label>
                            <input type="datetime-local" name="edit_end_time" id="edit_end_time" required>
                        </div>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-bullseye"></i> Tujuan Meeting</label>
                        <input type="text" name="edit_purpose" id="edit_purpose" placeholder="Tujuan meeting">
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" class="btn-secondary modal-close">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-exclamation-triangle"></i> Hapus Booking</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="warning-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <h3>Apakah Anda yakin?</h3>
                    <p>Booking dengan ID <span id="delete-booking-id"></span> akan dihapus secara permanen.</p>
                    <p class="warning-text">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                
                <form id="deleteBookingForm" method="post" class="grid">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="ajax" value="true">
                    <input type="hidden" name="booking_id" id="delete_booking_id">
                    
                    <div class="modal-actions">
                        <button type="submit" class="btn-danger">
                            <i class="fas fa-trash"></i>
                            Ya, Hapus
                        </button>
                        <button type="button" class="btn-secondary modal-close">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script>
    // Modal Functions
    const detailModal = document.getElementById('detailModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    
    // State
    let isLoading = false;

    // Show modal functions
    window.viewBooking = function(bookingId) {
        if (isLoading) return;
        
        // Show loading state
        const detailValues = document.querySelectorAll('.detail-value');
        detailValues.forEach(el => {
            el.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
        });
        
        openModal('detail');
        
        // Fetch booking details
        fetch(`?ajax=get_booking&booking_id=${bookingId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    showAlert(data.error, 'error');
                    closeAllModals();
                    return;
                }
                
                // Format data untuk display
                const start = new Date(data.start_time);
                const end = new Date(data.end_time);
                const created = new Date(data.created_at);
                
                // Hitung durasi
                const durationMs = end - start;
                const hours = Math.floor(durationMs / (1000 * 60 * 60));
                const minutes = Math.floor((durationMs % (1000 * 60 * 60)) / (1000 * 60));
                
                // Tentukan status
                const now = new Date();
                let status = 'Akan Datang';
                let statusClass = 'status-upcoming';
                
                if (now > end) {
                    status = 'Selesai';
                    statusClass = 'status-completed';
                } else if (now >= start && now <= end) {
                    status = 'Berlangsung';
                    statusClass = 'status-ongoing';
                }
                
                // Isi detail
                document.getElementById('detail-user').innerHTML = `
                    <div>
                        <strong>${data.user_name}</strong><br>
                        <small style="color: var(--muted);">${data.user_email}</small>
                    </div>
                `;
                document.getElementById('detail-room').innerHTML = `
                    <div>
                        <strong>${data.room_name}</strong><br>
                        <small style="color: var(--muted);">Kapasitas: ${data.room_capacity} orang</small>
                    </div>
                `;
                document.getElementById('detail-date').textContent = start.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                document.getElementById('detail-time').textContent = 
                    `${start.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} - ${end.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})}`;
                document.getElementById('detail-duration').textContent = 
                    `${hours > 0 ? hours + ' jam ' : ''}${minutes} menit`;
                document.getElementById('detail-purpose').textContent = data.purpose || 'Tidak ada keterangan';
                document.getElementById('detail-created').textContent = created.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('detail-status').innerHTML = `
                    <span class="booking-status ${statusClass}">
                        <i class="fas ${now > end ? 'fa-check-circle' : (now >= start && now <= end ? 'fa-play-circle' : 'fa-clock')}"></i>
                        ${status}
                    </span>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Gagal mengambil data booking', 'error');
                closeAllModals();
            })
            .finally(() => {
                isLoading = false;
            });
    };

    window.editBooking = function(bookingId) {
        if (isLoading) return;
        isLoading = true;
        
        // Show modal first
        openModal('edit');
        
        // Show loading state in form
        const editForm = document.getElementById('editBookingForm');
        const inputs = editForm.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (input.type !== 'hidden') {
                input.value = 'Memuat...';
                input.disabled = true;
            }
        });
        
        const submitBtn = editForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat data...';
        submitBtn.disabled = true;
        
        // Fetch booking details untuk form edit
        fetch(`?ajax=get_booking&booking_id=${bookingId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    showAlert(data.error, 'error');
                    closeAllModals();
                    return;
                }
                
                // Isi form edit
                document.getElementById('edit_booking_id').value = bookingId;
                document.getElementById('edit_room_id').value = data.room_id;
                document.getElementById('edit_start_time').value = data.start_time_formatted;
                document.getElementById('edit_end_time').value = data.end_time_formatted;
                document.getElementById('edit_purpose').value = data.purpose || '';
                
                // Enable inputs
                inputs.forEach(input => {
                    input.disabled = false;
                });
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Set minimum time untuk end time
                const startInput = document.getElementById('edit_start_time');
                const endInput = document.getElementById('edit_end_time');
                
                startInput.addEventListener('change', function() {
                    if (this.value) {
                        const start = new Date(this.value);
                        const minEnd = new Date(start.getTime() + 30 * 60 * 1000);
                        endInput.min = minEnd.toISOString().slice(0, 16);
                    }
                });
                
                // Trigger change untuk set min value
                if (startInput.value) {
                    startInput.dispatchEvent(new Event('change'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Gagal mengambil data booking', 'error');
                closeAllModals();
            })
            .finally(() => {
                isLoading = false;
            });
    };

    window.deleteBooking = function(bookingId) {
        document.getElementById('delete_booking_id').value = bookingId;
        document.getElementById('delete-booking-id').textContent = bookingId;
        openModal('delete');
    };

    // Modal utility functions
    function openModal(type) {
        // Close all modals first
        closeAllModals();
        
        // Show selected modal
        switch(type) {
            case 'detail':
                detailModal.classList.add('active');
                break;
            case 'edit':
                editModal.classList.add('active');
                break;
            case 'delete':
                deleteModal.classList.add('active');
                break;
        }
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeAllModals() {
        detailModal.classList.remove('active');
        editModal.classList.remove('active');
        deleteModal.classList.remove('active');
        document.body.style.overflow = '';
        isLoading = false;
    }

    // Close modal on click outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeAllModals();
        }
    };

    // Close modal buttons
    document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', closeAllModals);
    });

    // Handle form submissions via AJAX
    document.getElementById('editBookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (isLoading) return;
        isLoading = true;
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
        
        // Submit via AJAX
        fetch('', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showAlert(data.notice, 'success');
                closeAllModals();
                window.location.reload();
            } else {
                showAlert(data.error, 'error');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menyimpan', 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        })
        .finally(() => {
            isLoading = false;
        });
    });

    document.getElementById('deleteBookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (isLoading) return;
        isLoading = true;
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        submitBtn.disabled = true;
        
        // Submit via AJAX
        fetch('', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showAlert(data.notice, 'success');
                closeAllModals();
                window.location.reload();
            } else {
                showAlert(data.error, 'error');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghapus', 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        })
        .finally(() => {
            isLoading = false;
        });
    });

    // Helper function untuk show alert
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
        
        // Insert after the header in container
        const container = document.querySelector('.container');
        const header = container.querySelector('.header');
        if (header && container) {
            header.insertAdjacentElement('afterend', alertDiv);
        }
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Pagination variables
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const startInput = document.getElementById('start_time');
        const endInput = document.getElementById('end_time');
        const startDisplay = document.getElementById('start_time_display');
        const endDisplay = document.getElementById('end_time_display');
        const monitorToggle = document.getElementById('monitorToggle');
        
        // Initialize pagination
        initializePagination();
        
        // Format tanggal untuk display
        function formatDateTimeDisplay(dateString) {
            if (!dateString) return 'Belum dipilih';
            
            const date = new Date(dateString);
            // Validasi date
            if (isNaN(date.getTime())) return 'Format tidak valid';
            
            const options = { 
                weekday: 'long', 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('id-ID', options);
        }
        
        // Update display saat input berubah
        function updateTimeDisplays() {
            if (startInput.value) {
                startDisplay.textContent = formatDateTimeDisplay(startInput.value);
                startDisplay.style.color = 'var(--ink)';
                startDisplay.style.fontWeight = '500';
            } else {
                startDisplay.textContent = 'Belum dipilih';
                startDisplay.style.color = 'var(--muted)';
                startDisplay.style.fontWeight = 'normal';
            }
            
            if (endInput.value) {
                endDisplay.textContent = formatDateTimeDisplay(endInput.value);
                endDisplay.style.color = 'var(--ink)';
                endDisplay.style.fontWeight = '500';
            } else {
                endDisplay.textContent = 'Belum dipilih';
                endDisplay.style.color = 'var(--muted)';
                endDisplay.style.fontWeight = 'normal';
            }
        }
        
        // Update end time minimum saat start time berubah
        startInput.addEventListener('change', function() {
            if (this.value) {
                const start = new Date(this.value);
                const minEnd = new Date(start.getTime() + 30 * 60 * 1000); // Minimal 30 menit setelah mulai
                endInput.min = minEnd.toISOString().slice(0, 16);
                
                // Jika end time sudah dipilih dan kurang dari minimal, reset
                if (endInput.value) {
                    const currentEnd = new Date(endInput.value);
                    if (currentEnd < minEnd) {
                        endInput.value = '';
                        showAlert('Waktu selesai harus minimal 30 menit setelah waktu mulai. Silahkan pilih ulang.', 'warning');
                    }
                }
            }
            updateTimeDisplays();
        });
        
        endInput.addEventListener('change', updateTimeDisplays);
        
        // Initial display
        updateTimeDisplays();
        
        // Form validation
        form.addEventListener('submit', function(e) {
            const start = startInput.value ? new Date(startInput.value) : null;
            const end = endInput.value ? new Date(endInput.value) : null;
            const now = new Date();
            
            // Validasi waktu sudah dipilih
            if (!start) {
                e.preventDefault();
                showAlert('Harap pilih waktu mulai.', 'error');
                startInput.focus();
                return false;
            }
            
            if (!end) {
                e.preventDefault();
                showAlert('Harap pilih waktu selesai.', 'error');
                endInput.focus();
                return false;
            }
            
            // Validasi waktu
            if (end <= start) {
                e.preventDefault();
                showAlert('Waktu selesai harus setelah waktu mulai.', 'error');
                endInput.focus();
                return false;
            }
            
            // Validasi durasi minimal 30 menit
            const durationMinutes = (end - start) / (1000 * 60);
            if (durationMinutes < 30) {
                e.preventDefault();
                showAlert('Durasi booking minimal 30 menit.', 'error');
                return false;
            }
            
            // Validasi durasi maksimal 8 jam
            const durationHours = (end - start) / (1000 * 60 * 60);
            if (durationHours > 8) {
                e.preventDefault();
                showAlert('Durasi booking maksimal 8 jam.', 'error');
                return false;
            }
            
            // Validasi booking di masa lalu
            if (start < now) {
                e.preventDefault();
                showAlert('Tidak bisa membuat booking di waktu yang sudah lewat.', 'error');
                return false;
            }
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            return true;
        });
        
        // Cegah form resubmission warning
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname + window.location.search);
        }

        // Monitor mode (fullscreen)
        if (monitorToggle) {
            const setActiveFilterBtn = (filter) => {
                const filterBtns = document.querySelectorAll('.filter-btn');
                filterBtns.forEach(btn => btn.classList.remove('active'));
                const target = Array.from(filterBtns).find(btn => btn.getAttribute('onclick')?.includes(`'${filter}'`));
                if (target) target.classList.add('active');
            };

            const monitorExitModal = document.getElementById('monitorExitModal');
            const monitorExitBtn = document.getElementById('monitorExitBtn');
            const monitorExitClose = document.getElementById('monitorExitClose');
            const monitorExitCancel = document.getElementById('monitorExitCancel');
            const monitorExitConfirm = document.getElementById('monitorExitConfirm');
            const monitorPassword = document.getElementById('monitor_password');
            const monitorPasswordError = document.getElementById('monitor_password_error');

            const openMonitorModal = () => {
                if (!monitorExitModal) return;
                monitorExitModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                if (monitorPassword) {
                    monitorPassword.value = '';
                    monitorPassword.focus();
                }
                if (monitorPasswordError) {
                    monitorPasswordError.style.display = 'none';
                    monitorPasswordError.textContent = '';
                }
            };

            const closeMonitorModal = () => {
                if (!monitorExitModal) return;
                monitorExitModal.classList.remove('active');
                document.body.style.overflow = '';
            };

            if (monitorExitClose) monitorExitClose.addEventListener('click', closeMonitorModal);
            if (monitorExitCancel) monitorExitCancel.addEventListener('click', closeMonitorModal);
            if (monitorExitModal) {
                monitorExitModal.addEventListener('click', (e) => {
                    if (e.target === monitorExitModal) closeMonitorModal();
                });
            }
            if (monitorExitBtn) {
                monitorExitBtn.addEventListener('click', openMonitorModal);
            }

            if (monitorExitConfirm) {
                monitorExitConfirm.addEventListener('click', () => {
                    const password = monitorPassword ? monitorPassword.value : '';
                    if (!password) {
                        if (monitorPasswordError) {
                            monitorPasswordError.textContent = 'Password wajib diisi.';
                            monitorPasswordError.style.display = 'block';
                        }
                        return;
                    }

                    const formData = new FormData();
                    formData.append('action', 'verify_password');
                    formData.append('password', password);
                    formData.append('ajax', 'true');

                    monitorExitConfirm.disabled = true;
                    const originalText = monitorExitConfirm.innerHTML;
                    monitorExitConfirm.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memeriksa...';

                    fetch('', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data && data.success) {
                            closeMonitorModal();
                            document.exitFullscreen?.();
                        } else {
                            if (monitorPasswordError) {
                                monitorPasswordError.textContent = data?.error || 'Password salah.';
                                monitorPasswordError.style.display = 'block';
                            }
                        }
                    })
                    .catch(() => {
                        if (monitorPasswordError) {
                            monitorPasswordError.textContent = 'Gagal memeriksa password.';
                            monitorPasswordError.style.display = 'block';
                        }
                    })
                    .finally(() => {
                        monitorExitConfirm.disabled = false;
                        monitorExitConfirm.innerHTML = originalText;
                    });
                });
            }

            const updateMonitorState = () => {
                const isFs = !!document.fullscreenElement;
                document.body.classList.toggle('fullscreen-mode', isFs);
                monitorToggle.innerHTML = isFs
                    ? '<i class="fas fa-compress"></i> Keluar Monitor'
                    : '<i class="fas fa-expand"></i> Mode Monitor';

                if (isFs) {
                    currentFilter = 'today';
                    currentPage = 1;
                    setActiveFilterBtn('today');
                    updatePagination();
                } else {
                    currentFilter = 'all';
                    currentPage = 1;
                    setActiveFilterBtn('all');
                    updatePagination();
                }
            };

            monitorToggle.addEventListener('click', () => {
                if (document.fullscreenElement) {
                    openMonitorModal();
                } else {
                    document.documentElement.requestFullscreen?.();
                }
            });

            document.addEventListener('fullscreenchange', updateMonitorState);
        }
    });

    // Pagination functions
    function initializePagination() {
        updatePagination();
    }

    function updatePagination() {
        // Get ALL rows first
        const allRows = document.querySelectorAll('.booking-row');
        
        // First, show all rows temporarily to check filter
        allRows.forEach(row => {
            const status = row.getAttribute('data-status');
            const date = row.getAttribute('data-date');
            const today = new Date().toISOString().slice(0, 10);
            
            let show = true;
            
            switch(currentFilter) {
                case 'upcoming':
                    show = status === 'upcoming';
                    break;
                case 'ongoing':
                    show = status === 'ongoing';
                    break;
                case 'completed':
                    show = status === 'completed';
                    break;
                case 'today':
                    show = date === today;
                    break;
                case 'all':
                default:
                    show = true;
            }
            
            // Mark rows based on filter (using data attribute)
            row.setAttribute('data-filtered', show ? 'true' : 'false');
        });
        
        // Get visible rows after filter
        const visibleRows = Array.from(allRows).filter(row => row.getAttribute('data-filtered') === 'true');
        const totalItems = visibleRows.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        
        // Update info text
        const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalItems);
        
        document.getElementById('currentStart').textContent = start;
        document.getElementById('currentEnd').textContent = end;
        document.getElementById('totalItems').textContent = totalItems;
        
        // Show/hide rows for current page
        allRows.forEach(row => {
            if (row.getAttribute('data-filtered') === 'false') {
                row.style.display = 'none';
            } else {
                // This row passes the filter, now check pagination
                const indexInVisible = visibleRows.indexOf(row);
                const rowPage = Math.floor(indexInVisible / itemsPerPage) + 1;
                
                if (rowPage === currentPage) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        
        // Update page numbers
        renderPageNumbers(totalPages);
        
        // Update prev/next buttons
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        
        // Show/hide pagination container - hanya tampilkan jika data lebih dari itemsPerPage
        const paginationContainer = document.querySelector('.pagination-container');
        if (totalItems <= itemsPerPage) {
            paginationContainer.style.display = 'none';
        } else {
            paginationContainer.style.display = 'flex';
        }
        
        // Update stats based on filter
        updateFilteredStats();
    }

    function renderPageNumbers(totalPages) {
        const pageNumbersContainer = document.getElementById('pageNumbers');
        pageNumbersContainer.innerHTML = '';
        
        if (totalPages <= 1) return;
        
        // Show max 5 page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        // Adjust if we're near the end
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }
        
        // First page
        if (startPage > 1) {
            addPageNumber(1);
            if (startPage > 2) {
                addPageDots();
            }
        }
        
        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            addPageNumber(i);
        }
        
        // Last page
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                addPageDots();
            }
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
        const allRows = document.querySelectorAll('.booking-row');
        const visibleRows = Array.from(allRows).filter(row => row.getAttribute('data-filtered') === 'true');
        const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        
        currentPage += direction;
        currentPage = Math.max(1, Math.min(currentPage, totalPages));
        updatePagination();
    }

    // Filter functionality
    window.filterBookings = function(filter) {
        const rows = document.querySelectorAll('.booking-row');
        const filterBtns = document.querySelectorAll('.filter-btn');
        
        // Update active button
        filterBtns.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        // Update current filter
        currentFilter = filter;
        
        // Reset to page 1 when filtering
        currentPage = 1;
        
        // Update pagination after filtering (this will handle the display logic)
        updatePagination();
    };
    
    // Fungsi untuk update stats berdasarkan filter
    function updateFilteredStats() {
        const rows = document.querySelectorAll('.booking-row');
        let upcomingCount = 0;
        let ongoingCount = 0;
        let completedCount = 0;
        let totalCount = 0;
        
        rows.forEach(row => {
            if (row.getAttribute('data-filtered') === 'true') {
                const status = row.getAttribute('data-status');
                totalCount++;
                
                if (status === 'upcoming') upcomingCount++;
                if (status === 'ongoing') ongoingCount++;
                if (status === 'completed') completedCount++;
            }
        });
        
        // Update stats display
        const upcomingStat = document.getElementById('stat-upcoming');
        const ongoingStat = document.getElementById('stat-ongoing');
        const completedStat = document.getElementById('stat-completed');
        const totalStat = document.getElementById('stat-total');
        
        if (upcomingStat) upcomingStat.textContent = upcomingCount;
        if (ongoingStat) ongoingStat.textContent = ongoingCount;
        if (completedStat) completedStat.textContent = completedCount;
        if (totalStat) totalStat.textContent = totalCount;
    }
</script>
</body>
</html>
