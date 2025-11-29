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
            padding: 15px;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f5;
            color: var(--text-color);
            transition: 0.3s;
        }

        /* --- Top Bar --- */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }
        h2 {
            flex-grow: 1;
            text-align: center;
            color: var(--highlight);
            margin: 0;
            font-size: 1.4rem;
        }
        .theme-toggle {
            cursor: pointer;
            font-size: 22px;
            border: none;
            background: none;
            color: var(--highlight);
        }

        /* --- Container --- */
        .container {
            max-width: 100%;
            background-color: var(--container-bg);
            padding: 20px;
            border-radius: 10px;
            overflow-x: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;  /* two even columns */
            gap: 18px;
            width: 100%;
            box-sizing: border-box;          /* important */
        }

        @media (max-width: 600px) {
            form {
                grid-template-columns: 1fr;  /* mobile: single column */
            }
        }


        /* --- Labels & Inputs --- */
        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--highlight);
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            color: var(--text-color);
            width: 100%;
            box-sizing: border-box;
            font-size: 0.95rem;
        }
        textarea {
            resize: vertical;
        }

        input[readonly] {
            background: #2c2c2c;
            color: #aaa;
        }
        body.light-mode input[readonly] {
            background: #eee;
            color: #777;
        }

        /* Highlight editable fields except caringistDateTime */
        .form-group input:not([readonly]):not([disabled]):not(#caringistDateTime),
        .form-group select:not([disabled]):not(#caringistDateTime),
        .form-group textarea:not([readonly]):not([disabled]):not(#caringistDateTime) {
            background: #eaffea !important;
            border-color: #00cc00 !important;
        }

        #caringistDateTime {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-color) !important;
        }

        /* --- Submit Button --- */
        .full-width {
            grid-column: 1 / -1;
        }
        .submit-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: var(--button-bg);
            color: var(--button-text);
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }
        .submit-btn:hover {
            filter: brightness(1.1);
        }

        /* --- Back & Logout Buttons --- */
        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }

        /* --- Mobile Fixes --- */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            h2 {
                font-size: 1.2rem;
            }
            .top-bar {
                justify-content: center;
                text-align: center;
            }
            form {
                grid-template-columns: 1fr;
            }
            .submit-btn {
                font-size: 1.1rem;
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
<a class="back-link" href="javascript:history.back()">← Back </a>
<div class="top-bar">
    <h2>Update Appointment</h2>
    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
</div>
<div class="container">
    <form id="appointmentForm">
        <div class="form-group">
            <label for="event_name">Sathvartha Name</label>
            <select name="event_name" id="event_name" required>
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
            <input type="text" id="place" name="place" value="<?= htmlspecialchars($place ?? '') ?>" required>
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
            <input type="datetime-local" id="istDateTime" name="istDateTime" value="<?= htmlspecialchars($appointment['appointment_datetime_ist'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="appointment_datetime_candidate_zone">Appointment Date & Time for Candidate Zone</label>
            <input type="datetime-local" id="appointment_datetime_candidate_zone" name="appointment_datetime_candidate_zone" value="<?= htmlspecialchars($appointment['appointment_datetime_candidate_zone'] ?? '') ?>" required>
        </div>

        <!-- Sathvartha Organizer Dropdown -->
        <div class="form-group">
            <label for="sathvartha_organizer">Sathvartha Organizer</label>
            <select name="sathvartha_organizer" id="sathvartha_organizer" disabled>
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
            <textarea id="evangelistFeedback" name="evangelistFeedback" placeholder="Enter feedback" rows="3" readonly disabled><?= htmlspecialchars($evangelistFeedback ?? '') ?></textarea>
        </div>

        <!-- Panel Member Dropdown -->
        <div class="form-group">
            <label for="panel_member">Panel Member</label>
            <select name="panel_member" id="panel_member" disabled>
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
            <select id="googleMeetStatus" name="googleMeetStatus" disabled>
                <option value="">Select status</option>
                <option value="Not Conducted" <?= ($googleMeetStatus ?? '') === 'Not Conducted' ? 'selected' : '' ?>>Not Conducted</option>
                <option value="Conducted" <?= ($googleMeetStatus ?? '') === 'Conducted' ? 'selected' : '' ?>>Conducted</option>
                <option value="Cancelled" <?= ($googleMeetStatus ?? '') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="faithStatus">Faith Status</label>
            <select id="faithStatus" name="faithStatus" disabled>
                <option value="">Select status</option>
                <option value="In Faith" <?= $faithStatus === 'In Faith' ? 'selected' : '' ?>>In Faith</option>
                <option value="Not In Faith" <?= $faithStatus === 'Not In Faith' ? 'selected' : '' ?>>Not In Faith</option>
                <option value="Neutral Faith" <?= $faithStatus === 'Neutral Faith' ? 'selected' : '' ?>>Neutral Faith</option>
            </select>
        </div>

        <div class="form-group">
            <label for="panelFeedback">Panel Feedback</label>
            <textarea id="panelFeedback" name="panelFeedback" placeholder="Enter panel feedback" rows="3" readonly disabled><?= htmlspecialchars($appointment['panel_feedback'] ?? '') ?></textarea>
        </div>

        <!-- Local Organizer Dropdown -->
        <div class="form-group">
            <label for="local_organizer">Local Organizer</label>
            <select name="local_organizer" id="local_organizer" disabled>
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
            <textarea id="localOrganizerFeedback" name="localOrganizerFeedback" placeholder="Enter feedback" rows="3" readonly disabled><?= htmlspecialchars($appointment['local_organizer_feedback'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaReadyStatus">Sathvartha Ready Status</label>
            <select id="sathvarthaReadyStatus" name="sathvarthaReadyStatus" disabled>
                <option value="">Select status</option>
                <option value="Not Checked" <?= ($sathvarthaReadyStatus === 'Not Checked') ? 'selected' : '' ?>>Not Checked</option>
                <option value="Ready" <?= ($sathvarthaReadyStatus === 'Ready') ? 'selected' : '' ?>>Ready</option>
                <option value="Not Ready" <?= ($sathvarthaReadyStatus === 'Not Ready') ? 'selected' : '' ?>>Not Ready</option>
                <option value="Withdrawn" <?= ($sathvarthaReadyStatus === 'Withdrawn') ? 'selected' : '' ?>>Withdrawn</option>
            </select>
        </div>
        <div class="form-group">
            <label for="finalFeedback">Final Feedback</label>
            <textarea id="finalFeedback" name="finalFeedback" placeholder="Enter final feedback" rows="3" readonly disabled><?= htmlspecialchars($appointment['final_feedback'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaAttendanceStatus">Sathvartha Attendance</label>
            <select id="sathvarthaAttendanceStatus" name="sathvarthaAttendanceStatus" disabled>
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
            <textarea id="sathvarthaFeedback" name="sathvarthaFeedback" placeholder="Enter sathvartha feedback" rows="3" readonly disabled><?= htmlspecialchars($sathvarthaFeedback ?? '') ?></textarea>
        </div>


        <div class="form-group">
            <label for="fellowshipStatus">Fellowship Status</label>
            <select id="fellowshipStatus" name="fellowshipStatus" disabled>
                <option value="">Select status</option>
                <option value="Not In Fellowship" <?= ($fellowshipStatus ?? '') === 'Not In Fellowship' ? 'selected' : '' ?>>Not In Fellowship</option>
                <option value="In Fellowship" <?= ($fellowshipStatus ?? '') === 'In Fellowship' ? 'selected' : '' ?>>In Fellowship</option>


            </select>
        </div>

        <!-- Caretaker Dropdown -->
        <div class="form-group">
            <label for="caring_team_member">Caring Team Member</label>
            <select name="caring_team_member" id="caring_team_member" disabled>
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
            <select id="googleMeetCaringTeam" name="googleMeetCaringTeam" disabled>
                <option value="">Select status</option>
                <option value="Conducted" <?= ($caringGoogleMeetStatus ?? '') === 'Conducted' ? 'selected' : '' ?>>Conducted</option>
                <option value="Not Conducted" <?= ($caringGoogleMeetStatus ?? '') === 'Not Conducted' ? 'selected' : '' ?>>Not Conducted</option>
            </select>        </div>

        <div class="form-group">
            <label for="caringStatus">Caring Status</label>
            <select name="caringStatus" id="caringStatus" disabled>
                <option value="">-- Select Caring Team Member --</option>
                <option value="Good" <?= ($caringStatus ?? '') === 'Good' ? 'selected' : '' ?>>Good</option>
                <option value="Average" <?= ($caringStatus ?? '') === 'Average' ? 'selected' : '' ?>>Average</option>
                <option value="Poor" <?= ($caringStatus ?? '') === 'Poor' ? 'selected' : '' ?>>Poor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="travelStatus">Travelled to Zion</label>
            <select id="travelStatus" name="travelStatus" disabled>
                <option value="">Select status</option>
                <option value="Yes" <?= ($travelStatus ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= ($travelStatus ?? '') === 'No' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="transportRequired">Transport Required</label>
            <select id="transportRequired" name="transportRequired" disabled>
                <option value="">Select status</option>
                <option value="Yes" <?= ($transportRequired ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= ($transportRequired ?? '') === 'No' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="caringistDateTime">Appointment Date & Time (IST)</label>
            <input type="datetime-local" id="caringistDateTime" name="caringistDateTime" value="<?= htmlspecialchars($appointment['caring_google_meet_date'] ?? '') ?>" disabled>
        </div>





        <div class="form-group full-width">
            <button type="button" id="updateBtn" class="submit-btn">Update Appointment</button>
        </div>
    </form>

</div>

<script>
    document.getElementById('updateBtn').addEventListener('click', async () => {
        const form = document.getElementById('appointmentForm');
        const formData = new FormData(form);

        // Convert FormData to a plain object
        const formObj = {};
        formData.forEach((value, key) => {
            formObj[key] = value;
        });

        try {
            const response = await fetch('/updateAppointmentE', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formObj)
            });

            const result = await response.text();

            if (response.ok) {
                alert('Appointment updated successfully!');
                const id = <?= json_encode($appointment['id'] ?? '') ?>;
                window.location.href = `/viewAppointmentE?id=${id}`;
            } else {
                alert('Error updating appointment: ' + result);
            }
        } catch (error) {
            alert('Error updating appointment.');
            console.error(error);
        }
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
