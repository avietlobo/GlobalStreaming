<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Candidates</title>
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
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding: 20px;
            transition: all 0.3s ease;
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
        }

        .theme-toggle {
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
            color: var(--highlight);
        }

        .lang-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .lang-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--item-bg);
            padding: 14px 18px;
            margin-bottom: 10px;
            border-radius: 6px;
            text-decoration: none;
            color: var(--highlight);
            font-weight: bold;
            transition: background 0.2s;
        }

        .lang-item:hover {
            background-color: var(--item-hover);
        }

        .lang-count {
            background-color: var(--count-bg);
            color: var(--text-color);
            font-size: 14px;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: 10px;
        }

        .lang-arrow {
            color: var(--arrow-color);
            font-size: 18px;
            margin-left: 6px;
        }

        @media (max-width: 600px) {
            .lang-item {
                flex-direction: row;
                padding: 12px 16px;
                font-size: 16px;
            }

            .lang-arrow {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <h2>Candidate List by Language</h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>

<ul class="lang-list">
    <?php foreach ($languages as $lang): ?>
        <li>
            <a class="lang-item" href="/getCandidatesByLanguage?lang=<?= urlencode($lang['language']) ?>">
                <span><?= htmlspecialchars($lang['language']) ?></span>
                <span>
                    <span class="lang-count"><?= $lang['count'] ?></span>
                    <span class="lang-arrow">›</span>
                </span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<a class="back-link" href="/evngDashboard">← Back </a>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    // Set theme on load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        body.classList.add('light-mode');
        toggleBtn.textContent = '🌞';
    }

    // Toggle theme on click
    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        const isLight = body.classList.contains('light-mode');
        toggleBtn.textContent = isLight ? '🌞' : '🌙';
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
    });
</script>

</body>
</html>
