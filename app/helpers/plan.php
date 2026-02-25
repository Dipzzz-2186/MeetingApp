<?php

function admin_plan_status(array $user): array
{
    $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

    if (!empty($user['paid_until'])) {
        $paidUntil = new DateTime($user['paid_until'], new DateTimeZone('Asia/Jakarta'));
        if ($paidUntil > $now) {
            return [
                'type' => 'paid',
                'label' => 'Berbayar',
                'days_left' => (int)$now->diff($paidUntil)->format('%a'),
                'until' => $paidUntil->format('d M Y H:i'),
            ];
        }
    }

    if (!empty($user['trial_end'])) {
        $trialUntil = new DateTime($user['trial_end'], new DateTimeZone('Asia/Jakarta'));
        if ($trialUntil > $now) {
            return [
                'type' => 'trial',
                'label' => 'Trial',
                'days_left' => (int)$now->diff($trialUntil)->format('%a'),
                'until' => $trialUntil->format('d M Y H:i'),
            ];
        }
    }

    return [
        'type' => 'expired',
        'label' => 'Tidak Aktif',
        'days_left' => 0,
        'until' => null,
    ];
}
