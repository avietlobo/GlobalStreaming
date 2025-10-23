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
            --even-row: #1a1a1a;
            --btn-bg: #0f0;
            --btn-text: #000;
        }

        body.light-mode {
            --bg-color: #f5f5f5;
            --text-color: #000;
            --table-border: #ccc;
            --th-bg: #e0e0e0;
            --th-text: #007b00;
            --even-row: #f9f9f9;
            --btn-bg: #007b00;
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
            color: #00ff00;
        }

        body.light-mode h1 {
            color: #007b00;
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
            background-color: var(--even-row);
        }

        .btn-edit {
            padding: 5px 10px;
            background-color: var(--btn-bg);
            color: var(--btn-text);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-edit:hover {
            opacity: 0.85;
        }

        .table-container {
            overflow-x: auto;
        }

        .back-button {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-button:hover {
            opacity: 0.8;
        }

        .theme-toggle {
            position: fixed;
            top: 15px;
            right: 20px;
            background: var(--btn-bg);
            color: var(--btn-text);
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, color 0.3s;
        }

        .theme-toggle:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
<button class="theme-toggle" onclick="toggleTheme()">🌙 Dark</button>

<h1>All Appointments</h1>

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        ← Back
    </button>
</div>

<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Candidate Mobile</th>
            <th>Sathavartha Event</th>
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
            <th>Home Mission Event</th>
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
                        <a class="btn-edit" href="/editAppointmentCT?id=<?= urlencode($appointment['id']) ?>">Edit</a>
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
    // Load saved theme
    document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "light") {
            document.body.classList.add("light-mode");
            document.querySelector(".theme-toggle").textContent = "☀️ Light";
        }
    });

    // Toggle theme
    function toggleTheme() {
        document.body.classList.toggle("light-mode");
        const isLight = document.body.classList.contains("light-mode");
        document.querySelector(".theme-toggle").textContent = isLight ? "☀️ Light" : "🌙 Dark";
        localStorage.setItem("theme", isLight ? "light" : "dark");
    }
</script>
</body>
</html>
