<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-light: #f8f8f8;
            --text-light: #333;
            --card-light: #fff;

            --bg-dark: #121212;
            --text-dark: #eee;
            --card-dark: #1f1f1f;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            background: #f4f4f5;
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 26px;
            text-align: center;
        }

        .toggle-theme {
            text-align: right;
            margin-bottom: 20px;
        }

        .toggle-theme button {
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            background-color: #555;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .toggle-theme button:hover {
            background-color: #333;
        }

        .appointment-card {
            position: relative;
            background-color: var(--card-light);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: background-color 0.3s;
        }

        body.dark-mode .appointment-card {
            background-color: var(--card-dark);
        }

        .appointment-card div {
            margin-bottom: 12px;
        }

        .field-label {
            font-weight: 600;
            display: inline-block;
            width: 220px;
        }

        .edit-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #555;
            background-color: #eaeaea;
            padding: 6px 8px;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .edit-icon:hover {
            background-color: #ccc;
        }

        body.dark-mode .edit-icon {
            background-color: #2a2a2a;
            color: #ccc;
        }

        body.dark-mode .edit-icon:hover {
            background-color: #444;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .field-label {
                display: block;
                width: auto;
                margin-bottom: 4px;
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

<?php
// Assuming session is already started above in your PHP
use app\core\Application;

$username = Application::$app->session->get('nameFinal');
$index = Application::$app->session->get('index');
$candidate = htmlspecialchars($participantName ?? '');
?>
<a class="back-link" href="getClassDetails?username=<?= urlencode($username) ?>&candidate=<?= htmlspecialchars($participantName) ?>&mobile=<?= urlencode($mobile) ?>&index=<?= urlencode($index) ?>">← Back</a>
<!--<a class="back-link" href="javascript:history.back()">← Back</a>-->
<h2>Appointment Details</h2>



<?php if (!empty($appointments)): ?>
    <?php foreach ($appointments as $appointment): ?>
        <div class="appointment-card">
            <?php if (isset($appointment['id'])): ?>
                <a class="edit-icon" href="/editAppointmentE?id=<?= urlencode($appointment['id']) ?>" title="Edit Appointment">✏️</a>
            <?php endif; ?>

            <?php if (!empty($participantName)): ?>
                <div>
                    <span class="field-label">Participant Name:</span>
                    <span><?= htmlspecialchars($participantName) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($evangelist)): ?>
                <div>
                    <span class="field-label">Evangelist:</span>
                    <span><?= htmlspecialchars($evangelist) ?></span>
                </div>
            <?php endif; ?>

            <?php foreach ($appointment as $field => $value): ?>
                <?php
                // Default label formatting
                $label = ucwords(str_replace('_', ' ', $field));

                // Label mapping
                $labelMap = [
                    'Home Mission Vid Attendance' => 'Home Mission Video Attendance',
                    'Event Name' => 'Sathavartha Event',
                    'Event Name Hs' => 'Home Mission Event'
                ];

                // Apply renaming if match found
                if (isset($labelMap[$label])) {
                    $label = $labelMap[$label];
                }
                ?>
                <div>
                    <span class="field-label"><?= htmlspecialchars($label) ?>:</span>
                    <span>
            <?php
            if (strtolower($field) === 'evangelist_feedback') {
                echo htmlspecialchars($remark ?? '');
            } else {
                echo htmlspecialchars($value ?? '');
            }
            ?>
        </span>
                </div>
            <?php endforeach; ?>



        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No appointment details found.</p>
<?php endif; ?>




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
        toggleBtn.textContent = "";            // show light icon always
    }
</script>

</body>
</html>
