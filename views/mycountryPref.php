<?php
/**
 * views/mycountryPref.php
 * Variables expected from controller:
 *  - array $currentCountries
 *  - string $success
 *  - string $error
 */
$currentCountries = $currentCountries ?? [];
$success = $success ?? '';
$error = $error ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Country Preferences</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .box { max-width: 520px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        h4 { margin-top: 0; text-align: center; }
        .countries label { display: block; margin-bottom: 6px; cursor: pointer; }
        .success { padding: 10px; background: #e6f4ea; border: 1px solid #c8ebd2; color: #1f7a39; border-radius: 6px; margin-bottom: 12px; }
        .error { padding: 10px; background: #fdecea; border: 1px solid #f3c2c2; color: #8a1f1f; border-radius: 6px; margin-bottom: 12px; }
        .current { margin-top: 16px; padding: 12px; background: #eef6ff; border-radius: 6px; }
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
        .back-link { display:inline-block; margin-top: 8px; margin-bottom: 20px; text-decoration:none; color:#007bff; font-size: 14px; }
        .logout-link {
            display: inline-block; padding: 6px 14px; font-size: 14px;
            background: #007bff; color: #fff; border-radius: 5px; text-decoration: none;
        }
        .logout-link:hover { background: #0056b3; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; }
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
    <div></div>
    <a class="logout-link" href="#" id="logout-link">Logout</a>
</div>

<a class="back-link" href="/evngDashboard1">← Back</a>

<div class="box">
    <?php if (!empty($success)): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/mycountryPref" id="countryPrefForm">
        <h2>Select Your Country Preferences for Word Sharing</h2>

        <?php
        $allCountries = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia",
            "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium",
            "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria",
            "Burkina Faso", "Burundi", "Côte d\Ivoire", "Cabo Verde", "Cambodia", "Cameroon", "Canada",
            "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo (Congo-Brazzaville)",
            "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia (Czech Republic)", "Democratic Republic of the Congo",
            "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador",
            "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. \"Swaziland\")", "Ethiopia", "Fiji", "Finland",
            "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala",
            "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Holy See", "Honduras", "Hungary", "Iceland", "Special Case 1",
            "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan",
            "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
            "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta",
            "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia",
            "Montenegro", "Morocco", "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru", "Nepal",
            "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway",
            "Oman", "Special Case 2", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru",
            "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda",
            "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino",
            "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore",
            "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain",
            "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania",
            "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
            "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America",
            "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia"
        ];

        foreach ($allCountries as $country): ?>
            <label>
                <input type="checkbox" name="countries[]" value="<?= htmlspecialchars($country) ?>"
                    <?= in_array($country, $currentCountries) ? 'checked' : '' ?>>
                <?= htmlspecialchars($country) ?>
            </label><br>
        <?php endforeach; ?>

        <button type="submit">Save Preferences</button>
    </form>

    <div class="current" aria-live="polite">
        <?php if (!empty($currentCountries)): ?>
            <strong>Your current country preferences:</strong>
            <div style="margin-top:6px;"><?= htmlspecialchars(implode(", ", $currentCountries)) ?></div>
        <?php else: ?>
            <strong>You haven't selected any countries yet.</strong>
            <div style="margin-top:6px;color:#555;">Please select one or more countries above and click <em>Save Preferences</em>.</div>
        <?php endif; ?>
    </div>
</div>

<script>
    (function () {
        const form = document.getElementById('countryPrefForm');
        form.addEventListener('submit', function (e) {
            const checked = form.querySelectorAll('input[name="countries[]"]:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Please select at least one country before saving.');
                return false;
            }
        });
    })();
</script>
</body>
</html>
