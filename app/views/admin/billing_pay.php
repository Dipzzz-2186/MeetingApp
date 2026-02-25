<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Payment Gateway</title>
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
            --danger: #ff5757;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at top left, #1a1f28 0%, #101319 55%, #0b0d12 100%);
            min-height: 100vh;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gateway {
            width: 100%;
            max-width: 720px;
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.96) 0%, rgba(22, 27, 36, 0.96) 100%);
            border-radius: 20px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            padding: 28px;
        }

        .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .head h1 {
            font-family: "Fraunces", serif;
            font-size: 28px;
        }

        .badge {
            border-radius: 999px;
            border: 1px solid rgba(87, 255, 117, 0.35);
            background: rgba(87, 255, 117, 0.12);
            color: var(--success);
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
        }

        .box {
            border: 1px solid var(--stroke);
            border-radius: 14px;
            padding: 16px;
            background: rgba(11, 13, 18, 0.62);
            margin-top: 12px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            color: var(--muted);
        }

        .row strong { color: var(--ink); }

        .total {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--stroke);
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .total b {
            font-size: 30px;
            color: var(--accent);
            font-family: "Fraunces", serif;
        }

        .actions {
            margin-top: 18px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .btn {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid var(--stroke);
            font-weight: 700;
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-confirm {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
            border: none;
        }

        .btn-cancel {
            background: rgba(11, 13, 18, 0.7);
            color: var(--danger);
            border-color: rgba(255, 87, 87, 0.35);
        }

        .muted { color: var(--muted); }
    </style>
</head>
<body>
    <div class="gateway">
        <div class="head">
            <h1>Payment Gateway</h1>
            <span class="badge">Secure Checkout</span>
        </div>

        <p class="muted">Selesaikan pembayaran untuk mengaktifkan langganan.</p>

        <div class="box">
            <div class="row"><span>Order ID</span><strong><?php echo htmlspecialchars(substr($token, 0, 12)); ?></strong></div>
            <div class="row"><span>Metode</span><strong><?php echo htmlspecialchars($method_label); ?></strong></div>
            <div class="row"><span>Durasi</span><strong><?php echo (int)$payment['days']; ?> hari</strong></div>
            <div class="total">
                <span>Total Bayar</span>
                <b>Rp<?php echo number_format((int)$payment['amount'], 0, ',', '.'); ?></b>
            </div>
        </div>

        <div class="box">
            <p style="font-size:14px; line-height:1.7;" class="muted">
                Demo mode: klik <strong style="color:#f2f3f5;">Konfirmasi Pembayaran Berhasil</strong> untuk simulasi callback gateway dan aktivasi paket otomatis.
            </p>
        </div>

        <div class="actions">
            <form method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token, ENT_QUOTES); ?>">
                <input type="hidden" name="action" value="cancel">
                <button class="btn btn-cancel" type="submit">Batalkan</button>
            </form>
            <form method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token, ENT_QUOTES); ?>">
                <input type="hidden" name="action" value="confirm">
                <button class="btn btn-confirm" type="submit">
                    <i class="fas fa-check-circle"></i>
                    Konfirmasi Pembayaran Berhasil
                </button>
            </form>
        </div>
    </div>
</body>
</html>
