<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📘 My Word Sessions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f0f4f8;
            padding: 1em;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 1em;
            margin-bottom: 1em;
            transition: 0.2s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .title {
            font-size: 1.1em;
            font-weight: bold;
        }
        .info {
            margin: 0.3em 0;
        }
        @media (max-width: 600px) {
            .card {
                font-size: 0.95em;
            }
        }
    </style>
</head>
<body>

<h2>📘 My Word Sessions</h2>

<?php if (!empty($sessions)): ?>
    <?php foreach ($sessions as $c): ?>
        <div class="card" onclick="window.location.href='/wordSessionDetail?mobile=<?= urlencode($c->mobile ) ?>&language=<?= urlencode($c->language ) ?>&participant=<?= urlencode($c->name ) ?>'">
            <div class="title">📱 <?= htmlspecialchars($c->mobile) ?> - <?= htmlspecialchars($c->name) ?></div>
            <div class="info">🌍 <?= htmlspecialchars($c->city) ?>, <?= htmlspecialchars($c->country) ?></div>
            <div class="info">🗣️ Language: <?= htmlspecialchars($c->language) ?></div>
            <div class="info">📅 Last Call: <?= htmlspecialchars($c->callDate ?: 'N/A') ?></div>
            <div class="info">📌 Status: <?= htmlspecialchars($c->status ?: 'Unassigned') ?></div>
            <div class="info">📝 Remarks: <?= htmlspecialchars($c->remarks ?: 'None') ?></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No sessions found.</p>
<?php endif; ?>

</body>
</html>
