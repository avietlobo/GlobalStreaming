<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Appointment</title>
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

        .container {
            max-width: 1000px;  /* wider layout for better balance */
            margin: 30px auto;
            background-color: var(--container-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow-x: hidden; /* ✅ prevent horizontal overflow */
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* ✅ auto-wrap columns */
            gap: 20px; /* better spacing */
            width: 100%;
            box-sizing: border-box;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0; /* ✅ ensures proper text wrapping */
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%; /* ✅ input never exceeds parent width */
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<a class="back-link" onclick="window.location.href='/viewAllAppointmentsCT'">← Back </a>
<div class="top-bar">
    <h2>Update Appointment</h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>
<div class="container">
    <form id="appointmentForm">
        <div class="form-group">
            <label for="event_name">Event Name</label>
            <select name="event_name" id="event_name" required disabled>
                <option value="">-- Select Event --</option>
                <?php foreach ($eventNames as $event): ?>
                    <option value="<?= htmlspecialchars($event) ?>"
                        <?= (isset($appointment['event_name']) && $appointment['event_name'] === $event) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($event) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="event_name1">Home Mission Name</label>
            <select name="event_name1" id="event_name1">
                <option value="">-- Select Event --</option>
                <?php foreach ($eventNames1 as $eventName1): ?>
                    <option value="<?= htmlspecialchars($eventName1) ?>"
                        <?= (isset($appointment['event_name_hs']) && $appointment['event_name_hs'] === $eventName1) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($eventName1) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="candidateName">Candidate Name</label>
            <input type="text" id="candidateName" name="candidateName"
                   placeholder="Enter candidate name" required
                   value="<?= htmlspecialchars($participantName) ?>" readonly>
        </div>
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
            <input type="text" id="place" name="place" value="<?= htmlspecialchars($place ?? '') ?>" readonly>
        </div>

        <div class="form-group">
            <label for="classFrom">Highest Class Number Attended</label>
            <input type="text" id="classFrom" name="classFrom"
                   value="<?= htmlspecialchars($highesClassNumberAttended ?? 'No class streamed yet') ?>" readonly>
        </div>


        <div class="form-group">
            <label for="homeMissionAttended">Home Mission Attended</label>
            <select name="homeMissionAttended" id="homeMissionAttended" required>
                <option value="">-- Select --</option>
                <option value="Attended" <?= ($homeMissionAttended ?? '') === 'Attended' ? 'selected' : '' ?>>Attended</option>
                <option value="Not Attended" <?= ($homeMissionAttended ?? '') === 'Not Attended' ? 'selected' : '' ?>>Not Attended</option>
                <option value="Pending" <?= ($homeMissionAttended ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="homeMissionVidAttendance">Home Mission Video Watched</label>
            <select name="homeMissionVidAttendance" id="homeMissionVidAttendance" required>
                <option value="">-- Select --</option>
                <option value="Watched" <?= ($homeMissionVidAttendance ?? '') === 'Watched' ? 'selected' : '' ?>>Watched</option>
                <option value="Not Watched" <?= ($homeMissionVidAttendance?? '') === 'Not Watched' ? 'selected' : '' ?>>Not Watched</option>
            </select>
        </div>


        <div class="form-group">
            <label for="istDateTime">Appointment Date & Time (IST)</label>
            <input type="datetime-local" id="istDateTime" name="istDateTime" value="<?= htmlspecialchars($appointment['appointment_datetime_ist'] ?? '') ?>" required disabled>
        </div>

        <div class="form-group">
            <label for="appointment_datetime_candidate_zone">Appointment Date & Time for Candidate Zone</label>
            <input type="datetime-local" id="appointment_datetime_candidate_zone" name="appointment_datetime_candidate_zone" value="<?= htmlspecialchars($appointment['appointment_datetime_candidate_zone'] ?? '') ?>" required disabled>
        </div>

        <!-- Sathvartha Organizer Dropdown -->
        <div class="form-group">
            <label for="sathvartha_organizer">Sathvartha Organizer</label>
            <select name="sathvartha_organizer" id="sathvartha_organizer" required disabled>
                <option value="">-- Select Sathvartha Organizer --</option>
                <?php foreach ($organizers['SathvarthaOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"
                        <?= ($appointment['sathvartha_organizer_name'] ?? '') === $name ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="evangelistFeedback">Evangelist Feedback</label>
            <textarea id="evangelistFeedback" name="evangelistFeedback" placeholder="Enter feedback" rows="3" readonly><?= htmlspecialchars($appointment['evangelist_feedback'] ?? '') ?></textarea>
        </div>

        <!-- Panel Member Dropdown -->
        <div class="form-group">
            <label for="panel_member">Panel Member</label>
            <select name="panel_member" id="panel_member" required disabled>
                <option value="">-- Select Panel Member --</option>
                <?php foreach ($organizers['PanelMember'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>" <?= ($panelMember ?? '') === $name ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="googleMeetStatus">Google Meet Status</label>
            <select id="googleMeetStatus" name="googleMeetStatus" required disabled>
                <option value="">Select status</option>
                <option value="Not Conducted" <?= ($googleMeetStatus ?? '') === 'Not Conducted' ? 'selected' : '' ?>>Not Conducted</option>
                <option value="Conducted" <?= ($googleMeetStatus ?? '') === 'Conducted' ? 'selected' : '' ?>>Conducted</option>
                <option value="Cancelled" <?= ($googleMeetStatus ?? '') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="faithStatus">Faith Status</label>
            <select id="faithStatus" name="faithStatus" required disabled>
                <option value="">Select status</option>
                <option value="In Faith" <?= $faithStatus === 'In Faith' ? 'selected' : '' ?>>In Faith</option>
                <option value="Not In Faith" <?= $faithStatus === 'Not In Faith' ? 'selected' : '' ?>>Not In Faith</option>
                <option value="Neutral Faith" <?= $faithStatus === 'Neutral Faith' ? 'selected' : '' ?>>Neutral Faith</option>
            </select>
        </div>

        <div class="form-group">
            <label for="panelFeedback">Panel Feedback</label>
            <textarea id="panelFeedback" readonly name="panelFeedback" placeholder="Enter panel feedback" rows="3"><?= htmlspecialchars($appointment['panel_feedback'] ?? '') ?></textarea>
        </div>

        <!-- Local Organizer Dropdown -->
        <div class="form-group">
            <label for="local_organizer">Local Organizer</label>
            <select name="local_organizer" id="local_organizer" required disabled>
                <option value="">-- Select Local Organizer --</option>
                <?php foreach ($organizers['LocalOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"
                        <?= (isset($localOrganizer) && $localOrganizer === $name) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="localOrganizerFeedback">Local Organizer Feedback</label>
            <textarea id="localOrganizerFeedback" readonly name="localOrganizerFeedback" placeholder="Enter feedback" rows="3"><?= htmlspecialchars($appointment['local_organizer_feedback'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaReadyStatus">Sathvartha Ready Status</label>
            <select id="sathvarthaReadyStatus" name="sathvarthaReadyStatus" required disabled>
                <option value="">Select status</option>
                <option value="Not Checked" <?= ($sathvarthaReadyStatus === 'Not Checked') ? 'selected' : '' ?>>Not Checked</option>
                <option value="Ready" <?= ($sathvarthaReadyStatus === 'Ready') ? 'selected' : '' ?>>Ready</option>
                <option value="Not Ready" <?= ($sathvarthaReadyStatus === 'Not Ready') ? 'selected' : '' ?>>Not Ready</option>
                <option value="Withdrawn" <?= ($sathvarthaReadyStatus === 'Withdrawn') ? 'selected' : '' ?>>Withdrawn</option>
            </select>
        </div>
        <div class="form-group">
            <label for="finalFeedback">Final Feedback</label>
            <textarea id="finalFeedback" readonly name="finalFeedback" placeholder="Enter final feedback" rows="3"><?= htmlspecialchars($appointment['final_feedback'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaAttendanceStatus">Sathvartha Attendance</label>
            <select id="sathvarthaAttendanceStatus" name="sathvarthaAttendanceStatus" required disabled>
                <option value="">Select attendance</option>
                <option value="Attended" <?= ($sathvarthaAttendanceStatus ?? '') === 'Attended' ? 'selected' : '' ?>>Attended</option>
                <option value="Pending" <?= ($sathvarthaAttendanceStatus ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Absent" <?= ($sathvarthaAttendanceStatus ?? '') === 'Absent' ? 'selected' : '' ?>>Absent</option>
                <option value="Not Attended" <?= ($sathvarthaAttendanceStatus ?? '') === 'Not Attended' ? 'selected' : '' ?>>Not Attended</option>
                <option value="Negative" <?= ($sathvarthaAttendanceStatus ?? '') === 'Negative' ? 'selected' : '' ?>>Negative</option>
            </select>
        </div>


        <div class="form-group">
            <label for="sathvarthaFeedback">Sathvartha Feedback</label>
            <textarea id="sathvarthaFeedback" readonly name="sathvarthaFeedback" placeholder="Enter sathvartha feedback" rows="3"><?= htmlspecialchars($sathvarthaFeedback ?? '') ?></textarea>
        </div>


        <div class="form-group">
            <label for="fellowshipStatus">Fellowship Status</label>
            <select id="fellowshipStatus" name="fellowshipStatus" required disabled>
                <option value="">Select status</option>
                <option value="Not In Fellowship" <?= ($fellowshipStatus ?? '') === 'Not In Fellowship' ? 'selected' : '' ?>>Not In Fellowship</option>
                <option value="In Fellowship" <?= ($fellowshipStatus ?? '') === 'In Fellowship' ? 'selected' : '' ?>>In Fellowship</option>


            </select>
        </div>

        <!-- Caretaker Dropdown -->
        <div class="form-group">
            <label for="caring_team_member">Caring Team Member</label>
            <select name="caring_team_member" id="caring_team_member" required>
                <option value="">-- Select Caring Team Member --</option>
                <?php foreach ($organizers['Caretaker'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>" <?= ($caringTeamMember === $name) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>



        <div class="form-group">
            <label for="googleMeetCaringTeam">Google Meet by Caring Team</label>
            <select id="googleMeetCaringTeam" name="googleMeetCaringTeam" required>
                <option value="">Select status</option>
                <option value="Conducted" <?= ($caringGoogleMeetStatus ?? '') === 'Conducted' ? 'selected' : '' ?>>Conducted</option>
                <option value="Not Conducted" <?= ($caringGoogleMeetStatus ?? '') === 'Not Conducted' ? 'selected' : '' ?>>Not Conducted</option>
            </select>        </div>

        <div class="form-group">
            <label for="caringStatus">Caring Status</label>
            <select name="caringStatus" id="caringStatus" required>
                <option value="">-- Select Caring Team Member --</option>
                <option value="Good" <?= ($caringStatus ?? '') === 'Good' ? 'selected' : '' ?>>Good</option>
                <option value="Average" <?= ($caringStatus ?? '') === 'Average' ? 'selected' : '' ?>>Average</option>
                <option value="Poor" <?= ($caringStatus ?? '') === 'Poor' ? 'selected' : '' ?>>Poor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="travelStatus">Travelled to Zion</label>
            <select id="travelStatus" name="travelStatus" required>
                <option value="">Select status</option>
                <option value="Yes" <?= ($travelStatus ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= ($travelStatus ?? '') === 'No' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="transportRequired">Transport Required</label>
            <select id="transportRequired" name="transportRequired" required disabled>
                <option value="">Select status</option>
                <option value="Yes" <?= ($transportRequired ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= ($transportRequired ?? '') === 'No' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="caringistDateTime">Appointment Date & Time by Caring Team(IST)</label>
            <input type="datetime-local" id="caringistDateTime" name="caringistDateTime" value="<?= htmlspecialchars($appointment['caring_google_meet_date'] ?? '') ?>" required>
        </div>





        <div class="form-group full-width">
            <button type="button" id="updateBtn" class="submit-btn">Update Appointment</button>
        </div>
    </form>

</div>

<script>
    const updateBtn = document.getElementById('updateBtn');
    const form = document.getElementById('appointmentForm');

    // ✅ Spinner overlay
    const spinner = document.createElement('div');
    spinner.innerHTML = `
        <div style="
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        ">
            <div style="
                border: 6px solid #f3f3f3;
                border-top: 6px solid var(--highlight);
                border-radius: 50%;
                width: 60px;
                height: 60px;
                animation: spin 1s linear infinite;
            "></div>
        </div>
    `;
    spinner.style.display = 'none';
    document.body.appendChild(spinner);

    // ✅ Message box (for success/error)
    const messageBox = document.createElement('div');
    messageBox.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--container-bg);
        color: var(--highlight);
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        font-weight: bold;
        display: none;
        z-index: 10000;
    `;
    document.body.appendChild(messageBox);

    // ✅ Spinner animation
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    updateBtn.addEventListener('click', async () => {
        const formData = new FormData(form);
        const formObj = {};
        formData.forEach((value, key) => formObj[key] = value);

        try {
            spinner.style.display = 'flex';
            updateBtn.disabled = true;

            const response = await fetch('/updateAppointment', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formObj)
            });

            const result = await response.text();

            spinner.style.display = 'none';
            updateBtn.disabled = false;

            if (response.ok) {
                showMessage('✅ Appointment updated successfully!');
                setTimeout(() => {
                    window.location.href = '/viewAllAppointmentsCT';
                }, 2000);
            } else {
                showMessage('❌ Error updating appointment: ' + result);
            }
        } catch (error) {
            spinner.style.display = 'none';
            updateBtn.disabled = false;
            showMessage('⚠️ Network error. Try again.');
            console.error(error);
        }
    });

    // ✅ Function to show temporary messages
    function showMessage(text) {
        messageBox.textContent = text;
        messageBox.style.display = 'block';
        setTimeout(() => {
            messageBox.style.display = 'none';
        }, 3000);
    }
</script>


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
