<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>⭐ Evangelist Ratings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #111;


            color: #fff;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #222;
        }
        select {
            padding: 5px;
            border-radius: 4px;
            background: #222;
            color: #fff;
            border: 1px solid #444;
        }
        button {
            margin-top: 20px;
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .msg {
            margin-top: 10px;
            font-weight: bold;
        }
        .success { color: #4caf50; }
        .error { color: #ff5555; }
    </style>
</head>
<body>
<h2>⭐ Evangelist Ratings</h2>
<div class="button-group">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
</div>

<?php if (!empty($success)): ?>
    <div class="msg success"><?= htmlspecialchars($success) ?></div>
<?php elseif (!empty($error)): ?>
    <div class="msg error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
    <table>
        <tr>
            <th>Evangelist Name</th>
            <th>Email</th>
            <th>Language</th>
            <th>Rating</th>
        </tr>
        <?php foreach ($evangelistRatings as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['evngName']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['language']) ?></td>
                <td>
                    <select name="ratings[<?= htmlspecialchars($row['email']) ?>|<?= htmlspecialchars($row['language']) ?>]">
                        <option value="">--</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>" <?= ($row['rating'] == $i ? 'selected' : '') ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <button type="submit">💾 Save Ratings</button>
</form>
</body>
</html>
