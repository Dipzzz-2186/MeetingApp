<div class="page-header">
    <h1 class="page-title">Jadwal Booking</h1>
    <a href="/booking_user" class="btn-booking">+ Booking Ruangan</a>
</div>

<?php if (empty($schedules)): ?>
    <div class="empty-state">
        Belum ada jadwal booking.
    </div>
<?php else: ?>
    <div class="schedule-grid">
        <?php foreach ($schedules as $s): ?>
            <div class="schedule-card">
                <div class="schedule-header">
                    <span class="room"><?= htmlspecialchars($s['room_name']) ?></span>
                    <span class="badge">Booked</span>
                </div>

                <div class="schedule-body">
                    <div class="row">
                        <span class="label">Booked by</span>
                        <span class="value"><?= htmlspecialchars($s['booked_by']) ?></span>
                    </div>
                    <div class="row">
                        <span class="label">Mulai</span>
                        <span class="value"><?= date('d M Y H:i', strtotime($s['start_time'])) ?></span>
                    </div>
                    <div class="row">
                        <span class="label">Selesai</span>
                        <span class="value"><?= date('d M Y H:i', strtotime($s['end_time'])) ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<style>
    /* ===== Page Header ===== */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        gap: 12px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #f1f5ff;
    }

    /* ===== CTA Button ===== */
    .btn-booking {
        background: linear-gradient(135deg, #1f67ff, #0d6efd);
        color: #fff;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 10px 24px rgba(13,110,253,.35);
        transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
    }

    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(13,110,253,.45);
        opacity: .95;
    }

    /* ===== Empty State ===== */
    .empty-state {
        padding: 26px;
        border-radius: 18px;
        background: rgba(255,255,255,0.08);
        color: #c7d2ff;
        text-align: center;
        font-weight: 500;
        backdrop-filter: blur(6px);
    }

    /* ===== Schedule Grid ===== */
    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    /* ===== Card ===== */
    .schedule-card {
        background: rgba(255,255,255,0.92);
        border-radius: 18px;
        padding: 18px;
        box-shadow: 
            0 20px 40px rgba(0,0,0,.25),
            inset 0 0 0 1px rgba(255,255,255,.4);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .schedule-card:hover {
        transform: translateY(-4px);
        box-shadow: 
            0 26px 56px rgba(0,0,0,.35),
            inset 0 0 0 1px rgba(255,255,255,.55);
    }

    /* ===== Card Header ===== */
    .schedule-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .schedule-header .room {
        font-weight: 700;
        font-size: 16px;
        color: #0b1220;
    }

    /* ===== Badge ===== */
    .schedule-header .badge {
        background: linear-gradient(135deg, #1f67ff, #0d6efd);
        color: #fff;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ===== Card Body ===== */
    .schedule-body .row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .schedule-body .label {
        font-size: 13px;
        color: #6b7280;
    }

    .schedule-body .value {
        font-size: 14px;
        font-weight: 600;
        color: #0b1220;
    }
</style>