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
            color: var(--text-color);
            padding: 20px;
            transition: all 0.3s ease;
            background: #f4f4f5;
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

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
        }

        .logout-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .logout-button:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .logout-button:active {
            transform: scale(0.98);
        }

        .back-link {
            display: inline-block;
            margin: 10px 20px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #0056b3;
        }

        .top-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-bottom: 25px;
            padding: 10px 0;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--highlight);
            text-align: center;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 0;
        }

        .theme-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
            color: var(--highlight);
            transition: transform 0.2s ease, color 0.3s ease;
        }

        .theme-toggle:hover {
            transform: translateY(-50%) scale(1.1);
            color: #00ccff;
        }
    </style>
</head>
<body>

<div class="header">
    <button type="button" id="logout-link" class="logout-button" onclick="window.location.href='/logout'">
        Logout
    </button>
</div>

<a class="back-link" href="/evngDashboard1">← Back </a>

<div class="top-bar">
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
    <h2 class="page-title">Language Dashboard</h2>
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
    // ALWAYS force light mode
    document.body.classList.add('light-mode');

    // Remove any previously saved theme
    localStorage.removeItem('theme');

    // Disable toggle button completely
    const toggleBtn = document.getElementById('themeToggle');
    if (toggleBtn) {
        toggleBtn.style.pointerEvents = "none";  // click disabled
        toggleBtn.style.opacity = "0.4";         // visually disabled
        toggleBtn.title = "Theme is locked to Light Mode";
        toggleBtn.textContent = "🌞";            // show light icon always
    }
</script>


</body>
</html>
