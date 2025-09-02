<?php
/**
 * views/mylangPref.php
 * Variables expected from controller:
 *  - array $currentLanguages
 *  - string $success
 *  - string $error
 */

$currentLanguages = $currentLanguages ?? [];
$success = $success ?? '';
$error = $error ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Language Preferences</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .box { max-width: 520px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        h4 { margin-top: 0; text-align: center; }
        .languages label { display: block; margin-bottom: 6px; cursor: pointer; }
        .success { padding: 10px; background: #e6f4ea; border: 1px solid #c8ebd2; color: #1f7a39; border-radius: 6px; margin-bottom: 12px; }
        .error { padding: 10px; background: #fdecea; border: 1px solid #f3c2c2; color: #8a1f1f; border-radius: 6px; margin-bottom: 12px; }
        .current { margin-top: 16px; padding: 12px; background: #eef6ff; border-radius: 6px; }
        button { background: #007bff; color: #fff; border: none; padding: 10px 14px; border-radius: 6px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="box">


    <?php if (!empty($success)): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/mylangPref" id="langPrefForm">
        <h4>Select Your Language Preferences</h4>
        <label><input type="checkbox" name="languages[]" value="English"> English</label><br>
        <label><input type="checkbox" name="languages[]" value="Hindi"> Hindi</label><br>
        <label><input type="checkbox" name="languages[]" value="Spanish"> Spanish</label><br>
        <label><input type="checkbox" name="languages[]" value="French"> French</label><br>
        <label><input type="checkbox" name="languages[]" value="German"> German</label><br>

        <button type="submit">Save Preferences</button>
    </form>

    <div class="current" aria-live="polite">
        <?php if (!empty($currentLanguages)): ?>
            <strong>Your current language preferences:</strong>
            <div style="margin-top:6px;"><?= htmlspecialchars(implode(", ", $currentLanguages)) ?></div>
        <?php else: ?>
            <strong>You haven't selected any languages yet.</strong>
            <div style="margin-top:6px;color:#555;">Please select one or more languages above and click <em>Save Preferences</em>.</div>
        <?php endif; ?>
    </div>
</div>

<script>
    (function () {
        const form = document.getElementById('langPrefForm');
        form.addEventListener('submit', function (e) {
            const checked = form.querySelectorAll('input[name="languages[]"]:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Please select at least one language before saving.');
                return false;
            }
        });
    })();
</script>
</body>
</html>
