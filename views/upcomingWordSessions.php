<?php /** @var array|\stdClass[]|WordSessionModel[] $sessions */ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Upcoming Word Sessions</title>

    <style>
        :root{
            --bg:#f6f8fb;
            --card:#ffffff;
            --muted:#6b7280;
            --text:#0f172a;
            --accent:#2563eb;
            --radius:10px;
            --shadow:0 8px 20px rgba(12,20,40,0.06);
            --max-width:980px;
        }

        /* Base */
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            background:var(--bg);
            color:var(--text);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            padding:14px;
            display:flex;
            justify-content:center;
        }
        .container { width:100%; max-width:var(--max-width); }

        /* Top area */
        .top {
            display:flex;
            gap:10px;
            align-items:center;
            margin-bottom:12px;
        }
        .btn {
            padding:8px 10px;
            border-radius:8px;
            background:var(--card);
            border:1px solid rgba(15,23,42,0.05);
            font-weight:600;
            text-decoration:none;
            color:var(--text);
            font-size:13px;
        }
        .counter {
            margin-left:auto;
            display:flex;
            gap:8px;
            align-items:center;
            font-size:13px;
            font-weight:700;         /* MAKE TEXT BOLD */
            color:#1f2937;           /* DARKER GRAY FOR REAL BOLD LOOK */
        }

        .badge {
            background:linear-gradient(180deg,#e6f0ff,#dbe9ff);
            color:#1b4fc4;               /* darker blue for stronger bold */
            padding:6px 12px;
            border-radius:999px;
            font-weight:800;             /* EXTRA BOLD COUNT */
            font-size:14px;              /* slightly larger for visibility */
            border:2px solid #1b4fc4;    /* stronger border to match bold text */
        }


        /* Table wrapper */
        .table-wrap {
            background:var(--card);
            border-radius:var(--radius);
            padding:0;
            box-shadow:var(--shadow);
            overflow:auto;
            border:1px solid rgba(15,23,42,0.04);
        }

        /* Table styles */
        table.resp-table {
            width:100%;
            border-collapse:collapse;
            min-width:800px;
        }
        .resp-table thead th {
            text-align:left;
            padding:12px 14px;
            font-size:13px;
            color:var(--muted);
            font-weight:700 !important;     /* ← added bold */
            border-bottom:1px solid rgba(15,23,42,0.06);
            background:linear-gradient(180deg,#fff,#fbfdff);
            position:sticky;
            top:0;
            z-index:2;
        }
        .resp-table tbody td {
            padding:12px 14px;
            border-bottom:1px solid rgba(15,23,42,0.03);
            font-size:14px;
            vertical-align:top;
            white-space:normal;
            word-break:break-word;
        }

        /* status pill */
        .pill { padding:6px 10px; border-radius:999px; font-weight:700; font-size:13px; display:inline-block; }
        .pill.pending { background:#fff7ed; color:#b45309; border:1px solid rgba(180,83,9,0.08); }
        .pill.confirmed { background:#ecfdf5; color:#047857; border:1px solid rgba(4,120,87,0.06); }
        .pill.cancel { background:#fff1f2; color:#be123c; border:1px solid rgba(190,18,60,0.06); }

        /* Highlight future scheduled rows */
        .future-scheduled {
            background: linear-gradient(180deg,#eef6ff,#eef6ff) !important;
            border: 2px solid #2b6ce0 !important;
            box-shadow: 0 10px 28px rgba(43,108,224,0.08) !important;
        }
        .future-scheduled .pill {
            background:#dbe7ff !important;
            color:#1b4fc4 !important;
            border:1px solid #1b4fc4 !important;
        }

        /* MOBILE CARD VIEW - improved label/value stacking for wrapping */
        @media (max-width:860px) {
            .resp-table { min-width:100%; }
            .resp-table thead { display:none; }

            .resp-table, .resp-table tbody, .resp-table tr, .resp-table td {
                display:block;
                width:100%;
            }

            .resp-table tr {
                margin-bottom:20px; /* gap between cards */
                background:var(--card);
                border-radius:12px;
                box-shadow:0 12px 25px rgba(0,0,0,0.06);
                border:1px solid rgba(15,23,42,0.08);
                padding:14px;
            }

            /* If a row is future-scheduled, ensure its mobile card uses the stronger border/background */
            .resp-table tr.future-scheduled {
                background: linear-gradient(180deg,#eef6ff,#eef6ff) !important;
                border:2px solid #2b6ce0 !important;
                box-shadow:0 12px 30px rgba(43,108,224,0.09) !important;
            }

            /* make each label appear above the value (stacked) */
            .resp-table td {
                padding:6px 6px;
                border-bottom:0;
                font-size:14px;
            }

            .resp-table td[data-label]:before {
                content: attr(data-label);
                display:block;
                font-weight:700;
                color:#1f2937 !important;   /* DARK TEXT */
                font-size:14px;
                margin-bottom:6px;
                text-transform:none;
                white-space:normal;
            }


            /* Values should wrap naturally */
            .resp-table td[data-label] > * {
                white-space:normal;
                word-break:break-word;
            }

            /* make status pill left-aligned and not force layout */
            .resp-table td .pill {
                display:inline-block;
                margin-top:0;
            }
        }

        /* Extra small phones */
        @media (max-width:420px) {
            .resp-table td[data-label]:before { font-size:13px; margin-bottom:4px; }
            .resp-table td { padding:8px 6px; font-size:13px; }
            .btn { padding:6px 8px; font-size:12px; }
        }

        /* Empty state */
        .empty {
            padding:20px;
            border-radius:10px;
            background:var(--card);
            border:1px solid rgba(15,23,42,0.03);
            color:var(--muted);
            text-align:center;
            box-shadow:var(--shadow);
        }
    </style>
</head>

<body>
<div class="container" role="main">

    <?php
    // compute scheduled-only count (case-insensitive)
    $scheduledCount = 0;
    if (!empty($sessions) && is_array($sessions)) {
        foreach ($sessions as $ss) {
            $st = is_array($ss)
                ? ($ss['status'] ?? $ss['activeStatus'] ?? '')
                : ($ss->status ?? $ss->activeStatus ?? '');
            if (is_string($st) && strtolower(trim($st)) === 'scheduled') $scheduledCount++;
        }
    }
    ?>

    <div class="top">

            <a class="logout-link" href="#" id="logout-link">Logout</a>


        <div class="counter">
            Assigned to you (Scheduled)
            <span class="badge"><?= (int)$scheduledCount ?></span>
        </div>
    </div>

    <a href="/evngDashboard1" style="display:inline-block; color:var(--accent); font-weight:600; margin-bottom:10px; text-decoration:none;">← Back to Dashboard</a>

    <?php if (empty($sessions)): ?>
        <div class="empty">
            <strong>No Word Sessions Found.</strong>
            <div style="margin-top:8px;">There are no sessions assigned to you yet.</div>
        </div>
    <?php else: ?>

        <div class="table-wrap" role="region" aria-label="Upcoming sessions table">
            <table class="resp-table" role="table" aria-describedby="scheduledCount">
                <thead>
                <tr>
                    <th>Session</th>
                    <th>Date</th>
                    <th>Participant</th>
                    <th>Mobile</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $todayTs = strtotime(date('Y-m-d'));
                foreach ($sessions as $s):
                    if (is_array($s)) {
                        $sessionName = $s['session_name'] ?? $s['name'] ?? '';
                        $sessionDate = $s['session_date'] ?? $s['callDate'] ?? null;
                        $participant = $s['participant'] ?? $s['participantName'] ?? ($s['name'] ?? '');
                        $mobile = $s['mobile'] ?? $s['phone'] ?? '';
                        $language = $s['language'] ?? $s['candidateLanguage'] ?? '';
                        $status = $s['status'] ?? $s['activeStatus'] ?? '';
                        $remark = $s['remark'] ?? '';
                    } else {
                        $sessionName = $s->session_name ?? ($s->name ?? '');
                        $sessionDate = $s->session_date ?? ($s->callDate ?? null);
                        $participant = $s->participant ?? ($s->participantName ?? ($s->name ?? ''));
                        $mobile = $s->mobile ?? ($s->phone ?? '');
                        $language = $s->language ?? ($s->candidateLanguage ?? '');
                        $status = $s->status ?? ($s->activeStatus ?? '');
                        $remark = $s->remark ?? '';
                    }

                    // Format date safely
                    $displayDate = '—';
                    $sessionTs = null;
                    if (!empty($sessionDate)) {
                        $ts = strtotime($sessionDate);
                        if ($ts !== false) {
                            $displayDate = date('d-M-Y', $ts);
                            $sessionTs = strtotime(date('Y-m-d', $ts));
                        } else {
                            $displayDate = htmlspecialchars($sessionDate);
                        }
                    }

                    $st = strtolower(trim((string)$status));
                    $stClass = $st === 'confirmed' ? 'confirmed' : ($st === 'pending' ? 'pending' : 'cancel');

                    // Determine if this row is a future scheduled session (highlight it)
                    $isFutureScheduled = ($st === 'scheduled' && ($sessionTs !== null) && ($sessionTs >= $todayTs));
                    $rowClass = $isFutureScheduled ? 'future-scheduled' : '';
                    ?>
                    <tr class="<?= $rowClass ?>">
                        <td data-label="Session"><?= htmlspecialchars($sessionName ?: '—') ?></td>
                        <td data-label="Date"><?= $displayDate ?></td>
                        <td data-label="Participant"><?= htmlspecialchars($participant ?: '—') ?></td>
                        <td data-label="Mobile"><?= htmlspecialchars($mobile ?: '—') ?></td>
                        <td data-label="Language"><?= htmlspecialchars($language ?: '—') ?></td>
                        <td data-label="Status"><span class="pill <?= $stClass ?>"><?= htmlspecialchars($status ?: '—') ?></span></td>
                        <td data-label="Remark"><?= htmlspecialchars($remark ?: '') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</div>
</body>
</html>
