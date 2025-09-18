<!DOCTYPE html>
<html>
<head>
    <title>My Preference</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        h4 {
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 30px 0 20px 0;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .pref-form { max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }

        button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        button:hover:not(:disabled) { background: #0056b3; }
        button:disabled {
            background: #6c757d;
            color: #e2e2e2;
            cursor: not-allowed;
            font-style: italic;
        }

        .success { color: green; text-align: center; }

        /* Back button */
        .back-link {
            display:inline-block;
            margin-top: 8px;
            margin-bottom: 20px;
            text-decoration:none;
            color:#007bff;
            font-size: 14px;
        }

        /* Logout button */
        .logout-link {
            display: inline-block;
            padding: 6px 14px;
            font-size: 14px;
            background: #007bff;   /* Red */
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .logout-link:hover { background: #b52a37; }

        /* Top bar layout */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    </style>
</head>
<body>

<div class="top-bar">
    <div></div> <!-- Empty for spacing -->
    <a class="logout-link" href="#" id="logout-link">Logout</a>
</div>

<a class="back-link" href="/evngDashboard1">← Back</a>

<h2>Select Your Evangelization Preference</h2>

<div class="pref-form">
    <?php if (!empty($success ?? null)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <?php $pref = strtoupper(trim($currentPreference ?? '')); ?>

    <form method="POST">
        <button type="submit" name="preference" value="PHONE" <?= $pref === 'PHONE' ? 'disabled' : '' ?>>
            📞 <?= $pref === 'PHONE' ? 'Currently I am a Telecaller' : 'I want to be a Telecaller' ?>
        </button>

        <button type="submit" name="preference" value="SM" <?= $pref === 'SM' ? 'disabled' : '' ?>>
            📱 <?= $pref === 'SM' ? 'Currently I am a Social Media Evangelist' : 'I want to be a Social Media Evangelist' ?>
        </button>

        <button type="submit" name="preference" value="ALL" <?= $pref === 'ALL' ? 'disabled' : '' ?>>
            🌍 <?= $pref === 'ALL' ? 'Currently I do all kinds of Evangelization' : 'I want to do all kinds of Evangelization' ?>
        </button>
    </form>
</div>

</body>
</html>
