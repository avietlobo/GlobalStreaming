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
            background: #f4f4f5;
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
            overflow: hidden; /* fully contain form */
            box-sizing: border-box;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0; /* allow shrinking inside grid */
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--highlight);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            max-width: 100%;
            padding: 8px;
            border: 1px solid var(--input-border);
            border-radius: 4px;
            background-color: var(--input-bg);
            color: var(--text-color);
            box-sizing: border-box;
        }

        /* Highlight all editable fields EXCEPT caringistDateTime */
        .form-group input:not([readonly]):not([disabled]):not(#caringistDateTime),
        .form-group select:not([disabled]),
        .form-group textarea:not([readonly]):not([disabled]) {
            background-color: #eaffea !important;
            border-color: #00cc00 !important;
        }

        /* Remove highlight from caretaker meet date */
        #caringistDateTime {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
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
            width: 100%;
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
    <form action="/saveAppointmentE" method="POST">
        <div class="form-group">
            <label for="event_name">Event Name</label>
            <select name="event_name" id="event_name">
                <option value="">-- Select Event --</option>
                <?php foreach ($eventNames as $eventName): ?>
                    <option value="<?= htmlspecialchars($eventName) ?>">
                        <?= htmlspecialchars($eventName) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="event_name1">Home Mission Name</label>
            <select name="event_name1" id="event_name1">
                <option value="">-- Select Event --</option>
                <?php foreach ($eventNames1 as $eventName): ?>
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
                   value="<?= htmlspecialchars($evangelist1 ?? '') ?>" readonly>      </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country"
                   placeholder="Enter country" required
                   value="<?= htmlspecialchars($country ?? '') ?>" readonly>      </div>

        <div class="form-group">
            <label for="place">Place</label>
            <input type="text" id="place" name="place" placeholder="Enter place">
        </div>

        <div class="form-group">
            <label for="classFrom">Highest Class Number Attended</label>
            <input type="text" id="classFrom" name="classFrom"
                   value="<?= htmlspecialchars($highesClassNumberAttended ?? 'No class streamed yet') ?>" readonly>
        </div>

        <div class="form-group">
            <label for="homeMissionAttendance">Home Mission Attendance</label>
            <select id="homeMissionAttendance" name="homeMissionAttendance" required>
                <option value="">-- Select Attendance --</option>
                <option value="Attended">Attended</option>
                <option value="Not Attended">Not Attended</option>
            </select>
        </div>

        <div class="form-group">
            <label for="homeMissionVidAttendance">Home Mission Video Watched</label>
            <select id="homeMissionVidAttendance" name="homeMissionVidAttendance" required>
                <option value="">-- Select Attendance --</option>
                <option value="Watched">Watched</option>
                <option value="Not Watched">Not Watched</option>
            </select>
        </div>


        <div class="form-group">
            <label for="istDateTimeZ">Appointment Date & Time (IST)</label>
            <input type="datetime-local" id="istDateTimeZ" name="istDateTimeZ">
        </div>

        <div class="form-group">
            <label for="istDateTime">Appointment Date & Time for Candidate zone</label>
            <input type="datetime-local" id="istDateTime" name="istDateTime">
        </div>

        <!-- Sathvartha Organizer Dropdown -->
        <div class="form-group">
            <label for="sathvartha_organizer">Sathvartha Organizer</label>
            <select name="sathvartha_organizer" id="sathvartha_organizer" disabled>
                <option value="">-- Select Sathvartha Organizer --</option>
                <?php foreach ($organizers['SathvarthaOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="evangelistFeedback">Evangelist Feedback</label>
            <textarea
                    id="evangelistFeedback"
                    name="evangelistFeedback"
                    placeholder="Enter feedback"
                    rows="3"
                    readonly disabled
                    style="background-color: #f9f9f9; color: #555; cursor: not-allowed;"><?= htmlspecialchars($remark ?? '') ?></textarea>
        </div>


        <!-- Panel Member Dropdown -->
        <div class="form-group">
            <label for="panel_member">Panel Member</label>
            <select name="panel_member" id="panel_member" disabled>
                <option value="">-- Select Panel Member --</option>
                <?php foreach ($organizers['PanelMember'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="googleMeetStatus">Google Meet Status</label>
            <select id="googleMeetStatus" name="googleMeetStatus" disabled>
                <option value="">Select status</option>
                <option value="Not Conducted">Not Conducted</option>
                <option value="Conducted">Conducted</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="faithStatus">Faith Status</label>
            <select id="faithStatus" name="faithStatus" disabled>
                <option value="">Select status</option>
                <option value="In Faith">In Faith</option>
                <option value="Not In Faith">Not In Faith</option>
                <option value="Neutral Faith">Neutral Faith</option>
            </select>
        </div>

        <div class="form-group">
            <label for="panelFeedback">Panel Feedback</label>
            <textarea id="panelFeedback" name="panelFeedback" placeholder="Enter panel feedback" rows="3" disabled></textarea>
        </div>

        <!-- Local Organizer Dropdown -->
        <div class="form-group">
            <label for="local_organizer">Local Organizer</label>
            <select name="local_organizer" id="local_organizer" disabled>
                <option value="">-- Select Local Organizer --</option>
                <?php foreach ($organizers['LocalOrganizer'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="localOrganizerFeedback">Local Organizer Feedback</label>
            <textarea id="localOrganizerFeedback" name="localOrganizerFeedback" placeholder="Enter feedback" rows="3" disabled></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaReadyStatus">Sathvartha Ready Status</label>
            <select id="sathvarthaReadyStatus" name="sathvarthaReadyStatus" disabled>
                <option value="">Select status</option>
                <option value="Not Checked">Not Checked</option>
                <option value="Ready">Ready</option>
                <option value="Not Ready">Not Ready</option>
                <option value="Withdrawn">Withdrawn</option>
            </select>
        </div>

        <div class="form-group">
            <label for="finalFeedback">Final Feedback</label>
            <textarea id="finalFeedback" name="finalFeedback" placeholder="Enter final feedback" rows="3" disabled></textarea>
        </div>

        <div class="form-group">
            <label for="sathvarthaAttendance">Sathvartha Attendance</label>
            <select id="sathvarthaAttendance" name="sathvarthaAttendance" disabled>
                <option value="">Select attendance</option>
                <option value="Pending">Pending</option>
                <option value="Absent">Attended</option>
                <option value="Not Attended">Not Attended</option>
                <option value="Negative">Negative</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sathvarthaFeedback">Sathvartha Feedback</label>
            <textarea id="sathvarthaFeedback" name="sathvarthaFeedback" placeholder="Enter sathvartha feedback" rows="3" readonly disabled></textarea>
        </div>

        <div class="form-group">
            <label for="fellowshipStatus">Fellowship Status</label>
            <select id="fellowshipStatus" name="fellowshipStatus" disabled>
                <option value="">Select status</option>
                <option value="Not In Fellowship">Not In Fellowship</option>
                <option value="In Fellowship">In Fellowship</option>
            </select>
        </div>

        <!-- Caretaker Dropdown -->
        <div class="form-group">
            <label for="caring_team_member">Caring Team Member</label>
            <select name="caring_team_member" id="caring_team_member" disabled>
                <option value="">-- Select Caring Team Member --</option>
                <?php foreach ($organizers['Caretaker'] ?? [] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="googleMeetCaringTeam">Google Meet by Caring Team</label>
            <select id="googleMeetCaringTeam" name="googleMeetCaringTeam" disabled>
                <option value="">Select status</option>
                <option value="Conducted">Conducted</option>
                <option value="Not Conducted">Not Conducted</option>
            </select>        </div>

        <div class="form-group">
            <label for="caringStatus">Caring Status</label>
            <select id="caringStatus" name="caringStatus" disabled>
                <option value="">Select status</option>
                <option value="Good">Good</option>
                <option value="Average">Average</option>
                <option value="Poor">Poor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="travelStatus">Travelled to Zion</label>
            <select id="travelStatus" name="travelStatus" disabled >
                <option value="">Select status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="transportStatus">Transport required</label>
            <select id="transportStatus" name="transportStatus" disabled>
                <option value="">Select status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="caringistDateTime">Google meet Appointment Date for Caretaker</label>
            <input type="datetime-local" id="caringistDateTime" name="caringistDateTime" >
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
