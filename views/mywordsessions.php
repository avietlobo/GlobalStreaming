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
        h2 {
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 30px 0 20px 0;
            border-bottom: 3px solid #007bff;
            padding-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 0;
        }

        .logout-link {
            padding: 8px 16px;
            font-size: 0.95rem;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .logout-link:hover {
            background: #0056b3;
        }


    </style>
</head>
<body>
<div class="header">
    <a class="logout-link" href="#" id="logout-link">Logout</a>
</div>
<a class="back-link" href="/evngDashboard1">← Back </a>
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
