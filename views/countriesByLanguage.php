<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Countries for <?= htmlspecialchars($language) ?></title>
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

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 12px;
        }

        .country-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--item-bg);
            padding: 14px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: var(--highlight);
            font-weight: bold;
            transition: background 0.2s;
        }

        .country-link:hover {
            background-color: var(--item-hover);
        }

        .country-count {
            background-color: var(--count-bg);
            color: var(--text-color);
            font-size: 14px;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: 10px;
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

        @media (max-width: 600px) {
            h2 {
                font-size: 20px;
            }

            .country-link {
                font-size: 16px;
                padding: 12px;
            }

            .back-link {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>

<div class="top-bar">
    <h2>Countries for: <?= htmlspecialchars($language) ?></h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>

<div class="container">
    <ul>
        <?php foreach ($countries as $country): ?>
            <li>
                <a class="country-link" href="/getCandidatesByLangAndCountry?lang=<?= urlencode($language) ?>&country=<?= urlencode($country['country']) ?>">
                    <span><?= htmlspecialchars($country['country']) ?></span>
                    <span class="country-count"><?= $country['count'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a class="back-link" href="/viewCandidates">← Back to Languages</a>
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
