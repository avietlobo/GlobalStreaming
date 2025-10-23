<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #111;
            --text-color: #fff;
            --table-border: #333;
            --th-bg: #222;
            --th-text: #0f0;
            --accent: #0f0;
            --row-even: #1a1a1a;
            --btn-bg: #0f0;
            --btn-text: #000;
        }

        body.light-mode {
            --bg-color: #f9f9f9;
            --text-color: #000;
            --table-border: #ccc;
            --th-bg: #e6ffe6;
            --th-text: #007700;
            --accent: #007700;
            --row-even: #f0f0f0;
            --btn-bg: #007700;
            --btn-text: #fff;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        h1 {
            text-align: center;
            color: var(--accent);
        }

        .toggle-container {
            text-align: right;
            margin-bottom: 10px;
        }

        .toggle-btn {
            background-color: var(--accent);
            color: var(--btn-text);
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .toggle-btn:hover {
            background-color: #0c0;
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
            background-color: var(--th-bg);
            color: var(--th-text);
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: var(--row-even);
        }

        .btn-edit {
            padding: 5px 10px;
            background-color: var(--btn-bg);
            color: var(--btn-text);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-edit:hover {
            background-color: #0c0;
        }

        .table-container {
            overflow-x: auto;
        }

        .back-button {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            border: none;
            border-radius: 4px;
            padding: 6px 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #0c0;
        }
    </style>
</head>
<body>
<div class="toggle-container">
    <button class="toggle-btn" id="themeToggle">🌙 Dark Mode</button>
</div>

<h1>All Appointments</h1>

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        ⬅ Back
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
                    <td>
                        <a class="btn-edit" href="/editAppointmentLO?id=<?= urlencode($appointment['id']) ?>">Edit</a>
                    </td>
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
    const toggleBtn = document.getElementById('themeToggle');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'light') {
        document.body.classList.add('light-mode');
        toggleBtn.textContent = '🌞 Light Mode';
    }

    toggleBtn.addEventListener('click', () => {
        document.body.classList.toggle('light-mode');
        let theme = 'dark';
        if (document.body.classList.contains('light-mode')) {
            theme = 'light';
            toggleBtn.textContent = '🌞 Light Mode';
        } else {
            toggleBtn.textContent = '🌙 Dark Mode';
        }
        localStorage.setItem('theme', theme);
    });
</script>
</body>
</html>
