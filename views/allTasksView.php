<?php
// allTasksView.php

function isActedUpon($status) {
    if ($status === null) return false;
    $s = strtolower(trim((string)$status));
    return !in_array($s, ['unassigned', 'assigned'], true);
}

// Group tasks by assignedTo
$grouped = [];
foreach ($tasks as $t) {
    $assignee = trim((string)($t['assignedTo'] ?? 'Unassigned'));
    if ($assignee === '') $assignee = 'Unassigned';
    $grouped[$assignee][] = $t;
}

// For each assignee compute counts and whether they have any Malayalam tasks
$summary = []; // assignee => ['total'=>int,'acted'=>int,'notStarted'=>int,'hasMalayalam'=>bool]
foreach ($grouped as $assignee => $list) {
    $total = count($list);
    $acted = 0;
    $notStarted = 0;
    $hasMalayalam = false;

    foreach ($list as $row) {
        // language check (case-insensitive)
        $lang = strtolower(trim((string)($row['language'] ?? '')));
        if ($lang === 'malayalam') $hasMalayalam = true;

        if (isActedUpon($row['status'])) $acted++;
        else $notStarted++;
    }

    $summary[$assignee] = [
        'total' => $total,
        'acted' => $acted,
        'notStarted' => $notStarted,
        'hasMalayalam' => $hasMalayalam,
    ];
}

// Separate assignees into two lists: non-Malayalam first, Malayalam at bottom
$nonMalay = [];
$withMalay = [];
foreach ($summary as $assignee => $data) {
    if ($data['hasMalayalam']) $withMalay[$assignee] = $data;
    else $nonMalay[$assignee] = $data;
}

// Sort both lists alphabetically by assignee name (Unassigned last within each group)
$sortFn = function($a, $b) {
    if ($a === 'Unassigned') return 1;
    if ($b === 'Unassigned') return -1;
    return strcasecmp($a, $b);
};
uksort($nonMalay, $sortFn);
uksort($withMalay, $sortFn);

// Final ordered list: nonMalay first, then withMalay
$ordered = array_merge($nonMalay, $withMalay);
?>

<style>
    .container { max-width:800px; margin:20px auto; font-family:system-ui, -apple-system, "Segoe UI", Roboto, Arial; }
    .assignee-card {
        background:#fff;
        padding:14px;
        border-radius:10px;
        margin-bottom:12px;
        box-shadow:0 2px 8px rgba(0,0,0,0.06);
        display:flex;
        justify-content:space-between;
        align-items:center;
    }
    .assignee-left { display:flex; flex-direction:column; }
    .assignee-title {
        font-weight:700;
        font-size:16px;
        margin-bottom:6px;
    }
    .stat-line { font-size:15px; }
    .pill {
        display:inline-block;
        padding:6px 10px;
        border-radius:999px;
        background:#f3f4f6;
        margin-left:8px;
        font-weight:600;
        font-size:14px;
    }
    .malayalam-badge { font-size:13px; color:#fff; background:#111827; padding:4px 8px; border-radius:999px; margin-left:8px; }
</style>

<a class="back-link" href="/evngDashboard1">← Back</a>

<div class="container">
    <div style="margin-bottom:15px;">
<!--        <a href="/exportTelecallerReport?type=excel"-->
<!--           style="padding:8px 14px;background:#16a34a;color:white;border-radius:6px;text-decoration:none;margin-right:8px;">-->
<!--            ⬇ Export Excel-->
<!--        </a>-->

        <a href="/exportTelecallerReport?type=pdf"
           style="padding:8px 14px;background:#dc2626;color:white;border-radius:6px;text-decoration:none;">
            ⬇ Export PDF
        </a>
    </div>

    <h2>📋 Task Summary</h2>

    <?php if (empty($ordered)): ?>
        <div class="assignee-card">
            <div class="assignee-left">
                <div class="assignee-title">No assignees found</div>
                <div class="stat-line">There are no tasks to display.</div>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($ordered as $assignee => $data): ?>
            <div class="assignee-card">
                <div class="assignee-left">
                    <div class="assignee-title">
                        👤 <?= htmlspecialchars($assignee) ?>
                        <?php if ($data['hasMalayalam']): ?>
                            <span class="malayalam-badge">Malayalam</span>
                        <?php endif; ?>
                    </div>
                    <div class="stat-line">
                        <span class="pill">Total: <?= (int)$data['total'] ?></span>
                        <span class="pill">✅ Acted: <?= (int)$data['acted'] ?></span>
                        <span class="pill">⏳ Not Started: <?= (int)$data['notStarted'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
