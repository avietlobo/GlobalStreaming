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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 30px 0 20px 0;
            border-bottom: 3px solid #007bff;
            padding-bottom: 12px;
            letter-spacing: 0.5px;
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
            border-radius: 14px;
            margin: 12px 0;
            padding: 16px 20px;
            text-decoration: none;
            color: var(--text-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            border-left: 5px solid transparent; /* accent stripe */
        }

        .task-card:hover {
            background-color: var(--hover-bg);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
        }

        /* Stronger typography hierarchy */
        .task-mobile {
            font-size: 14px;
            color: #666;
            margin-bottom: 4px;
        }

        .task-name {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--accent-color);
        }

        .task-country {
            font-size: 14px;
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }

        .task-country img {
            height: 16px;
            margin-right: 6px;
            border-radius: 3px;
        }

        .task-status {
            font-size: 14px;
            font-weight: 500;
            margin-top: 8px;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
            background: rgba(0,0,0,0.05);
        }

        /* Optional: color-coded left border by status */
        .task-card[data-status="positive"] { border-left-color: #28a745; }
        .task-card[data-status="negative"] { border-left-color: #dc3545; }
        .task-card[data-status="neutral"]  { border-left-color: #6c757d; }
        .task-card[data-status="no response"] { border-left-color: #fd7e14; }
        .task-card[data-status="unassigned"]  { border-left-color: #999; }


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

        .flag-wrapper {
            display: inline-flex;
            align-items: center;
            margin-right: 6px;
            position: relative;
        }

        .flag-pole {
            width: 2px;
            height: 16px;
            background-color: green;
            margin-right: 3px;
        }

        .flag-body {
            width: 16px;
            height: 12px;
            background-color: green;
            clip-path: polygon(0 0, 100% 25%, 100% 75%, 0% 100%);
            border-radius: 2px 0 0 2px;
            position: relative;
            top: -1px;
        }
        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 0;
        }
        .logout-link {
            padding: 8px 16px;
            font-size: 0.95rem;
            background: var(--accent-color);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-link:hover {
            background-color: #1681c2;
        }
    </style>
</head>
<body>

<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>

<!--<div class="toggle-container">-->
<!--    <button class="dark-toggle" onclick="toggleDarkMode()">🌙 Toggle Mode</button>-->
<!--</div>-->

<a class="back-link" href="/evngDashboard1">← Back </a>

<h2>✅ My Assigned Tasks</h2>
<?php
function getCountryCode($countryName) {
    $map = [
        'Afghanistan' => 'af',
        'Albania' => 'al',
        'Algeria' => 'dz',
        'Andorra' => 'ad',
        'Angola' => 'ao',
        'Antigua and Barbuda' => 'ag',
        'Argentina' => 'ar',
        'Armenia' => 'am',
        'Australia' => 'au',
        'Austria' => 'at',
        'Azerbaijan' => 'az',
        'Bahamas' => 'bs',
        'Bahrain' => 'bh',
        'Bangladesh' => 'bd',
        'Barbados' => 'bb',
        'Belarus' => 'by',
        'Belgium' => 'be',
        'Belize' => 'bz',
        'Benin' => 'bj',
        'Bhutan' => 'bt',
        'Bolivia' => 'bo',
        'Bosnia and Herzegovina' => 'ba',
        'Botswana' => 'bw',
        'Brazil' => 'br',
        'Brunei' => 'bn',
        'Bulgaria' => 'bg',
        'Burkina Faso' => 'bf',
        'Burundi' => 'bi',
        'Cabo Verde' => 'cv',
        'Cambodia' => 'kh',
        'Cameroon' => 'cm',
        'Canada' => 'ca',
        'Central African Republic' => 'cf',
        'Chad' => 'td',
        'Chile' => 'cl',
        'China' => 'cn',
        'Colombia' => 'co',
        'Comoros' => 'km',
        'Congo (Brazzaville)' => 'cg',
        'Congo (Kinshasa)' => 'cd',
        'Costa Rica' => 'cr',
        'Croatia' => 'hr',
        'Cuba' => 'cu',
        'Cyprus' => 'cy',
        'Czech Republic' => 'cz',
        'Denmark' => 'dk',
        'Djibouti' => 'dj',
        'Dominica' => 'dm',
        'Dominican Republic' => 'do',
        'Ecuador' => 'ec',
        'Egypt' => 'eg',
        'El Salvador' => 'sv',
        'Equatorial Guinea' => 'gq',
        'Eritrea' => 'er',
        'Estonia' => 'ee',
        'Eswatini' => 'sz',
        'Ethiopia' => 'et',
        'Fiji' => 'fj',
        'Finland' => 'fi',
        'France' => 'fr',
        'Gabon' => 'ga',
        'Gambia' => 'gm',
        'Georgia' => 'ge',
        'Germany' => 'de',
        'Ghana' => 'gh',
        'Greece' => 'gr',
        'Grenada' => 'gd',
        'Guatemala' => 'gt',
        'Guinea' => 'gn',
        'Guinea-Bissau' => 'gw',
        'Guyana' => 'gy',
        'Haiti' => 'ht',
        'Honduras' => 'hn',
        'Hungary' => 'hu',
        'Iceland' => 'is',
        'India' => 'in',
        'Indonesia' => 'id',
        'Iran' => 'ir',
        'Iraq' => 'iq',
        'Ireland' => 'ie',
        'Israel' => 'il',
        'Italy' => 'it',
        'Ivory Coast' => 'ci',
        'Jamaica' => 'jm',
        'Japan' => 'jp',
        'Jordan' => 'jo',
        'Kazakhstan' => 'kz',
        'Kenya' => 'ke',
        'Kiribati' => 'ki',
        'Kuwait' => 'kw',
        'Kyrgyzstan' => 'kg',
        'Laos' => 'la',
        'Latvia' => 'lv',
        'Lebanon' => 'lb',
        'Lesotho' => 'ls',
        'Liberia' => 'lr',
        'Libya' => 'ly',
        'Liechtenstein' => 'li',
        'Lithuania' => 'lt',
        'Luxembourg' => 'lu',
        'Madagascar' => 'mg',
        'Malawi' => 'mw',
        'Malaysia' => 'my',
        'Maldives' => 'mv',
        'Mali' => 'ml',
        'Malta' => 'mt',
        'Marshall Islands' => 'mh',
        'Mauritania' => 'mr',
        'Mauritius' => 'mu',
        'Mexico' => 'mx',
        'Micronesia' => 'fm',
        'Moldova' => 'md',
        'Monaco' => 'mc',
        'Mongolia' => 'mn',
        'Montenegro' => 'me',
        'Morocco' => 'ma',
        'Mozambique' => 'mz',
        'Myanmar' => 'mm',
        'Namibia' => 'na',
        'Nauru' => 'nr',
        'Nepal' => 'np',
        'Netherlands' => 'nl',
        'New Zealand' => 'nz',
        'Nicaragua' => 'ni',
        'Niger' => 'ne',
        'Nigeria' => 'ng',
        'North Korea' => 'kp',
        'North Macedonia' => 'mk',
        'Norway' => 'no',
        'Oman' => 'om',
        'Pakistan' => 'pk',
        'Palau' => 'pw',
        'Palestine' => 'ps',
        'Panama' => 'pa',
        'Papua New Guinea' => 'pg',
        'Paraguay' => 'py',
        'Peru' => 'pe',
        'Philippines' => 'ph',
        'Poland' => 'pl',
        'Portugal' => 'pt',
        'Qatar' => 'qa',
        'Romania' => 'ro',
        'Russia' => 'ru',
        'Rwanda' => 'rw',
        'Saint Kitts and Nevis' => 'kn',
        'Saint Lucia' => 'lc',
        'Saint Vincent and the Grenadines' => 'vc',
        'Samoa' => 'ws',
        'San Marino' => 'sm',
        'Sao Tome and Principe' => 'st',
        'Saudi Arabia' => 'sa',
        'Senegal' => 'sn',
        'Serbia' => 'rs',
        'Seychelles' => 'sc',
        'Sierra Leone' => 'sl',
        'Singapore' => 'sg',
        'Slovakia' => 'sk',
        'Slovenia' => 'si',
        'Solomon Islands' => 'sb',
        'Somalia' => 'so',
        'South Africa' => 'za',
        'South Korea' => 'kr',
        'South Sudan' => 'ss',
        'Spain' => 'es',
        'Sri Lanka' => 'lk',
        'Sudan' => 'sd',
        'Suriname' => 'sr',
        'Sweden' => 'se',
        'Switzerland' => 'ch',
        'Syria' => 'sy',
        'Taiwan' => 'tw',
        'Tajikistan' => 'tj',
        'Tanzania' => 'tz',
        'Thailand' => 'th',
        'Timor-Leste' => 'tl',
        'Togo' => 'tg',
        'Tonga' => 'to',
        'Trinidad and Tobago' => 'tt',
        'Tunisia' => 'tn',
        'Turkey' => 'tr',
        'Turkmenistan' => 'tm',
        'Tuvalu' => 'tv',
        'Uganda' => 'ug',
        'Ukraine' => 'ua',
        'United Arab Emirates' => 'ae',
        'United Kingdom' => 'gb',
        'United States' => 'us',
        'Uruguay' => 'uy',
        'Uzbekistan' => 'uz',
        'Vanuatu' => 'vu',
        'Vatican City' => 'va',
        'Venezuela' => 've',
        'Vietnam' => 'vn',
        'Yemen' => 'ye',
        'Zambia' => 'zm',
        'Zimbabwe' => 'zw'
    ];

    return $map[$countryName] ?? '';
}
?>

<form method="GET" style="margin: 10px 0; display: flex; flex-wrap: wrap; gap: 10px;">

    <input type="text" name="name" placeholder="🔍 Search Name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" style="padding: 6px; border-radius: 6px; border: 1px solid #ccc;">

    <select name="status" style="padding: 6px; border-radius: 6px;">
        <option value="">All Status</option>
        <option value="Assigned" <?= ($_GET['status'] ?? '') === 'Assigned' ? 'selected' : '' ?>>Assigned</option>
        <option value="Positive" <?= ($_GET['status'] ?? '') === 'Positive' ? 'selected' : '' ?>>Positive</option>
        <option value="Neutral" <?= ($_GET['status'] ?? '') === 'Neutral' ? 'selected' : '' ?>>Neutral</option>
        <option value="Awaiting Response" <?= ($_GET['status'] ?? '') === 'Awaiting Response' ? 'selected' : '' ?>>Awaiting Response</option>
        <option value="No Response" <?= ($_GET['status'] ?? '') === 'No Response' ? 'selected' : '' ?>>No Response</option>
        <option value="Negative" <?= ($_GET['status'] ?? '') === 'Negative' ? 'selected' : '' ?>>Negative</option>

    </select>

    <select name="country" style="padding: 6px; border-radius: 6px;">
        <option value="">All Countries</option>
        <?php
        $countries = array_unique(array_filter(array_map(fn($t) => trim($t['country']), $tasks)));
        sort($countries);

        foreach ($countries as $c):
            ?>
            <option value="<?= htmlspecialchars($c) ?>" <?= ($_GET['country'] ?? '') === $c ? 'selected' : '' ?>>
                <?= htmlspecialchars($c) ?>
            </option>
        <?php endforeach; ?>





    </select>

<!--    <button type="submit" style="padding: 6px 12px; background: var(--accent-color); color: white; border: none; border-radius: 6px;">Filter</button>-->

    <!-- Source -->
    <select name="source" style="padding: 6px; border-radius: 6px;">
        <option value="">All Sources</option>

        <?php
        $sources = array_unique(
            array_filter(
                array_map(fn($t) => trim($t['source'] ?? ''), $tasks)
            )
        );
        sort($sources);

        foreach ($sources as $source):
            ?>
            <option
                    value="<?= htmlspecialchars($source) ?>"
                <?= ($_GET['source'] ?? '') === $source ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($source) ?>
            </option>
        <?php endforeach; ?>
    </select>


</form>

<?php
$nameFilter = strtolower($_GET['name'] ?? '');
$statusFilter = strtolower($_GET['status'] ?? '');
$countryFilter = $_GET['country'] ?? '';
$sourceFilter = $_GET['source'] ?? '';

$filteredTasks = array_filter($tasks, function ($task) use (
    $nameFilter,
    $statusFilter,
    $countryFilter,
    $sourceFilter
) {
    $taskStatus = strtolower(trim($task['status'] ?? ''));
    $taskCountry = $task['country'] ?? '';
    $taskName = strtolower($task['name'] ?? '');
    $taskSource = trim($task['source'] ?? '');

    // Normalize unassigned
    if ($taskStatus === '' || $taskStatus === null) {
        $taskStatus = 'unassigned';
    }

    return
        ($nameFilter === '' || strpos($taskName, $nameFilter) !== false) &&
        ($statusFilter === '' || $taskStatus === strtolower($statusFilter)) &&
        ($countryFilter === '' || $taskCountry === $countryFilter) &&
        ($sourceFilter === '' || $taskSource === $sourceFilter);
});?>

<?php foreach ($filteredTasks as $task): ?>
    <a href="/viewTaskDetails?mobile=<?= urlencode($task['mobile']) ?>" class="task-card">
        <div class="task-mobile">📱 <?= htmlspecialchars($task['mobile']) ?></div>
        <div class="task-name">👤 <?= htmlspecialchars($task['name']) ?></div>
        <?php
        $code = getCountryCode($task['country']);
        $flagUrl = $code ? "https://flagcdn.com/w40/$code.png" : '';
        ?>
        <div class="task-country">
            <?php if ($flagUrl): ?>
                <img src="<?= $flagUrl ?>" alt="<?= htmlspecialchars($task['country']) ?> Flag" style="height: 14px; vertical-align: middle; border-radius: 2px; margin-right: 6px;">
            <?php else: ?>
                🏳️
            <?php endif; ?>
            <?= htmlspecialchars($task['country']) ?>
        </div>
        <div class="task-status">
            <?php if (!empty($task['status'])): ?>
                <?php
                $status = strtolower(trim($task['status']));
                ?>
                <?php if ($status === 'positive'): ?>
                    📝 <span style="color: green; font-weight: bold;">Positive</span>
                <?php elseif ($status === 'negative'): ?>
                    ❌ <span style="color: red; font-weight: bold;">Negative</span>
                <?php elseif ($status === 'neutral'): ?>
                    ⚖️ <span style="color: #444; font-weight: 500;">Neutral</span>
                <?php elseif ($status === 'no response'): ?>
                    🤐 <span style="color: orange; font-weight: bold; ">No Response</span>
                <?php elseif ($status === 'awaiting response' || $status === 'awaiting'): ?>
                    ⏳ <span style="color: #007BFF; font-weight: 700;">Awaiting Response</span>
                <?php else: ?>
                    🏳️ <?= htmlspecialchars($task['status']) ?>
                <?php endif; ?>
            <?php else: ?>
                ❗ <span style="color: #888; font-style: italic;">Unassigned</span>
            <?php endif; ?>
        </div>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        // Auto-submit on dropdown change
        form.querySelectorAll("select").forEach(select => {
            select.addEventListener("change", () => {
                form.submit();
            });
        });

        // Auto-submit on typing in search box (with short delay)
        const nameInput = form.querySelector("input[name='name']");
        let debounceTimer;
        nameInput.addEventListener("input", () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                form.submit();
            }, 500); // Adjust delay if needed
        });
    });
</script>
</body>
</html>
