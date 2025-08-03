<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #000;
            --text-color: #fff;
            --container-bg: #111;
            --highlight: #00ff00;
            --input-bg: #222;
            --input-border: #555;
            --button-bg: #00ff00;
            --button-text: #000;
        }
        body.light-mode {
            --bg-color: #f9f9f9;
            --text-color: #111;
            --container-bg: #fff;
            --highlight: #007bff;
            --input-bg: #f0f0f0;
            --input-border: #ccc;
            --button-bg: #007bff;
            --button-text: #fff;
        }
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            flex-grow: 1;
            text-align: center;
            color: var(--highlight);
            margin: 0;
        }
        .theme-toggle {
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
            color: var(--highlight);
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: var(--container-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--highlight);
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 8px;
            border: 1px solid var(--input-border);
            border-radius: 4px;
            background-color: var(--input-bg);
            color: var(--text-color);
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .submit-btn {
            padding: 12px 20px;
            background-color: var(--button-bg);
            color: var(--button-text);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            filter: brightness(1.1);
        }
        @media (max-width: 600px) {
            form {
                grid-template-columns: 1fr;
            }
        }
        input[readonly] {
            background-color: #2c2c2c;
            color: #aaa;
            cursor: not-allowed;
        }
        body.light-mode input[readonly] {
            background-color: #eee;
            color: #888;
        }
    </style>
</head>
<body>
<a class="back-link" href="javascript:history.back()">← Back </a>
<div class="top-bar">
    <h2>Add Appointment</h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>
<div class="container">
    <form action="/appointments/add" method="GET">
        <div class="form-group">
            <label for="event_name">Event Name</label>
            <select name="event_name" id="event_name" required>
                <option value="">-- Select Event --</option>
                <?php foreach ($eventNames as $eventName): ?>
                    <option value="<?= htmlspecialchars($eventName) ?>">
                        <?= htmlspecialchars($eventName) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="candidateName">Candidate Name</label>
            <input type="text" id="candidateName" name="candidateName"
                   placeholder="Enter candidate name" required
                   value="<?= htmlspecialchars($participantName ?? '') ?>" readonly>      </div>

        <div class="form-group">
            <label for="candidateMobile">Candidate Mobile</label>
            <input type="text" id="candidateMobile" name="candidateMobile"
                   placeholder="Enter candidate mobile" required
                   value="<?= htmlspecialchars($mobile ?? '') ?>" readonly>     </div>

        <div class="form-group">
            <label for="evangelistName">Evangelist Name</label>
            <input type="text" id="evangelistName" name="evangelistName"
                   placeholder="Enter evangelist name" required
                   value="<?= htmlspecialchars($evangelist ?? '') ?>" readonly>      </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country"
                   placeholder="Enter country" required
                   value="<?= htmlspecialchars($country ?? '') ?>" readonly>      </div>

        <div class="form-group">
            <label for="place">Place</label>
            <input type="text" id="place" name="place" placeholder="Enter place" required>
        </div>

        <div class="form-group">
            <label for="classStatus">Class Status</label>
            <select id="classStatus" name="classStatus" required>
                <option value="">Select status</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="candidateAppointmentDate">Candidate Appointment Date</label>
            <input type="date" id="candidateAppointmentDate" name="candidateAppointmentDate" required>
        </div>

        <div class="form-group">
            <label for="indianStandardTime">Indian Standard Time</label>
            <input type="time" id="indianStandardTime" name="indianStandardTime" required>
        </div>

        <!-- Sathvartha Organizer Dropdown -->
        <div class="form-group">
            <label for="sathvartha_organizer">Sathvartha Organizer</label>
            <select name="sathvartha_organizer" id="sathvartha_organizer">
                <option value="">-- Select Sathvartha Organizer --</option>
                <?php foreach ($organizers['SathvarthaOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="evangelistFeedback">Evangelist Feedback</label>
            <textarea id="evangelistFeedback" name="evangelistFeedback" placeholder="Enter feedback" rows="3"></textarea>
        </div>

        <!-- Panel Member Dropdown -->
        <div class="form-group">
            <label for="panel_member">Panel Member</label>
            <select name="panel_member" id="panel_member">
                <option value="">-- Select Panel Member --</option>
                <?php foreach ($organizers['PanelMember'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="googleMeetStatus">Google Meet Status</label>
            <select id="googleMeetStatus" name="googleMeetStatus" required>
                <option value="">Select status</option>
                <option value="Not Conducted">Not Conducted</option>
                <option value="Conducted">Conducted</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="faithStatus">Faith Status</label>
            <select id="faithStatus" name="faithStatus" required>
                <option value="">Select status</option>
                <option value="Strong">In Faith</option>
                <option value="Average">Not In Faith</option>
                <option value="Weak">Neutral Faith</option>
            </select>
        </div>

        <div class="form-group">
            <label for="panelFeedback">Panel Feedback</label>
            <textarea id="panelFeedback" name="panelFeedback" placeholder="Enter panel feedback" rows="3"></textarea>
        </div>

        <!-- Local Organizer Dropdown -->
        <div class="form-group">
            <label for="local_organizer">Local Organizer</label>
            <select name="local_organizer" id="local_organizer">
                <option value="">-- Select Local Organizer --</option>
                <?php foreach ($organizers['LocalOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="localOrganizerFeedback">Local Organizer Feedback</label>
            <textarea id="localOrganizerFeedback" name="localOrganizerFeedback" placeholder="Enter feedback" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaReadyStatus">Sathvartha Ready Status</label>
            <select id="sathvarthaReadyStatus" name="sathvarthaReadyStatus" required>
                <option value="">Select status</option>
                <option value="Not Checked">Not Checked</option>
                <option value="Ready">Ready</option>
                <option value="Not Ready">Not Ready</option>
                <option value="Withdrawn">Withdrawn</option>
            </select>
        </div>

        <div class="form-group">
            <label for="finalFeedback">Final Feedback</label>
            <textarea id="finalFeedback" name="finalFeedback" placeholder="Enter final feedback" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaAttendance">Sathvartha Attendance</label>
            <select id="sathvarthaAttendance" name="sathvarthaAttendance" required>
                <option value="">Select attendance</option>
                <option value="Present">Pending</option>
                <option value="Absent">Attended</option>
                <option value="Not Attended">Not Attended</option>
                <option value="Negative">Negative</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sathvarthaFeedback">Sathvartha Feedback</label>
            <textarea id="sathvarthaFeedback" name="sathvarthaFeedback" placeholder="Enter sathvartha feedback" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="fellowshipStatus">Fellowship Status</label>
            <select id="fellowshipStatus" name="fellowshipStatus" required>
                <option value="">Select status</option>
                <option value="Not In Fellowship">Not In Fellowship</option>
                <option value="In Fellowship">In Fellowship</option>
            </select>
        </div>

        <!-- Caretaker Dropdown -->
        <div class="form-group">
            <label for="caring_team_member">Caring Team Member</label>
            <select name="caring_team_member" id="caring_team_member">
                <option value="">-- Select Caring Team Member --</option>
                <?php foreach ($organizers['Caretaker'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="googleMeetCaringTeam">Google Meet Caring Team</label>
            <input type="text" id="googleMeetCaringTeam" name="googleMeetCaringTeam" placeholder="Enter Google Meet caring team">
        </div>

        <div class="form-group">
            <label for="caringStatus">Caring Status</label>
            <select id="caringStatus" name="caringStatus" required>
                <option value="">Select status</option>
                <option value="Good">Good</option>
                <option value="Average">Average</option>
                <option value="Poor">Poor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="travelStatus">Travelled to Zion</label>
            <select id="travelStatus" name="travelStatus" required>
                <option value="">Select status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>



        <div class="form-group full-width">
            <input type="submit" class="submit-btn" value="Add Appointment">
        </div>
    </form>

</div>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme');
    if(savedTheme === 'light'){
        body.classList.add('light-mode');
        toggleBtn.textContent = '🌞';
    }

    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        const isLight = body.classList.contains('light-mode');
        toggleBtn.textContent = isLight ? '🌞' : '🌙';
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
    });
</script>
</body>
</html>
