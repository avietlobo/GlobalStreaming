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
            --highlight: #00ff99;
            --label-color: #ccc;
            --border-color: #333;
            --back-bg: #222;
            --back-hover: #333;
            --button-bg: #00ff99;
            --button-text: #000;
            --scrollbar-thumb: linear-gradient(45deg, #00ffcc, #ff00cc);
            --scrollbar-track: #444;
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
            --scrollbar-thumb: linear-gradient(45deg, #007bff, #66ccff);
            --scrollbar-track: #ccc;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f5;
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
            max-width: 1000px;
            margin: 30px auto;
            background: var(--container-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        /* Participant details table only */
        .container > table td {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: anywhere;
            max-width: 250px; /* optional, keeps column width under control */
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

        .add-appointment-btn {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            background-color: var(--button-bg);
            color: var(--button-text);
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border: none;
        }

        .add-appointment-btn:hover {
            filter: brightness(1.1);
        }

        /* 🌈 Scrollable table container */
        .scroll-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }

        .scroll-wrapper::-webkit-scrollbar {
            height: 10px;
        }

        .scroll-wrapper::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
            border-radius: 10px;
        }

        .scroll-wrapper::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 10px;
        }

        .scroll-wrapper::-webkit-scrollbar-thumb:hover {
            filter: brightness(1.2);
        }

        .scroll-wrapper table {
            min-width: 1800px;
        }

        @media (max-width: 600px) {
            td.label {
                background: var(--back-bg);
            }

            h2 {
                font-size: 20px;
            }

            .container {
                padding: 15px;
            }
        }

        .header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .dashboard-btn {
            background: transparent;
            border: 2px solid #007bff;
            color: #007bff;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .dashboard-btn:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
    <a href="/viewCandidates" class="dashboard-btn">Go to Dashboard</a>

</div>
<?php
// safely extract evangelist name
$evangelistName = '';
if (is_array($evangelist) && isset($evangelist[0]['evangelist'])) {
    $evangelistName = $evangelist[0]['evangelist'];
}

// ensure all are strings
$langStr = is_array($language) ? '' : $language;
$countryStr = is_array($country) ? '' : $country;
?>


<a class="back-link" href="/getCandidatesByEvangelist?lang=<?= urlencode($langStr) ?>&country=<?= urlencode($countryStr) ?>&evangelist=<?= urlencode($evangelistName) ?>">← Back</a>


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

    <?php if (!empty($evangelist)): ?>
        <?php
        $row = $evangelist[0];
        $queryParams = http_build_query([
            'participantName' => $row['participantName'] ?? '',
            'mobile' => $row['mobile'] ?? '',
            'evangelist' => $row['evangelist'] ?? '',
            'country' => $country ?? ''
        ]);
        ?>
        <a href="/addAppointment?<?= $queryParams ?>" class="add-appointment-btn">
            ➕ Add Appointment
        </a>
    <?php endif; ?>

    <!-- 🎨 Appointments Table with colorful horizontal scroll -->
    <div class="scroll-wrapper">
        <table>
            <thead>
            <tr>
                <th>Candidate Mobile</th>
                <th>Sathvartha Event Name</th>
                <th>Home Mission Event Name</th>
                <th>Appointment IST</th>
                <th>Appointment Candidate Zone</th>
                <th>Country</th>
                <th>Place</th>
                <th>Class Status</th>
                <th>Sathvartha Organizer</th>
                <th>Panel Member</th>
                <th>Caring Team Member</th>
                <th>Local Organizer</th>
                <th>Google Meet Status</th>
                <th>Faith Status</th>
                <th>Sathvartha Ready Status</th>
                <th>Fellowship Status</th>
                <th>Evangelist Feedback</th>
                <th>Panel Feedback</th>
                <th>Local Organizer Feedback</th>
                <th>Final Feedback</th>
                <th>Sathvartha Attendance</th>
                <th>Sathvartha Feedback</th>
                <th>Caring Google Meet Status</th>
                <th>Caring Status</th>
                <th>Travel Status</th>
                <th>Created At</th>
                <th>Updated At</th>

            </tr>
            </thead>
            <tbody>
            <?php if (!empty($appointments)): ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr class="clickable-row" data-id="<?= $appointment['id'] ?>">
                        <td><?= htmlspecialchars($appointment['candidate_mobile']) ?></td>
                        <td><?= htmlspecialchars($appointment['event_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['event_name_hs']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_datetime_ist']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_datetime_candidate_zone']) ?></td>
                        <td><?= htmlspecialchars($appointment['candidate_country']) ?></td>
                        <td><?= htmlspecialchars($appointment['place']) ?></td>
                        <td><?= htmlspecialchars($appointment['class_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_organizer_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['panel_member_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_team_member_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['local_organizer_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['google_meet_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['faith_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_ready_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['fellowship_status']) ?></td>
                        <td><?= htmlspecialchars($remark) ?></td>
                        <td><?= htmlspecialchars($appointment['panel_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['local_organizer_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['final_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_attendance_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_google_meet_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['travel_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['created_at']) ?></td>
                        <td><?= htmlspecialchars($appointment['updated_at']) ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="26">No appointments found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <br><br>

</div>
<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');
            window.location.href = `/viewAppointment?id=${id}`;
        });
    });
</script>

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
