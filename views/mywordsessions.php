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

        /* 🔍 Filter box styling */
        .filter-box {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            justify-content: center;
        }
        .filter-box input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
            width: 200px;
        }
    </style>
</head>
<body>
<div class="header">
    <a class="logout-link" href="#" id="logout-link">Logout</a>
</div>
<a class="back-link" href="/evngDashboard1">← Back </a>
<h2>📘 My Word Sessions</h2>

<!-- 🔍 Search Filters -->
<div class="filter-box">
    <input type="text" id="searchName" placeholder="Search by Name">
    <input type="text" id="searchMobile" placeholder="Search by Mobile">
</div>

<?php if (!empty($sessions)): ?>
    <div id="cardsContainer">
        <?php foreach ($sessions as $c): ?>
            <div class="card"
                 data-name="<?= strtolower(htmlspecialchars($c->name ?? $c->participantName ?? '')) ?>"
                 data-mobile="<?= htmlspecialchars($c->mobile) ?>"
                 onclick="window.location.href='/wordSessionDetail?mobile=<?= urlencode($c->mobile) ?>&language=<?= urlencode($c->language ?? '') ?>&participant=<?= urlencode($c->name ?? $c->participantName ?? 'N/A') ?>'">
                <div class="title">
                    📱 <?= htmlspecialchars($c->mobile) ?> - <?= htmlspecialchars($c->name ?? $c->participantName ?? 'N/A') ?>
                    <span style="font-size: 0.8em; background: #007bff; color: white; border-radius: 4px; padding: 2px 6px; margin-left: 10px;">
                    <?= htmlspecialchars($c->source) ?>
                </span>
                </div>
                <div class="info">🌍 <?= htmlspecialchars($c->city ?? 'Unknown') ?>, <?= htmlspecialchars($c->country ?? 'Unknown') ?></div>
                <div class="info">🗣️ Language: <?= htmlspecialchars($c->language ?? $c->candidateLanguage ?? 'Unknown') ?></div>
                <div class="info">📅 Last Call: <?= htmlspecialchars($c->callDate ?: 'N/A') ?></div>
                <div class="info">📌 Status: <?= htmlspecialchars($c->status ?: 'Unassigned') ?></div>
                <div class="info">📝 Remarks: <?= htmlspecialchars($c->remark ?: 'None') ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No sessions found.</p>
<?php endif; ?>

<script>
    const nameInput = document.getElementById('searchName');
    const mobileInput = document.getElementById('searchMobile');
    const cards = document.querySelectorAll('.card');

    function filterCards() {
        const nameVal = nameInput.value.toLowerCase();
        const mobileVal = mobileInput.value;

        cards.forEach(card => {
            const cardName = card.dataset.name;
            const cardMobile = card.dataset.mobile;

            const matchesName = cardName.includes(nameVal);
            const matchesMobile = cardMobile.includes(mobileVal);

            if ((matchesName || nameVal === "") && (matchesMobile || mobileVal === "")) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    nameInput.addEventListener('input', filterCards);
    mobileInput.addEventListener('input', filterCards);
</script>
</body>
</html>
