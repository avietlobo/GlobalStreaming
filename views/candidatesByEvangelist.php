<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Candidates by <?= htmlspecialchars($evangelist) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #000;
            --text-color: #fff;
            --item-bg: #111;
            --item-hover: #222;
            --count-bg: #666;
            --highlight: #00ff00;
            --arrow-color: #ccc;
        }

        body.light-mode {
            --bg-color: #f9f9f9;

            --text-color: #111;
            --item-bg: #fff;
            --item-hover: #f0f0f0;
            --count-bg: #ddd;
            --highlight: #007bff;
            --arrow-color: #666;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f5;
            color: var(--text-color);
            transition: all 0.3s ease;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 22px;
            color: var(--highlight);
            text-align: center;
            flex-grow: 1;
        }

        .theme-toggle {
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
            color: var(--highlight);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
            width: 100%;
            height: 100%;
        }

        .card {
            background-color: var(--item-bg);
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .card:hover {
            background-color: var(--item-hover);
        }

        .card-title {
            font-weight: bold;
            font-size: 16px;
            color: var(--highlight);
            margin-bottom: 8px;
        }

        .card-subtitle {
            font-size: 14px;
            color: var(--text-color);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            color: var(--highlight);
            font-weight: 500;
            padding: 10px 16px;
            border-radius: 8px;
            background-color: var(--item-bg);
            transition: background 0.3s;
        }

        .back-link:hover {
            background-color: var(--item-hover);
        }

        .no-data {
            padding: 12px;
            background-color: #fff3cd;
            color: #856404;
            border-left: 5px solid #ffa500;
            border-radius: 6px;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 20px;
            }

            .card {
                padding: 12px;
            }

            .back-link {
                font-size: 14px;
                padding: 10px;
            }
        }
        .header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .dashboard-btn {
            background: transparent;
            border: 2px solid #007bff;
            color: #007bff;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .dashboard-btn:hover {
            background-color: #007bff;
            color: #fff;
        }

    </style>
</head>
<body>

<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
    <a href="/viewCandidates" class="dashboard-btn">Go to Dashboard</a>
</div>

<div class="top-bar">
    <h2>Candidates by <?= htmlspecialchars($evangelist) ?> in <?= htmlspecialchars($country) ?> (Language: <?= htmlspecialchars($language) ?>)</h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>

<div class="container">
    <?php if (count($candidates) > 0): ?>
        <div class="card-grid">
            <?php foreach ($candidates as $candidate): ?>
                <div>
                    <a
                        class="card-link"
                        href="/getCandidateDetails?lang=<?= urlencode($language) ?>&country=<?= urlencode($country) ?>&participantName=<?= urlencode($candidate['participantName']) ?>&evangelist=<?= urlencode($evangelist) ?>&mobile=<?= urlencode($mobile) ?>"
                    >
                        <div class="card">
                            <div class="card-title"><?= htmlspecialchars($evangelist) ?></div>
                            <div class="card-subtitle"><?= htmlspecialchars($candidate['participantName'] ?: 'Unnamed') ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-data">No candidates found.</p>
    <?php endif; ?>

    <a class="back-link" href="javascript:history.back()">← Back to Evangelists</a>
</div>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        body.classList.add('light-mode');
        toggleBtn.textContent = '🌞';
    }

    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        const isLight = body.classList.contains('light-mode');
        toggleBtn.textContent = isLight ? '🌞' : '🌙';
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
    });
</script>

</body>
</html>
