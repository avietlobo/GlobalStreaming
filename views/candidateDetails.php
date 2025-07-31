<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Participant Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #000;
            --text-color: #fff;
            --container-bg: #111;
            --highlight: #00ff00;
            --label-color: #ccc;
            --border-color: #333;
            --back-bg: #222;
            --back-hover: #333;
            --button-bg: #00ff00;
            --button-text: #000;
        }

        body.light-mode {
            --bg-color: #f9f9f9;
            --text-color: #111;
            --container-bg: #fff;
            --highlight: #007bff;
            --label-color: #444;
            --border-color: #ddd;
            --back-bg: #f0f0f0;
            --back-hover: #e0e0e0;
            --button-bg: #007bff;
            --button-text: #fff;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2 {
            text-align: center;
            color: var(--highlight);
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
            margin: 30px auto;
            background: var(--container-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        td.label {
            font-weight: bold;
            color: var(--label-color);
            width: 40%;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: var(--highlight);
            padding: 10px 16px;
            background-color: var(--back-bg);
            border-radius: 8px;
            transition: background 0.3s;
        }

        .back-link:hover {
            background-color: var(--back-hover);
        }

        .appointment-button {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: var(--button-bg);
            color: var(--button-text);
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .appointment-button:hover {
            filter: brightness(1.1);
        }

        @media (max-width: 600px) {
            td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            td.label {
                background: var(--back-bg);
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <h2>Participant: <?= htmlspecialchars($participantName ?? '-') ?></h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>

<div class="container">
    <p><strong>Language:</strong> <?= htmlspecialchars($language) ?> |
        <strong>Country:</strong> <?= htmlspecialchars($country) ?></p>

    <?php if (!empty($evangelist)): ?>
        <?php foreach ($evangelist as $row): ?>
            <table>
                <tr><td class="label">Participant Name</td><td><?= htmlspecialchars($row['participantName'] ?? '-') ?></td></tr>
                <tr><td class="label">Record Date</td><td><?= htmlspecialchars($row['recordDate'] ?? '-') ?></td></tr>
                <tr><td class="label">Mobile</td><td><?= htmlspecialchars($row['mobile'] ?? '-') ?></td></tr>
                <tr><td class="label">Evangelist</td><td><?= htmlspecialchars($row['evangelist'] ?? '-') ?></td></tr>
                <tr><td class="label">Source</td><td><?= htmlspecialchars($row['source'] ?? '-') ?></td></tr>
                <tr><td class="label">Alloted Days</td><td><?= htmlspecialchars($row['allotedDays'] ?? '-') ?></td></tr>
                <tr><td class="label">Media Type</td><td><?= htmlspecialchars($row['mediaType'] ?? '-') ?></td></tr>
                <tr><td class="label">Status</td><td><?= htmlspecialchars($row['activeStatus'] ?? '-') ?></td></tr>
                <tr><td class="label">User ID</td><td><?= htmlspecialchars($row['userid'] ?? '-') ?></td></tr>
                <tr><td class="label">Remark</td><td><?= htmlspecialchars($row['remark'] ?? '-') ?></td></tr>
                <tr><td class="label">WhatsApp Group</td><td><?= htmlspecialchars($row['wgroup'] ?? '-') ?></td></tr>
            </table>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No details found for the selected participant.</p>
    <?php endif; ?>
    <a href="/addAppointment"
       class="add-appointment-btn">
        ➕ Add Appointment
    </a>
    <br><br>
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
