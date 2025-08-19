<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #00ff00;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #222;
            color: #0f0;
            position: sticky;
            top: 0;
        }
        tr:nth-child(even) {
            background-color: #1a1a1a;
        }
        .btn-edit {
            padding: 5px 10px;
            background-color: #0f0;
            color: #000;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn-edit:hover {
            background-color: #0c0;
        }
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
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
</body>
</html>
