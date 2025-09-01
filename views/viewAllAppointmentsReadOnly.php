<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            /* Light theme colors */
            --bg-color: #f9f9f9;
            --text-color: #111;
            --heading-color: #2b6cb0;
            --table-border: #ddd;
            --table-header-bg: #2b6cb0;
            --table-header-text: #fff;
            --table-row-even: #f1f5f9;
            --btn-bg: #2b6cb0;
            --btn-text: #fff;
            --btn-hover: #2c5282;
        }

        body.dark {
            /* Dark theme colors */
            --bg-color: #111;
            --text-color: #fff;
            --heading-color: #00ff00;
            --table-border: #333;
            --table-header-bg: #222;
            --table-header-text: #0f0;
            --table-row-even: #1a1a1a;
            --btn-bg: #0f0;
            --btn-text: #000;
            --btn-hover: #0c0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f5;
            color: var(--text-color);
            padding: 20px;
            transition: background 0.3s, color 0.3s;
        }

        h1 {
            text-align: center;
            color: var(--heading-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            padding: 8px;
            border: 1px solid var(--table-border);
            text-align: left;
        }

        th {
            background-color: var(--table-header-bg);
            color: var(--table-header-text);
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: var(--table-row-even);
        }

        .btn-edit {
            padding: 5px 10px;
            background-color: var(--btn-bg);
            color: var(--btn-text);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .btn-edit:hover {
            background-color: var(--btn-hover);
        }

        .table-container {
            overflow-x: auto;
        }

        /* Toggle switch */
        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2b6cb0;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }
    </style>
</head>
<!--<body class="dark">-->
<!--<div class="theme-toggle">-->
<!--    <label class="switch">-->
<!--        <input type="checkbox" id="modeToggle">-->
<!--        <span class="slider"></span>-->
<!--    </label>-->
<!--</div>-->

<h1>All Appointments</h1>
<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>
<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>
<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Candidate Mobile</th>
            <th>Event Name</th>
            <th>Appointment (IST)</th>
            <th>Appointment (Candidate Zone)</th>
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
            <th>Sathvartha Attendance Status</th>
            <th>Sathvartha Feedback</th>
            <th>Caring Google Meet Status</th>
            <th>Caring Status</th>
            <th>Travel Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Transport Required</th>
            <th>Caring Google Meet Date</th>
            <th>Event Name HS</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= htmlspecialchars($appointment['id']) ?></td>
                    <td><?= htmlspecialchars($appointment['candidate_mobile']) ?></td>
                    <td><?= htmlspecialchars($appointment['event_name']) ?></td>
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
                    <td><?= htmlspecialchars($appointment['evangelist_feedback']) ?></td>
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
                    <td><?= htmlspecialchars($appointment['transport_required']) ?></td>
                    <td><?= htmlspecialchars($appointment['caring_google_meet_date']) ?></td>
                    <td><?= htmlspecialchars($appointment['event_name_hs']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="31" style="text-align:center;">No appointments found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    const toggle = document.getElementById('modeToggle');
    const body = document.body;

    // Load saved theme
    if(localStorage.getItem('theme') === 'light') {
        body.classList.remove('dark');
        toggle.checked = true;
    }

    toggle.addEventListener('change', () => {
        if(toggle.checked) {
            body.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
</script>
</body>
</html>
</body>
</html>
