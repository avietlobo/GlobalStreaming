<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📋 My Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #f2f4f7;
            --card-bg: #ffffff;
            --text-color: #14171a;
            --accent-color: #1DA1F2;
            --hover-bg: #f0f8ff;
        }

        body.dark-mode {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #e1e1e1;
            --accent-color: #1DA1F2;
            --hover-bg: #1a1a1a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-color);
            padding: 10px;
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            padding: 12px 0;
            color: var(--accent-color);
            border-bottom: 1px solid #ddd;
        }

        .toggle-container {
            text-align: right;
            margin: 10px;
        }

        .dark-toggle {
            padding: 6px 12px;
            background-color: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .dark-toggle:hover {
            background-color: #1681c2;
        }

        .task-card {
            display: block;
            background-color: var(--card-bg);
            border-radius: 12px;
            margin: 10px 0;
            padding: 14px 18px;
            text-decoration: none;
            color: var(--text-color);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: background 0.2s, transform 0.1s;
        }

        .task-card:hover {
            background-color: var(--hover-bg);
            transform: scale(0.99);
        }

        .task-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--accent-color);
        }

        .task-country {
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .task-card {
                padding: 12px 14px;
                border-radius: 10px;
            }

            .task-name {
                font-size: 15px;
            }

            .task-country {
                font-size: 13px;
            }

            h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="toggle-container">
    <button class="dark-toggle" onclick="toggleDarkMode()">🌙 Toggle Mode</button>
</div>

<h2>📋 My Assigned Tasks</h2>

<?php foreach ($tasks as $task): ?>
    <a href="/viewTaskDetails?mobile=<?= urlencode($task['mobile']) ?>" class="task-card">
        <div class="task-name">👤 <?= htmlspecialchars($task['name']) ?></div>
        <div class="task-country">🏳️ <?= htmlspecialchars($task['country']) ?></div>
    </a>
<?php endforeach; ?>

<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    }

    // On load, apply user's last preference
    document.addEventListener('DOMContentLoaded', function () {
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    });
</script>

</body>
</html>
