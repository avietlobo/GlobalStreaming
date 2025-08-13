<!DOCTYPE html>
<html>
<head>
    <title>My Preference</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        h4 { text-align: center; }
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
        button:hover:not(:disabled) {
            background: #0056b3;
        }
        button:disabled {
            background: #6c757d;   /* Grey background */
            color: #e2e2e2;        /* Light grey text */
            cursor: not-allowed;
            font-style: italic;
        }
        .success { color: green; text-align: center; }
        .back-link { display:inline-block; margin-bottom:12px; text-decoration:none; color:#007bff; }
    </style>
</head>
<body>

<a class="back-link" href="/evngDashboard">← Back </a>
<h4>Select Your Evangelization Preference</h4>

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
