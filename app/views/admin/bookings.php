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
            --monitor-wallpaper-url: none;
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

        body.modal-open .header,
        body.modal-open .topbar,
        body.modal-open .tabbar,
        body.modal-open .mobile-brand {
            display: none !important;
        }

        .fullscreen-mode main.container {
            padding-top: 0;
        }

        .fullscreen-mode .action-btn.edit,
        .fullscreen-mode .action-btn.delete {
            display: none;
        }

        .fullscreen-mode .filter-controls,
        .fullscreen-mode .stats-grid {
            display: none !important;
        }

        .monitor-add-btn {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(247, 200, 66, 0.5);
            background: rgba(247, 200, 66, 0.9);
            color: #1a1a1a;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.35);
        }

        .monitor-add-btn:hover {
            transform: translateY(-1px);
        }

        .fullscreen-mode .monitor-add-btn {
            display: inline-flex;
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

        .monitor-room-hint {
            font-size: 12px;
            color: var(--accent);
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 6px;
        }

        .monitor-room-hint span {
            color: var(--muted);
        }

        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        #createBookingCardPlaceholder {
            display: none;
        }

        .fullscreen-mode .grid-two {
            grid-template-columns: 1fr;
            justify-items: center;
        }

        .fullscreen-mode #createBookingCard:not(.in-monitor-modal) {
            display: none;
        }

        .fullscreen-mode .bookings-card {
            width: min(1200px, 94vw);
            margin: 0 auto;
        }

        .booking-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .booking-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
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
            margin-bottom: 8px;
        }

        select.room-locked {
            pointer-events: none;
            opacity: 0.75;
        }

        select.user-locked {
            pointer-events: none;
            opacity: 0.75;
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

        .fullscreen-mode .filter-btn:not(.monitor-only) {
            opacity: 0.35;
            pointer-events: none;
        }

        .monitor-banner {
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 18px 0 10px;
            padding: 16px 18px;
            border-radius: 16px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.6);
        }

        .fullscreen-mode .monitor-banner {
            display: flex;
        }

        .monitor-clock {
            font-family: "Fraunces", serif;
            font-size: 48px;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--ink);
        }

        .monitor-clock span {
            font-size: 18px;
            font-weight: 500;
            color: var(--muted);
            display: inline-block;
            margin-left: 8px;
            letter-spacing: 0.5px;
        }

        .monitor-wallpapers {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .monitor-wallpapers.is-locked .wallpaper-btn {
            opacity: 0.4;
            pointer-events: none;
        }

        .monitor-wallpaper-note {
            font-size: 12px;
            color: var(--accent);
            margin-top: 6px;
        }

        .monitor-wallpaper-toggle {
            margin-top: 8px;
        }

        .monitor-wallpaper-toggle .toggle-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
        }

        .monitor-wallpaper-toggle input[type="checkbox"] {
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
        }

        .wallpaper-btn {
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(17, 21, 28, 0.8);
            color: var(--muted);
            font-size: 12px;
            padding: 8px 10px;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .wallpaper-btn.active,
        .wallpaper-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.12);
        }

        body.monitor-wallpaper {
            background: #0b0d12;
            background-image: linear-gradient(180deg, rgba(11, 13, 18, 0.5), rgba(11, 13, 18, 0.7)), var(--monitor-wallpaper-url);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        body.fullscreen-mode.monitor-wallpaper {
            background-image: linear-gradient(180deg, rgba(11, 13, 18, 0.16), rgba(11, 13, 18, 0.32)), var(--monitor-wallpaper-url);
        }

        .fullscreen-mode .bookings-card {
            width: min(900px, 92vw);
            margin: 0 auto;
            background: transparent;
            border-color: transparent;
            box-shadow: none;
            backdrop-filter: none;
            padding: 0;
        }

        .fullscreen-mode .table-container {
            background: rgba(11, 13, 18, 0.2);
            border-color: rgba(42, 49, 61, 0.4);
            overflow-x: hidden;
        }

        .fullscreen-mode .table thead {
            display: table-header-group;
            background: rgba(17, 21, 28, 0.38);
        }

        .fullscreen-mode .table {
            width: 100%;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .fullscreen-mode .table tbody {
            display: table-row-group;
        }

        .fullscreen-mode .table tr {
            display: table-row;
        }

        .fullscreen-mode .table td,
        .fullscreen-mode .table th {
            display: table-cell;
            vertical-align: middle;
        }

        .fullscreen-mode .table th,
        .fullscreen-mode .table td {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .fullscreen-mode .table th:nth-child(1),
        .fullscreen-mode .table td:nth-child(1) {
            width: 38%;
        }

        .fullscreen-mode .table th:nth-child(2),
        .fullscreen-mode .table td:nth-child(2) {
            width: 32%;
        }

        .fullscreen-mode .table th:nth-child(3),
        .fullscreen-mode .table td:nth-child(3) {
            width: 12%;
        }

        .fullscreen-mode .table th:nth-child(4),
        .fullscreen-mode .table td:nth-child(4) {
            width: 20%;
        }

        .fullscreen-mode .booking-row {
            transition: all 0.25s ease;
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(10, 13, 20, 0.5);
            margin: 0 0 16px;
            overflow: hidden;
        }

        .fullscreen-mode .booking-row.monitor-current {
            border-color: rgba(247, 200, 66, 0.55);
            background: rgba(11, 14, 22, 0.72);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }

        .fullscreen-mode .booking-row.monitor-current td {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .fullscreen-mode .booking-row.monitor-current .user-avatar {
            width: 54px;
            height: 54px;
            font-size: 20px;
        }

        .fullscreen-mode .booking-row.monitor-current .duration-indicator,
        .fullscreen-mode .booking-row.monitor-current .room-badge,
        .fullscreen-mode .booking-row.monitor-current .booking-status {
            font-size: 13px;
        }

        .fullscreen-mode .booking-row.monitor-current td[data-label="Waktu"] {
            font-size: 16px;
        }

        .fullscreen-mode .booking-row td[data-label="Waktu"] > div > div:first-child {
            font-size: 14px !important;
            color: rgba(242, 243, 245, 0.7) !important;
        }

        .fullscreen-mode .booking-row td[data-label="Waktu"] > div > div:last-child {
            font-size: 24px !important;
            line-height: 1.05;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            color: var(--ink) !important;
            white-space: nowrap;
            overflow-wrap: normal !important;
            word-break: normal !important;
        }

        .fullscreen-mode .booking-row.monitor-current td[data-label="Waktu"] > div > div:last-child {
            font-size: 38px !important;
        }

        .fullscreen-mode .booking-row.monitor-next {
            opacity: 0.84;
            border-color: rgba(255, 255, 255, 0.22);
            background: rgba(10, 12, 18, 0.52);
        }

        .fullscreen-mode .booking-row.monitor-next td {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .fullscreen-mode .booking-row.monitor-next .user-avatar {
            width: 30px;
            height: 30px;
            font-size: 11px;
        }

        .fullscreen-mode .booking-row.monitor-next .duration-indicator,
        .fullscreen-mode .booking-row.monitor-next .room-badge,
        .fullscreen-mode .booking-row.monitor-next .booking-status {
            font-size: 10px;
        }

        .fullscreen-mode .booking-row .booking-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            padding: 4px 9px;
            letter-spacing: 0.35px;
        }

        .fullscreen-mode .booking-row.monitor-next td[data-label="Waktu"] {
            font-size: 12px;
        }

        .fullscreen-mode .booking-row.monitor-next td[data-label="Waktu"] > div > div:first-child {
            font-size: 12px !important;
        }

        .fullscreen-mode .booking-row.monitor-next td[data-label="Waktu"] > div > div:last-child {
            font-size: 24px !important;
            font-weight: 750 !important;
        }

        .fullscreen-mode .booking-row.monitor-next td[data-label="User & Room"] > div > div:last-child > div:first-child {
            font-size: 13px !important;
        }

        .fullscreen-mode .booking-row td {
            border: none;
        }

        .fullscreen-mode .table th:nth-child(5),
        .fullscreen-mode .booking-row td[data-label="Aksi"] {
            display: none;
        }

        .fullscreen-mode .pagination-container {
            display: none !important;
        }

        body[data-wallpaper="aurora"] {
            background: radial-gradient(circle at 20% 10%, rgba(91, 255, 203, 0.25), transparent 55%),
                        radial-gradient(circle at 80% 20%, rgba(247, 200, 66, 0.2), transparent 50%),
                        radial-gradient(circle at 50% 80%, rgba(89, 120, 255, 0.25), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="ember"] {
            background: radial-gradient(circle at 15% 20%, rgba(255, 120, 80, 0.25), transparent 50%),
                        radial-gradient(circle at 80% 10%, rgba(247, 200, 66, 0.2), transparent 45%),
                        radial-gradient(circle at 50% 85%, rgba(255, 90, 90, 0.25), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="atlas"] {
            background: radial-gradient(circle at 15% 15%, rgba(87, 184, 255, 0.25), transparent 55%),
                        radial-gradient(circle at 85% 25%, rgba(179, 102, 255, 0.18), transparent 50%),
                        radial-gradient(circle at 50% 90%, rgba(87, 255, 117, 0.18), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="midnight"] {
            background: radial-gradient(circle at 20% 15%, rgba(40, 88, 255, 0.18), transparent 55%),
                        radial-gradient(circle at 80% 30%, rgba(90, 120, 200, 0.18), transparent 50%),
                        radial-gradient(circle at 50% 85%, rgba(0, 0, 0, 0.4), transparent 60%),
                        #080a11;
        }

        body[data-wallpaper="sand"] {
            background: radial-gradient(circle at 15% 20%, rgba(255, 214, 165, 0.25), transparent 50%),
                        radial-gradient(circle at 85% 15%, rgba(247, 200, 66, 0.18), transparent 45%),
                        radial-gradient(circle at 50% 85%, rgba(255, 180, 120, 0.2), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="forest"] {
            background: radial-gradient(circle at 20% 20%, rgba(87, 255, 117, 0.2), transparent 55%),
                        radial-gradient(circle at 80% 15%, rgba(20, 120, 80, 0.2), transparent 50%),
                        radial-gradient(circle at 50% 85%, rgba(10, 60, 40, 0.25), transparent 60%),
                        #0b0d12;
        }

        body[data-wallpaper="glacier"] {
            background: radial-gradient(circle at 15% 15%, rgba(180, 230, 255, 0.25), transparent 55%),
                        radial-gradient(circle at 80% 20%, rgba(120, 180, 255, 0.2), transparent 50%),
                        radial-gradient(circle at 50% 90%, rgba(90, 130, 200, 0.2), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="sunset"] {
            background: radial-gradient(circle at 10% 15%, rgba(255, 120, 80, 0.25), transparent 50%),
                        radial-gradient(circle at 90% 20%, rgba(255, 190, 120, 0.22), transparent 50%),
                        radial-gradient(circle at 50% 85%, rgba(180, 80, 140, 0.2), transparent 55%),
                        #0b0d12;
        }

        body[data-wallpaper="onyx"] {
            background: radial-gradient(circle at 20% 20%, rgba(60, 60, 80, 0.18), transparent 55%),
                        radial-gradient(circle at 80% 30%, rgba(30, 30, 40, 0.22), transparent 50%),
                        radial-gradient(circle at 50% 85%, rgba(0, 0, 0, 0.5), transparent 60%),
                        #050607;
        }

        body[data-wallpaper="orchid"] {
            background: radial-gradient(circle at 15% 15%, rgba(200, 120, 255, 0.22), transparent 55%),
                        radial-gradient(circle at 85% 20%, rgba(120, 80, 200, 0.22), transparent 50%),
                        radial-gradient(circle at 50% 85%, rgba(180, 90, 140, 0.2), transparent 55%),
                        #0b0d12;
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

        #monitorCreateModal .modal-header {
            justify-content: flex-end;
        }

        .modal-cancel {
            background: rgba(154, 160, 170, 0.1);
            border: 1px solid var(--stroke);
            color: var(--muted);
            width: 100%;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s ease;
        }

        .modal-cancel:hover {
            background: var(--error);
            border-color: var(--error);
            color: var(--ink);
        }

        .modal-body {
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
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
            margin-bottom: 4px;
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
                <button type="button" class="monitor-btn" id="monitorToggle">
                    <i class="fas fa-expand"></i>
                    Mode Monitor
                </button>
                <a href="/dashboard_admin" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <button type="button" class="monitor-exit-btn" id="monitorExitBtn">
            <i class="fas fa-unlock"></i> Keluar Monitor
        </button>

        <button type="button" class="monitor-add-btn" id="monitorAddBookingBtn">
            <i class="fas fa-plus"></i> Tambah Booking
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

        <!-- Modal: Create Booking (Monitor) -->
        <div class="modal" id="monitorAuthModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-user-shield"></i> Verifikasi User Monitor</h2>
                    <button class="modal-close" type="button" id="monitorAuthClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color: var(--muted); margin-bottom: 16px;">
                        Masukkan email dan password user yang terdaftar di admin ini sebelum menambah booking.
                    </p>
                    <div class="detail-item">
                        <label><i class="fas fa-envelope"></i> Email User</label>
                        <input type="email" id="monitor_user_email" placeholder="user@email.com" autocomplete="username">
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-key"></i> Password User</label>
                        <input type="password" id="monitor_user_password" placeholder="Password user" autocomplete="current-password">
                    </div>
                    <div class="monitor-error" id="monitor_auth_error" style="display:none;"></div>
                    <div class="modal-actions" style="margin-top: 20px;">
                        <button class="action-btn" type="button" id="monitorAuthCancel">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button class="action-btn monitor-confirm" type="button" id="monitorAuthConfirm">
                            <i class="fas fa-check-circle"></i> Verifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Create Booking (Monitor) -->
        <div class="modal" id="monitorCreateModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="modal-close" type="button" id="monitorCreateClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body" id="monitorCreateBody"></div>
            </div>
        </div>

        <!-- Modal: Select Room for Monitor -->
        <div class="modal" id="monitorRoomModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-door-open"></i> Pilih Room Monitor</h2>
                    <button class="modal-close" type="button" id="monitorRoomClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color: var(--muted); margin-bottom: 16px;">
                        Pilih room sebelum masuk mode monitor. Room akan terkunci selama mode monitor aktif.
                    </p>
                    <div class="detail-item">
                        <label><i class="fas fa-door-open"></i> Room</label>
                        <select id="monitor_room_select">
                            <option value="">Pilih room</option>
                            <?php foreach ($rooms as $row): ?>
                                <?php $wallpaperUrl = trim((string)($row['wallpaper_url'] ?? ''), " \t\n\r\0\x0B'\","); ?>
                                <option value="<?php echo (int)$row['id']; ?>" data-wallpaper="<?php echo htmlspecialchars($wallpaperUrl); ?>">
                                    <?php echo htmlspecialchars($row['name']); ?> (<?php echo $row['capacity']; ?> orang)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="monitor-error" id="monitor_room_error" style="display:none;"></div>
                    </div>
                    <div class="modal-actions" style="margin-top: 20px;">
                        <button class="action-btn" type="button" id="monitorRoomCancel">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button class="action-btn monitor-confirm" type="button" id="monitorRoomConfirm">
                            <i class="fas fa-expand"></i> Masuk Monitor
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid-two">
            <div id="createBookingCardPlaceholder"></div>
            <!-- Form Buat Booking -->
            <div class="card" id="createBookingCard">
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
                
                <form id="createBookingForm" method="post" class="grid">
                    <input type="hidden" name="action" value="create">
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-user"></i> User</label>
                            <select name="user_id" required>
                                <option value="">Pilih user</option>
                                <?php foreach ($users as $row): ?>
                                    <option value="<?php echo (int)$row['id']; ?>">
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div id="monitorUserHint" class="monitor-room-hint">
                                <i class="fas fa-user-lock"></i>
                                <span>User akan terisi otomatis setelah verifikasi monitor.</span>
                            </div>
                        </div>
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
                            <div id="monitorRoomHint" class="monitor-room-hint">
                                <i class="fas fa-lock"></i>
                                <span>Pilih room terlebih dahulu untuk mode monitor.</span>
                            </div>
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
            <div class="card bookings-card">
                <div class="booking-header">
                    <h2><i class="fas fa-list"></i> Daftar Booking</h2>
                    <div class="booking-header-actions" id="bookingHeaderActions"></div>
                </div>
                
                <div class="monitor-banner" id="monitorBanner">
                    <div class="monitor-clock" id="monitorClock">
                        00:00 <span>--/--/----</span>
                    </div>
                    <div class="monitor-wallpapers" id="monitorWallpapers">
                        <button type="button" class="wallpaper-btn" data-wallpaper="aurora">Aurora</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="ember">Ember</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="atlas">Atlas</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="midnight">Midnight</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="sand">Sand</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="forest">Forest</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="glacier">Glacier</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="sunset">Sunset</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="onyx">Onyx</button>
                        <button type="button" class="wallpaper-btn" data-wallpaper="orchid">Orchid</button>
                    </div>
                    <div class="monitor-wallpaper-note" id="monitorWallpaperNote" style="display: none;">
                        Wallpaper room aktif.
                    </div>
                    <div class="monitor-wallpaper-toggle" id="monitorWallpaperToggle">
                        <label class="toggle-label">
                            <input type="checkbox" id="toggleRoomWallpaper" checked>
                            <span>Gunakan wallpaper room</span>
                        </label>
                    </div>
                </div>

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
                    <button class="filter-btn monitor-only" onclick="filterBookings('today')">
                        <i class="fas fa-calendar-day"></i>
                        Hari Ini
                    </button>
                </div>
                
                <?php $hasBookings = !empty($bookings); ?>

                <div id="bookingEmptyState" class="empty-state" style="display: <?php echo $hasBookings ? 'none' : 'block'; ?>;">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Belum ada booking</h3>
                    <p>Buat booking pertama Anda menggunakan form di samping</p>
                </div>

                <div id="bookingDataSection" style="display: <?php echo $hasBookings ? 'block' : 'none'; ?>;">
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
                                        data-room-id="<?php echo (int)$row['room_id']; ?>"
                                        class="booking-row">
                                        <td data-label="User & Room">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($row['user_name'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--ink);">
                                                        <?php echo htmlspecialchars($row['user_name']); ?>
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
                </div>
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
                            <label><i class="fas fa-user"></i> User</label>
                            <select name="edit_user_id" id="edit_user_id" required>
                                <option value="">Pilih user</option>
                                <?php foreach ($users as $row): ?>
                                    <option value="<?php echo (int)$row['id']; ?>">
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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
                        <button type="button" class="btn-secondary modal-cancel">
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
                        <button type="button" class="btn-secondary modal-cancel">
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
    const editBookingForm = document.getElementById('editBookingForm');
    const deleteBookingForm = document.getElementById('deleteBookingForm');
    
    let roomSchedules = [];

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
                document.getElementById('edit_user_id').value = data.user_id;
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
                
                startInput.addEventListener('change', function () {
                    if (!this.value) return;

                    const start = new Date(this.value);

                    // 1️⃣ SET MIN DULU
                    const minEnd = new Date(start.getTime() + 30 * 60 * 1000);
                    endInput.min = toLocalInputValue(minEnd);

                    // 2️⃣ BARU SET DEFAULT +2 JAM
                    const defaultEnd = new Date(start.getTime() + 2 * 60 * 60 * 1000);
                    endInput.value = toLocalInputValue(defaultEnd);

                    updateTimeDisplays();
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
    function setModalOpenState() {
        const hasOpenModal = !!document.querySelector('.modal.active');
        document.body.classList.toggle('modal-open', hasOpenModal);
    }

    function resetEditSubmitState() {
        if (!editBookingForm) return;
        const submitBtn = editBookingForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
        submitBtn.disabled = false;
    }

    function resetDeleteSubmitState() {
        if (!deleteBookingForm) return;
        const submitBtn = deleteBookingForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Ya, Hapus';
        submitBtn.disabled = false;
    }

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
        setModalOpenState();
        if (type === 'edit') resetEditSubmitState();
        if (type === 'delete') resetDeleteSubmitState();
    }

    function closeAllModals() {
        detailModal.classList.remove('active');
        editModal.classList.remove('active');
        deleteModal.classList.remove('active');
        document.body.style.overflow = '';
        isLoading = false;
        setModalOpenState();
        resetEditSubmitState();
        resetDeleteSubmitState();
    }

    // Close modal on click outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeAllModals();
        }
    };

    // Close modal buttons
    document.querySelectorAll('.modal-cancel').forEach(button => {
        button.addEventListener('click', closeAllModals);
    });

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
                refreshLiveBookings();
            } else {
                showAlert(data.error, 'error');
                resetEditSubmitState();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menyimpan', 'error');
            resetEditSubmitState();
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
        fetchJsonWithTimeout('', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(data => {
            if (data.success) {
                showAlert(data.notice, 'success');
                closeAllModals();
                refreshLiveBookings();
            } else {
                showAlert(data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghapus', 'error');
        })
        .finally(() => {
            resetDeleteSubmitState();
            isLoading = false;
        });
    });

    const createForm = document.getElementById('createBookingForm');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            if (e.defaultPrevented) return;
            e.preventDefault();

            if (isLoading) return;
            isLoading = true;

            if (isMonitorMode()) {
                if (!monitorVerifiedCreator) {
                    showAlert('Verifikasi email dan password user terlebih dahulu.', 'error');
                    isLoading = false;
                    return;
                }
                const roomSelect = this.querySelector('select[name="room_id"]');
                if (!roomSelect || !roomSelect.value) {
                    showAlert('Pilih room terlebih dahulu untuk mode monitor.', 'error');
                    isLoading = false;
                    return;
                }
            }

            const formData = new FormData(this);
            if (isMonitorMode() && monitorVerifiedCreator) {
                formData.set('monitor_mode', '1');
                formData.set('monitor_email', monitorVerifiedCreator.email);
                formData.set('monitor_password', monitorVerifiedCreator.password);
                formData.set('user_id', String(monitorVerifiedCreator.userId));
            } else {
                formData.set('monitor_mode', '0');
            }
            formData.append('ajax', 'true');

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;

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
                    this.reset();

                    const startDisplay = document.getElementById('start_time_display');
                    const endDisplay = document.getElementById('end_time_display');
                    if (startDisplay) {
                        startDisplay.textContent = 'Belum dipilih';
                        startDisplay.style.color = 'var(--muted)';
                        startDisplay.style.fontWeight = 'normal';
                    }
                    if (endDisplay) {
                        endDisplay.textContent = 'Belum dipilih';
                        endDisplay.style.color = 'var(--muted)';
                        endDisplay.style.fontWeight = 'normal';
                    }

                    if (isMonitorMode() && lockedRoomId) {
                        const roomSelect = this.querySelector('select[name="room_id"]');
                        if (roomSelect) roomSelect.value = lockedRoomId;
                        resetMonitorCreatorVerification();
                        const monitorCreateModalEl = document.getElementById('monitorCreateModal');
                        if (monitorCreateModalEl) monitorCreateModalEl.classList.remove('active');
                        document.body.style.overflow = '';
                        document.body.classList.toggle('modal-open', !!document.querySelector('.modal.active'));
                    }
                    applyMonitorRoomRules();
                    refreshLiveBookings();
                } else {
                    showAlert(data.error, 'error');
                }
            })
            .catch(() => {
                showAlert('Terjadi kesalahan saat membuat booking', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                isLoading = false;
            });
        });
    }

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

    function fetchJsonWithTimeout(url, options, timeoutMs = 8000) {
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), timeoutMs);

        return fetch(url, { ...options, signal: controller.signal })
            .then(async response => {
                const text = await response.text();
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                try {
                    return JSON.parse(text);
                } catch (err) {
                    throw new Error('Invalid JSON response');
                }
            })
            .finally(() => {
                clearTimeout(timeoutId);
            });
    }

    // Pagination variables
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = 'all';
    let lockedRoomId = null;
    let monitorVerifiedCreator = null;

    function isMonitorMode() {
        return document.body.classList.contains('fullscreen-mode') || !!document.fullscreenElement;
    }

    function setFormDisabled(fields, disabled) {
        fields.forEach(field => {
            if (field) field.disabled = disabled;
        });
    }

    function setRoomLocked(roomSelect, locked) {
        if (!roomSelect) return;
        if (locked) {
            roomSelect.classList.add('room-locked');
            roomSelect.setAttribute('aria-disabled', 'true');
            roomSelect.setAttribute('tabindex', '-1');
        } else {
            roomSelect.classList.remove('room-locked');
            roomSelect.removeAttribute('aria-disabled');
            roomSelect.removeAttribute('tabindex');
        }
    }

    function setUserLocked(userSelect, locked) {
        if (!userSelect) return;
        if (locked) {
            userSelect.classList.add('user-locked');
            userSelect.setAttribute('aria-disabled', 'true');
            userSelect.setAttribute('tabindex', '-1');
        } else {
            userSelect.classList.remove('user-locked');
            userSelect.removeAttribute('aria-disabled');
            userSelect.removeAttribute('tabindex');
        }
    }

    function resetMonitorCreatorVerification() {
        monitorVerifiedCreator = null;
    }

    function getRoomWallpaperUrl(roomId) {
        if (!roomId) return '';
        const select = document.getElementById('monitor_room_select');
        if (!select) return '';
        const options = select.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === String(roomId)) {
                return options[i].dataset.wallpaper || '';
            }
        }
        return '';
    }

    function clearMonitorWallpaper() {
        document.body.classList.remove('monitor-wallpaper');
        document.body.style.removeProperty('--monitor-wallpaper-url');
        const monitorWallpapers = document.getElementById('monitorWallpapers');
        const note = document.getElementById('monitorWallpaperNote');
        if (monitorWallpapers) monitorWallpapers.classList.remove('is-locked');
        if (note) note.style.display = 'none';
    }

    function isRoomWallpaperEnabled() {
        const toggle = document.getElementById('toggleRoomWallpaper');
        if (!toggle) return true;
        return toggle.checked;
    }

    function updateRoomWallpaperToggleVisibility(roomId) {
        const toggleWrap = document.getElementById('monitorWallpaperToggle');
        const toggleInput = document.getElementById('toggleRoomWallpaper');
        if (!toggleWrap || !toggleInput) return;
        const hasWallpaper = !!(getRoomWallpaperUrl(roomId) || '').trim();
        toggleWrap.style.display = hasWallpaper ? 'block' : 'none';
        if (!hasWallpaper) {
            toggleInput.checked = false;
            localStorage.setItem('monitor_room_wallpaper_enabled', 'false');
            return;
        }
        // If room has wallpaper, make it the default background
        toggleInput.checked = true;
        localStorage.setItem('monitor_room_wallpaper_enabled', 'true');
    }

    function applyMonitorWallpaper(roomId) {
        if (!isMonitorMode()) {
            clearMonitorWallpaper();
            return false;
        }
        if (!isRoomWallpaperEnabled()) {
            clearMonitorWallpaper();
            return false;
        }
        const rawUrl = (getRoomWallpaperUrl(roomId) || '').replace(/^[\s'"]+|[\s'",]+$/g, '');
        if (!rawUrl) {
            clearMonitorWallpaper();
            return false;
        }
        const candidates = [];
        const base = rawUrl.startsWith('http://') || rawUrl.startsWith('https://') || rawUrl.startsWith('/')
            ? rawUrl
            : '/' + rawUrl;
        candidates.push(base);
        if (base.startsWith('/uploads/')) {
            candidates.push('/public' + base);
        } else if (base.startsWith('/public/uploads/')) {
            candidates.push(base.replace(/^\/public/, ''));
        }

        const uniqueCandidates = [...new Set(candidates)];
        if (uniqueCandidates.length === 0) {
            clearMonitorWallpaper();
            return false;
        }

        const applyPresetWallpaper = () => {
            const monitorWallpapers = document.getElementById('monitorWallpapers');
            if (!monitorWallpapers) return;
            const saved = localStorage.getItem('monitor_wallpaper') || 'aurora';
            const buttons = monitorWallpapers.querySelectorAll('.wallpaper-btn');
            buttons.forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-wallpaper') === saved);
            });
            document.body.setAttribute('data-wallpaper', saved);
        };

        let index = 0;
        const tryLoad = () => {
            const currentUrl = uniqueCandidates[index];
            if (!currentUrl) {
                clearMonitorWallpaper();
                applyPresetWallpaper();
                return;
            }
            const img = new Image();
            img.onload = () => {
                const safeUrl = currentUrl.replace(/"/g, '\\"');
                document.body.style.setProperty('--monitor-wallpaper-url', `url("${safeUrl}")`);
                document.body.classList.add('monitor-wallpaper');
                document.body.removeAttribute('data-wallpaper');
                const monitorWallpapers = document.getElementById('monitorWallpapers');
                const note = document.getElementById('monitorWallpaperNote');
                if (monitorWallpapers) monitorWallpapers.classList.add('is-locked');
                if (note) note.style.display = 'block';
            };
            img.onerror = () => {
                index += 1;
                tryLoad();
            };
            img.src = currentUrl;
        };

        tryLoad();
        return true;
    }

    function applyMonitorRoomRules() {
        const form = document.getElementById('createBookingForm');
        if (!form) return;

        const roomSelect = form.querySelector('select[name="room_id"]');
        if (!roomSelect) return;

        const userSelect = form.querySelector('select[name="user_id"]');
        const startInput = document.getElementById('start_time');
        const endInput = document.getElementById('end_time');
        const purposeInput = form.querySelector('input[name="purpose"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const monitorRoomHint = document.getElementById('monitorRoomHint');
        const monitorUserHint = document.getElementById('monitorUserHint');
        const editableFields = [startInput, endInput, purposeInput, submitBtn];

        if (!isMonitorMode()) {
            setFormDisabled([userSelect, ...editableFields], false);
            setRoomLocked(roomSelect, false);
            setUserLocked(userSelect, false);
            if (monitorRoomHint) monitorRoomHint.style.display = 'none';
            if (monitorUserHint) monitorUserHint.style.display = 'none';
            lockedRoomId = null;
            resetMonitorCreatorVerification();
            clearMonitorWallpaper();
            updateRoomWallpaperToggleVisibility(null);
            return;
        }

        if (!lockedRoomId && roomSelect.value) {
            lockedRoomId = roomSelect.value;
        }

        if (!lockedRoomId) {
            setFormDisabled([userSelect, ...editableFields], true);
            setRoomLocked(roomSelect, false);
            setUserLocked(userSelect, false);
            if (monitorRoomHint) {
                monitorRoomHint.style.display = 'flex';
                const hintText = monitorRoomHint.querySelector('span');
                if (hintText) hintText.textContent = 'Pilih room terlebih dahulu untuk mode monitor.';
            }
            if (monitorUserHint) {
                monitorUserHint.style.display = 'none';
            }
            clearMonitorWallpaper();
            updateRoomWallpaperToggleVisibility(null);
            return;
        }

        roomSelect.value = lockedRoomId;
        setFormDisabled(editableFields, false);
        setRoomLocked(roomSelect, true);
        if (monitorRoomHint) {
            monitorRoomHint.style.display = 'flex';
            const hintText = monitorRoomHint.querySelector('span');
            if (hintText) hintText.textContent = 'Room terkunci di mode monitor. Keluar mode monitor untuk mengganti.';
        }

        if (!monitorVerifiedCreator) {
            if (userSelect) userSelect.value = '';
            setFormDisabled([userSelect, ...editableFields], true);
            setUserLocked(userSelect, true);
            if (monitorUserHint) {
                monitorUserHint.style.display = 'flex';
                const hintText = monitorUserHint.querySelector('span');
                if (hintText) hintText.textContent = 'Verifikasi email dan password user sebelum input booking.';
            }
        } else {
            if (userSelect) userSelect.value = String(monitorVerifiedCreator.userId);
            setFormDisabled(editableFields, false);
            if (userSelect) userSelect.disabled = false;
            setUserLocked(userSelect, true);
            if (monitorUserHint) {
                monitorUserHint.style.display = 'flex';
                const hintText = monitorUserHint.querySelector('span');
                if (hintText) hintText.textContent = `User terkunci: ${monitorVerifiedCreator.userName}.`;
            }
        }

        updateRoomWallpaperToggleVisibility(lockedRoomId);
        applyMonitorWallpaper(lockedRoomId);
    }

    function isOverlapping(start, end) {
        return roomSchedules.some(slot =>
            start < slot.end && end > slot.start
        );
    }

    function getMaxAllowedEnd(start) {
        let nearestEnd = null;

        roomSchedules.forEach(slot => {
            // CASE 1: start DI DALAM booking yang sudah ada
            if (start >= slot.start && start < slot.end) {
                if (!nearestEnd || slot.end < nearestEnd) {
                    nearestEnd = slot.end;
                }
            }

            // CASE 2: booking DIMULAI setelah start
            if (slot.start > start) {
                if (!nearestEnd || slot.start < nearestEnd) {
                    nearestEnd = slot.start;
                }
            }
        });

        return nearestEnd;
    }

    function parseLocalDateTime(str) {
        // "2026-02-05 10:30:00" atau "2026-02-05T10:30"
        const clean = str.replace('T', ' ').split(' ')[0] + ' ' + str.split(/[ T]/)[1];
        const [date, time] = clean.split(' ');
        const [y, m, d] = date.split('-').map(Number);
        const [hh, mm] = time.split(':').map(Number);
        return new Date(y, m - 1, d, hh, mm);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const startInput = document.getElementById('start_time');
        const endInput = document.getElementById('end_time');
        const startDisplay = document.getElementById('start_time_display');
        const endDisplay = document.getElementById('end_time_display');
        const monitorToggle = document.getElementById('monitorToggle');

        const roomSelect = document.querySelector('select[name="room_id"]');

        roomSelect.addEventListener('change', function () {
            const roomId = this.value;
            if (isMonitorMode()) {
                lockedRoomId = roomId || null;
                applyMonitorWallpaper(lockedRoomId);
                applyMonitorRoomRules();
            }

            if (!roomId) {
                roomSchedules = [];
                return;
            }

            fetch(`?ajax=room_schedule&room_id=${roomId}`)
                .then(res => res.json())
                .then(data => {
                    roomSchedules = data.map(item => ({
                        start: parseLocalDateTime(item.start_time),
                        end: parseLocalDateTime(item.end_time)
                    }));
                });
        });
                
        // Initialize pagination
        initializePagination();
        startLiveUpdates();
        applyMonitorRoomRules();
        
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
        
        function toLocalInputValue(date) {
            const pad = n => String(n).padStart(2, '0');
            return `${date.getFullYear()}-${pad(date.getMonth()+1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
        }
        
        // Update end time minimum saat start time berubah
        startInput.addEventListener('input', function () {
            if (!this.value) return;
            
            endInput.removeAttribute('max');

            // ⚠️ parse manual supaya LOCAL TIME, bukan UTC
            const [date, time] = this.value.split('T');
            const [y, m, d] = date.split('-').map(Number);
            const [hh, mm] = time.split(':').map(Number);
            const start = new Date(y, m - 1, d, hh, mm);

            // 1️⃣ SET MIN DULU
            const minEnd = new Date(start.getTime() + 30 * 60 * 1000);
            endInput.min = toLocalInputValue(minEnd);

            // 2️⃣ SET DEFAULT +2 JAM
            const defaultEnd = new Date(start.getTime() + 2 * 60 * 60 * 1000);
            endInput.value = toLocalInputValue(defaultEnd);

            updateTimeDisplays();
        });
          
        endInput.addEventListener('change', updateTimeDisplays);
        
        // Initial display
        updateTimeDisplays();
        
        // Form validation
        form.addEventListener('submit', function(e) {
            const start = parseLocalDateTime(startInput.value);
            const end = parseLocalDateTime(endInput.value);

            const now = new Date();
            now.setSeconds(0, 0); 
            
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

            // CEK BENTROK ROOM (REAL CHECK)
            if (isOverlapping(start, end)) {
                e.preventDefault();

                const maxEnd = getMaxAllowedEnd(start);

                if (maxEnd) {
                    const safeValue = toLocalInputValue(maxEnd);

                    // 🔥 HAPUS ATURAN SEBELUMNYA
                    endInput.removeAttribute('min');

                    // 🔥 KUNCI KE SLOT AMAN
                    endInput.min = safeValue;
                    endInput.max = safeValue;
                    endInput.value = safeValue;

                    showAlert(
                        `Ruangan sudah terbooking. Maksimal sampai jam ${maxEnd.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        })}.`,
                        'error'
                    );
                } else {
                    showAlert('Ruangan sudah terbooking di jam tersebut.', 'error');
                }

                updateTimeDisplays();
                endInput.focus();
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
            const monitorRoomModal = document.getElementById('monitorRoomModal');
            const monitorRoomClose = document.getElementById('monitorRoomClose');
            const monitorRoomCancel = document.getElementById('monitorRoomCancel');
            const monitorRoomConfirm = document.getElementById('monitorRoomConfirm');
            const monitorRoomSelect = document.getElementById('monitor_room_select');
            const monitorRoomError = document.getElementById('monitor_room_error');
            const formRoomSelect = document.querySelector('select[name="room_id"]');
            const monitorAddBookingBtn = document.getElementById('monitorAddBookingBtn');
            const monitorAuthModal = document.getElementById('monitorAuthModal');
            const monitorAuthClose = document.getElementById('monitorAuthClose');
            const monitorAuthCancel = document.getElementById('monitorAuthCancel');
            const monitorAuthConfirm = document.getElementById('monitorAuthConfirm');
            const monitorUserEmail = document.getElementById('monitor_user_email');
            const monitorUserPassword = document.getElementById('monitor_user_password');
            const monitorAuthError = document.getElementById('monitor_auth_error');
            const monitorCreateModal = document.getElementById('monitorCreateModal');
            const monitorCreateClose = document.getElementById('monitorCreateClose');
            const monitorCreateBody = document.getElementById('monitorCreateBody');
            const createBookingCard = document.getElementById('createBookingCard');
            const createBookingCardPlaceholder = document.getElementById('createBookingCardPlaceholder');
            const toggleRoomWallpaper = document.getElementById('toggleRoomWallpaper');
            const bookingHeaderActions = document.getElementById('bookingHeaderActions');
            const monitorClock = document.getElementById('monitorClock');
            const monitorWallpapers = document.getElementById('monitorWallpapers');
            let monitorClockTimer = null;

            const openMonitorModal = () => {
                if (!monitorExitModal) return;
                monitorExitModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                setModalOpenState();
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
                setModalOpenState();
            };

            const openMonitorRoomModal = () => {
                if (!monitorRoomModal) return;
                monitorRoomModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                setModalOpenState();
                if (monitorRoomSelect) {
                    monitorRoomSelect.value = lockedRoomId || formRoomSelect?.value || '';
                    monitorRoomSelect.focus();
                }
                if (monitorRoomError) {
                    monitorRoomError.style.display = 'none';
                    monitorRoomError.textContent = '';
                }
            };

            const closeMonitorRoomModal = () => {
                if (!monitorRoomModal) return;
                monitorRoomModal.classList.remove('active');
                document.body.style.overflow = '';
                setModalOpenState();
            };

            const openMonitorAuthModal = () => {
                if (!monitorAuthModal) return;
                monitorAuthModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                setModalOpenState();
                if (monitorUserEmail) {
                    monitorUserEmail.value = '';
                    monitorUserEmail.focus();
                }
                if (monitorUserPassword) {
                    monitorUserPassword.value = '';
                }
                if (monitorAuthError) {
                    monitorAuthError.style.display = 'none';
                    monitorAuthError.textContent = '';
                }
            };

            const closeMonitorAuthModal = () => {
                if (!monitorAuthModal) return;
                monitorAuthModal.classList.remove('active');
                document.body.style.overflow = '';
                setModalOpenState();
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
            if (monitorRoomClose) monitorRoomClose.addEventListener('click', closeMonitorRoomModal);
            if (monitorRoomCancel) monitorRoomCancel.addEventListener('click', closeMonitorRoomModal);
            if (monitorRoomModal) {
                monitorRoomModal.addEventListener('click', (e) => {
                    if (e.target === monitorRoomModal) closeMonitorRoomModal();
                });
            }
            if (monitorAuthClose) monitorAuthClose.addEventListener('click', closeMonitorAuthModal);
            if (monitorAuthCancel) monitorAuthCancel.addEventListener('click', closeMonitorAuthModal);
            if (monitorAuthModal) {
                monitorAuthModal.addEventListener('click', (e) => {
                    if (e.target === monitorAuthModal) closeMonitorAuthModal();
                });
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

            if (monitorRoomConfirm) {
                monitorRoomConfirm.addEventListener('click', () => {
                    const selectedRoomId = monitorRoomSelect ? monitorRoomSelect.value : '';
                    if (!selectedRoomId) {
                        if (monitorRoomError) {
                            monitorRoomError.textContent = 'Pilih room terlebih dahulu.';
                            monitorRoomError.style.display = 'block';
                        }
                        return;
                    }

                    lockedRoomId = selectedRoomId;
                    resetMonitorCreatorVerification();
                    if (formRoomSelect) {
                        formRoomSelect.value = selectedRoomId;
                        formRoomSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }

                    updateRoomWallpaperToggleVisibility(lockedRoomId);
                    applyMonitorWallpaper(lockedRoomId);
                    closeMonitorRoomModal();
                    document.documentElement.requestFullscreen?.();
                });
            }

            const openMonitorCreateModal = () => {
                if (!monitorCreateModal) return;
                if (!isMonitorMode()) return;
                if (!lockedRoomId) {
                    showAlert('Pilih room monitor terlebih dahulu.', 'error');
                    return;
                }
                if (!monitorVerifiedCreator) {
                    openMonitorAuthModal();
                    return;
                }
                monitorCreateModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                setModalOpenState();
            };

            const closeMonitorCreateModal = () => {
                if (!monitorCreateModal) return;
                monitorCreateModal.classList.remove('active');
                document.body.style.overflow = '';
                setModalOpenState();
            };

            if (monitorAddBookingBtn) {
                monitorAddBookingBtn.addEventListener('click', openMonitorCreateModal);
            }
            if (monitorAuthConfirm) {
                monitorAuthConfirm.addEventListener('click', () => {
                    const email = monitorUserEmail ? monitorUserEmail.value.trim() : '';
                    const password = monitorUserPassword ? monitorUserPassword.value : '';

                    if (!email || !password) {
                        if (monitorAuthError) {
                            monitorAuthError.textContent = 'Email dan password wajib diisi.';
                            monitorAuthError.style.display = 'block';
                        }
                        return;
                    }

                    const formData = new FormData();
                    formData.append('action', 'verify_monitor_creator');
                    formData.append('email', email);
                    formData.append('password', password);
                    formData.append('ajax', 'true');

                    monitorAuthConfirm.disabled = true;
                    const originalText = monitorAuthConfirm.innerHTML;
                    monitorAuthConfirm.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memeriksa...';

                    fetch('', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data && data.success && data.user_id) {
                            monitorVerifiedCreator = {
                                userId: Number(data.user_id),
                                userName: data.user_name || email,
                                email,
                                password
                            };
                            applyMonitorRoomRules();
                            closeMonitorAuthModal();
                            openMonitorCreateModal();
                        } else if (monitorAuthError) {
                            monitorAuthError.textContent = data?.error || 'Email atau password tidak valid.';
                            monitorAuthError.style.display = 'block';
                        }
                    })
                    .catch(() => {
                        if (monitorAuthError) {
                            monitorAuthError.textContent = 'Gagal memeriksa kredensial user.';
                            monitorAuthError.style.display = 'block';
                        }
                    })
                    .finally(() => {
                        monitorAuthConfirm.disabled = false;
                        monitorAuthConfirm.innerHTML = originalText;
                    });
                });
            }
            if (monitorCreateClose) monitorCreateClose.addEventListener('click', closeMonitorCreateModal);
            if (monitorCreateModal) {
                monitorCreateModal.addEventListener('click', (e) => {
                    if (e.target === monitorCreateModal) closeMonitorCreateModal();
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
                    resetMonitorCreatorVerification();
                }

                if (isFs && monitorCreateBody && createBookingCard) {
                    createBookingCard.classList.add('in-monitor-modal');
                    monitorCreateBody.appendChild(createBookingCard);
                } else if (!isFs && createBookingCardPlaceholder && createBookingCard) {
                    createBookingCard.classList.remove('in-monitor-modal');
                    createBookingCardPlaceholder.insertAdjacentElement('afterend', createBookingCard);
                    closeMonitorCreateModal();
                }

                if (monitorAddBookingBtn) {
                    if (isFs && bookingHeaderActions) {
                        bookingHeaderActions.appendChild(monitorAddBookingBtn);
                    } else {
                        document.body.appendChild(monitorAddBookingBtn);
                    }
                }

                if (isFs) {
                    const tick = () => {
                        if (!monitorClock) return;
                        const now = new Date();
                        const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                        const date = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                        monitorClock.innerHTML = `${time} <span>${date}</span>`;
                    };
                    tick();
                    if (monitorClockTimer) clearInterval(monitorClockTimer);
                    monitorClockTimer = setInterval(tick, 1000);
                    const hasRoomWallpaper = applyMonitorWallpaper(lockedRoomId);
                    if (!hasRoomWallpaper && monitorWallpapers) {
                        const saved = localStorage.getItem('monitor_wallpaper') || 'aurora';
                        const buttons = monitorWallpapers.querySelectorAll('.wallpaper-btn');
                        buttons.forEach(btn => {
                            btn.classList.toggle('active', btn.getAttribute('data-wallpaper') === saved);
                        });
                        document.body.setAttribute('data-wallpaper', saved);
                    }
                } else if (monitorClockTimer) {
                    clearInterval(monitorClockTimer);
                    monitorClockTimer = null;
                }
                if (!isFs) {
                    clearMonitorWallpaper();
                    document.body.removeAttribute('data-wallpaper');
                }

                applyMonitorRoomRules();
            };

            if (monitorWallpapers) {
                const buttons = monitorWallpapers.querySelectorAll('.wallpaper-btn');
                const applyWallpaper = (value) => {
                    if (!isMonitorMode()) return;
                    if (document.body.classList.contains('monitor-wallpaper') && isRoomWallpaperEnabled()) return;
                    document.body.setAttribute('data-wallpaper', value);
                    localStorage.setItem('monitor_wallpaper', value);
                    buttons.forEach(btn => {
                        btn.classList.toggle('active', btn.getAttribute('data-wallpaper') === value);
                    });
                };

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const value = btn.getAttribute('data-wallpaper');
                        if (value) applyWallpaper(value);
                    });
                });

                const saved = localStorage.getItem('monitor_wallpaper') || 'aurora';
                if (isMonitorMode()) {
                    if (!isRoomWallpaperEnabled()) {
                        applyWallpaper(saved);
                    }
                } else {
                    document.body.removeAttribute('data-wallpaper');
                }
            }

            if (toggleRoomWallpaper) {
                const savedToggle = localStorage.getItem('monitor_room_wallpaper_enabled');
                if (savedToggle !== null) {
                    toggleRoomWallpaper.checked = savedToggle === 'true';
                }
                toggleRoomWallpaper.addEventListener('change', () => {
                    localStorage.setItem('monitor_room_wallpaper_enabled', String(toggleRoomWallpaper.checked));
                    if (toggleRoomWallpaper.checked) {
                        const hasRoomWallpaper = applyMonitorWallpaper(lockedRoomId);
                        if (!hasRoomWallpaper) {
                            const saved = localStorage.getItem('monitor_wallpaper') || 'aurora';
                            document.body.setAttribute('data-wallpaper', saved);
                        }
                    } else {
                        clearMonitorWallpaper();
                        const saved = localStorage.getItem('monitor_wallpaper') || 'aurora';
                        document.body.setAttribute('data-wallpaper', saved);
                    }
                });
            }

            monitorToggle.addEventListener('click', () => {
                if (document.fullscreenElement) {
                    openMonitorModal();
                } else {
                    openMonitorRoomModal();
                }
            });

            document.addEventListener('fullscreenchange', updateMonitorState);
        }
    });

    // Pagination functions
    function initializePagination() {
        updatePagination();
    }

    function parseRowDateTime(row) {
        const dateIso = row.getAttribute('data-date') || '';
        const timeCell = row.querySelector('td[data-label="Waktu"]');
        const rangeText = (timeCell?.querySelector('div > div:last-child')?.textContent || '')
            .trim()
            .replace(/\s+/g, ' ');
        const match = rangeText.match(/^(\d{2}:\d{2})\s*-\s*(\d{2}:\d{2})$/);
        if (!dateIso || !match) {
            return { start: null, end: null };
        }

        const start = new Date(`${dateIso}T${match[1]}:00`);
        let end = new Date(`${dateIso}T${match[2]}:00`);
        if (!Number.isFinite(start.getTime()) || !Number.isFinite(end.getTime())) {
            return { start: null, end: null };
        }

        if (end <= start) {
            end = new Date(end.getTime() + 24 * 60 * 60 * 1000);
        }
        return { start, end };
    }

    function sortMonitorRows(rows) {
        const withTime = rows.map(row => {
            const timing = parseRowDateTime(row);
            const status = row.getAttribute('data-status') || '';
            const priority = status === 'ongoing' ? 0 : (status === 'upcoming' ? 1 : 2);
            const startValue = timing.start ? timing.start.getTime() : Number.MAX_SAFE_INTEGER;
            return { row, priority, startValue };
        });

        withTime.sort((a, b) => {
            if (a.priority !== b.priority) return a.priority - b.priority;
            return a.startValue - b.startValue;
        });

        return withTime.map(item => item.row);
    }

    function updatePagination() {
        // Get ALL rows first
        const allRows = document.querySelectorAll('.booking-row');
        const monitorMode = isMonitorMode();
        const now = new Date();
        
        // First, show all rows temporarily to check filter
        allRows.forEach(row => {
            const status = row.getAttribute('data-status');
            const date = row.getAttribute('data-date');
            const roomId = row.getAttribute('data-room-id');
            const today = new Date().toISOString().slice(0, 10);
            
            let show = true;

            if (isMonitorMode() && lockedRoomId) {
                show = roomId === String(lockedRoomId);
            }
            
            switch(currentFilter) {
                case 'upcoming':
                    show = show && status === 'upcoming';
                    break;
                case 'ongoing':
                    show = show && status === 'ongoing';
                    break;
                case 'completed':
                    show = show && status === 'completed';
                    break;
                case 'today':
                    show = show && date === today;
                    break;
                case 'all':
                default:
                    show = show && true;
            }

            // Di mode monitor, booking selesai tidak ditampilkan.
            if (monitorMode) {
                show = show && status !== 'completed';
                const timing = parseRowDateTime(row);
                if (timing.end && now >= timing.end) {
                    show = false;
                }
            }
            
            // Mark rows based on filter (using data attribute)
            row.setAttribute('data-filtered', show ? 'true' : 'false');
        });
        
        // Get visible rows after filter
        const visibleRows = Array.from(allRows).filter(row => row.getAttribute('data-filtered') === 'true');
        const displayRows = monitorMode ? sortMonitorRows(visibleRows) : visibleRows;
        const displaySet = new Set(displayRows);

        allRows.forEach(row => row.classList.remove('monitor-current', 'monitor-next'));
        if (monitorMode) {
            const tbody = document.getElementById('bookingTableBody');
            if (tbody) {
                displayRows.forEach(row => tbody.appendChild(row));
            }

            const ongoingRow = displayRows.find(row => row.getAttribute('data-status') === 'ongoing');
            if (ongoingRow) ongoingRow.classList.add('monitor-current');
            currentPage = 1;
        }

        const totalItems = displayRows.length;
        const totalPages = monitorMode ? (totalItems > 0 ? 1 : 0) : Math.ceil(totalItems / itemsPerPage);
        
        // Update info text
        const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalItems);
        
        document.getElementById('currentStart').textContent = start;
        document.getElementById('currentEnd').textContent = end;
        document.getElementById('totalItems').textContent = totalItems;
        
        // Show/hide rows for current page
        allRows.forEach(row => {
            if (!displaySet.has(row)) {
                row.style.display = 'none';
                return;
            }

            if (monitorMode) {
                row.style.display = '';
            } else {
                // This row passes the filter, now check pagination
                const indexInVisible = displayRows.indexOf(row);
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
        if (monitorMode || totalItems <= itemsPerPage) {
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
        if (isMonitorMode() && filter !== 'today') {
            filter = 'today';
        }
        
        // Update active button
        filterBtns.forEach(btn => btn.classList.remove('active'));
        if (event?.target && event.target.classList.contains('filter-btn')) {
            event.target.classList.add('active');
        } else {
            const todayBtn = Array.from(filterBtns).find(btn => btn.getAttribute('onclick')?.includes(`'${filter}'`));
            if (todayBtn) todayBtn.classList.add('active');
        }
        
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

    // Realtime updates
    let liveTimer = null;
    let isLiveLoading = false;
    const liveIntervalMs = 10000;

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function toggleBookingSections(hasData) {
        const emptyState = document.getElementById('bookingEmptyState');
        const dataSection = document.getElementById('bookingDataSection');
        if (emptyState) emptyState.style.display = hasData ? 'none' : 'block';
        if (dataSection) dataSection.style.display = hasData ? 'block' : 'none';
    }

    function renderBookingRows(bookings) {
        const tbody = document.getElementById('bookingTableBody');
        if (!tbody) return;

        tbody.innerHTML = bookings.map(item => `
            <tr data-status="${escapeHtml(item.status)}" data-date="${escapeHtml(item.date_iso)}" data-room-id="${escapeHtml(item.room_id)}" class="booking-row">
                <td data-label="User & Room">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="user-avatar">${escapeHtml(item.user_initial)}</div>
                        <div>
                            <div style="font-weight: 600; color: var(--ink);">
                                ${escapeHtml(item.user_name)}
                            </div>
                            <div style="font-size: 12px; color: var(--muted); margin-top: 2px;">
                                <span class="room-badge">
                                    <i class="fas fa-door-open"></i>
                                    ${escapeHtml(item.room_name)}
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td data-label="Waktu">
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <div style="font-size: 13px; color: var(--muted);">
                            ${escapeHtml(item.start_date)}
                        </div>
                        <div style="font-weight: 600; color: var(--ink);">
                            ${escapeHtml(item.start_time)} - ${escapeHtml(item.end_time)}
                        </div>
                    </div>
                </td>
                <td data-label="Durasi">
                    <span class="duration-indicator">${escapeHtml(item.duration_text)}</span>
                </td>
                <td data-label="Status">
                    <span class="booking-status ${escapeHtml(item.status_class)}">
                        <i class="fas ${escapeHtml(item.status_icon)}"></i>
                        ${escapeHtml(item.status_text)}
                    </span>
                </td>
                <td data-label="Aksi">
                    <div class="actions">
                        <button class="action-btn view" onclick="viewBooking(${item.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" onclick="editBooking(${item.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" onclick="deleteBooking(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    function refreshLiveBookings() {
        if (isLiveLoading) return;
        const tbody = document.getElementById('bookingTableBody');
        if (!tbody) return;
        if (document.hidden) return;

        isLiveLoading = true;
        fetch('?ajax=live_bookings', { cache: 'no-store' })
            .then(response => response.ok ? response.json() : null)
            .then(data => {
                if (!data || !Array.isArray(data.bookings)) return;
                toggleBookingSections(data.bookings.length > 0);
                renderBookingRows(data.bookings);
                updatePagination();
            })
            .catch(() => {})
            .finally(() => {
                isLiveLoading = false;
            });
    }

    function startLiveUpdates() {
        if (liveTimer) {
            clearInterval(liveTimer);
        }
        refreshLiveBookings();
        liveTimer = setInterval(refreshLiveBookings, liveIntervalMs);
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) refreshLiveBookings();
        });
    }
</script>
</body>
</html>
