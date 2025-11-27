        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Class Details for Candidate Dashboard</title>
        <style>
            /* CSS styles */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f4f5;
                color: #333;
                line-height: 1.6;
                min-height: 100vh;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                position: relative; /* Relative positioning for absolute positioning of buttons */
            }
            h1, h2 {
                text-align: center;
            }
            h1 {
                font-size: 2.5em;
            }
            h2 {
                font-size: 2em;
                color: #555;
                margin-bottom: 20px;
            }
            .card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
            }
            .table-wrapper {
                overflow-x: auto; /* Enable horizontal scrolling */
                position: relative; /* Relative positioning for the fixed column */
                max-height: 500px; /* Optional: Set a max height for the table */
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #007BFF; /* Header background color */
                color: #fff; /* Header text color */
                font-weight: bold;
                white-space: nowrap;
            }
            td {
                background-color: #f9f9f9; /* Data cell background color */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .fixed-column {
                position: sticky; /* Fix the column position */
                left: 0; /* Align to the left */
                background-color: #f9f9f9; /* Match data cell background */
                z-index: 1; /* Ensure it appears above other cells */
            }
            .fixed-column-header {
                position: sticky; /* Fix the header position */
                left: 0; /* Align to the left */
                background-color: #007BFF; /* Blue background for header */
                color: #fff; /* White text for header */
                z-index: 2; /* Higher z-index for header */
            }
            tr:nth-child(even) td {
                background-color: #f2f2f2; /* Alternate row background */
            }
            tr:hover {
                background-color: #e9ecef; /* Row hover effect */
            }
            .clickable-row {
                cursor: pointer;
            }
            button {
                background-color: #007BFF;
                color: #fff;
                padding: 12px 24px;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.3s ease;
                border: none; /* Remove default border */
            }
            button:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
            }
            .no-records {
                text-align: center;
                color: #777;
                font-style: italic;
                padding: 20px;
            }
            .button-container {
                display: flex;
                justify-content: space-between; /* Align buttons to the left and right */
                margin-bottom: 20px;
                position: relative; /* Position relative to the container */
            }
            .back-arrow {
                display: flex;
                align-items: center; /* Center align icon */
                color: #007BFF; /* Color of the arrow */
                text-decoration: none; /* Remove underline */
                transition: color 0.3s ease; /* Smooth transition for hover effect */
                font-size: 24px; /* Adjust size of the arrow */
            }
            .back-arrow:hover {
                color: #0056b3; /* Darker color on hover */
            }
            svg {
                width: 24px; /* Set width for SVG */
                height: 24px; /* Set height for SVG */
                margin-right: 8px; /* Space between icon and text */
                fill: currentColor; /* Fill color based on current color */
            }
            .add-button-container {
                margin-top: 20px;
                display: flex;
                justify-content: flex-end; /* Align button to the right */
            }
            /* Modal overlay styling */
            .modal {
                display: none;
                position: fixed; /* Stay in place */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            /* Modal content box */
            .modal-content {
                background: #fff;
                padding: 20px;
                border-radius: 12px;
                max-width: 500px;
                width: 90%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 9999;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background-color: rgba(0,0,0,0.5);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background: var(--card-bg);
                color: var(--text-color);
                padding: 20px;
                border-radius: 12px;
                width: 90%;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                position: relative;
            }

            .modal-content input,
            .modal-content select,
            .modal-content textarea {
                width: 100%;
                margin-bottom: 12px;
                padding: 10px;
                font-size: 1em;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            .modal-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }

            input[readonly] {
                background-color: #e9ecef;
                color: #6c757d;
                cursor: not-allowed;
            }


            /* Section heading */
            #savedSessions h4 {
                font-size: 1.4rem;
                margin-bottom: 16px;
                color: #333;
                font-weight: bold;
                border-left: 5px solid #1DA1F2;
                padding-left: 10px;
            }

            /* Messages */
            #savedSessions p {
                font-size: 0.95rem;
                margin: 8px 0;
                color: #555;
            }
            #savedSessions p.error {
                color: #e63946;
                font-weight: bold;
            }
            #savedSessions p.empty {
                color: #777;
                font-style: italic;
            }

            /* Session card */
            #savedSessions .form-group > div {
                border: 1px solid #ddd;
                border-left: 5px solid #1DA1F2;
                background: #fff;
                padding: 16px;
                border-radius: 10px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.08);
                margin-bottom: 16px;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            #savedSessions .form-group > div:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 12px rgba(0,0,0,0.12);
            }

            /* Card text */
            #savedSessions .form-group p {
                margin: 6px 0;
                font-size: 0.95rem;
                color: #444;
            }

            /* Buttons */
            #savedSessions .tab-btn.edit-btn {
                display: inline-block;
                margin-top: 10px;
                padding: 8px 14px;
                border: none;
                border-radius: 6px;
                font-size: 0.9rem;
                cursor: pointer;
                background-color: #1DA1F2;
                color: #fff;
                transition: background 0.3s ease;
            }

            #savedSessions .tab-btn.edit-btn:hover {
                background-color: #0d8ddb;
            }

            /* Modal background */
            .modal {
                display: none; /* hidden by default */
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background: rgba(0,0,0,0.5); /* semi-transparent black */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Modal content */
            .modal-content {
                background: #fff;
                padding: 24px;
                border-radius: 10px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.2);
                animation: fadeIn 0.3s ease;
            }

            /* Title */
            .modal-content h3 {
                margin-top: 0;
                margin-bottom: 16px;
                font-size: 1.3rem;
                color: #333;
                border-bottom: 2px solid #1DA1F2;
                padding-bottom: 8px;
            }

            /* Labels */
            .modal-content label {
                display: block;
                margin: 12px 0 6px;
                font-weight: bold;
                color: #444;
            }

            /* Inputs */
            .modal-content input,
            .modal-content select {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ccc;
                border-radius: 6px;
                font-size: 0.95rem;
                margin-bottom: 12px;
                transition: border-color 0.2s ease;
            }

            .modal-content input:focus,
            .modal-content select:focus {
                border-color: #1DA1F2;
                outline: none;
            }

            /* Buttons */
            .modal-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 16px;
            }

            .modal-actions button {
                padding: 8px 16px;
                border: none;
                border-radius: 6px;
                font-size: 0.95rem;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .modal-actions button[type="button"] {
                background: #ccc;
                color: #333;
            }

            .modal-actions button[type="button"]:hover {
                background: #b3b3b3;
            }

            .modal-actions button[type="submit"] {
                background: #1DA1F2;
                color: #fff;
                font-weight: bold;
            }

            .modal-actions button[type="submit"]:hover {
                background: #0d8ddb;
            }

            /* Animation */
            @keyframes fadeIn {
                from {opacity: 0; transform: translateY(-20px);}
                to {opacity: 1; transform: translateY(0);}
            }

            /* Section title */
            .form-title {
                font-size: 1.4rem;
                font-weight: bold;
                color: #333;
                margin-bottom: 16px;
                border-left: 5px solid #1DA1F2;
                padding-left: 10px;
            }

            /* Card for form */
            .form-card {
                background: #fff;
                padding: 20px;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.08);
                margin-bottom: 20px;
            }

            /* Form groups */
            .form-group {
                margin-bottom: 18px;
            }

            .form-group label {
                font-weight: 600;
                display: block;
                margin-bottom: 6px;
                color: #444;
            }

            /* Inputs */
            .form-group input[type="text"] {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 0.95rem;
                background-color: #f9f9f9;
                transition: border-color 0.2s ease;
            }

            .form-group input[type="text"]:focus {
                border-color: #1DA1F2;
                outline: none;
            }

            /* Readonly style */
            input[readonly] {
                background-color: #e9ecef;
                color: #6c757d;
                cursor: not-allowed;
            }

            /* Radio buttons */
            .radio-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .radio-option {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                font-size: 0.95rem;
                color: #333;
            }

            .radio-option input[type="radio"] {
                accent-color: #1DA1F2; /* Modern browsers */
            }

            /* Actions */
            .form-actions {
                margin-top: 20px;
                text-align: right;
            }
            .form-actions button {
                background-color: #1DA1F2;
                color: #fff;
                padding: 10px 18px;
                border-radius: 8px;
                cursor: pointer;
                font-size: 0.95rem;
                font-weight: 600;
                border: none;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
            .form-actions button:hover {
                background-color: #0d8ddb;
                transform: translateY(-2px);
            }


            /* Card section wrapper */
            .card-section {
                background: #fff;
                padding: 20px;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.08);
                margin-bottom: 20px;
            }

            /* Labels */
            .card-section label {
                display: block;
                font-weight: 600;
                margin-bottom: 6px;
                color: #444;
            }

            /* Select input */
            .card-section select {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 0.95rem;
                margin-bottom: 16px;
                transition: border-color 0.2s ease;
            }

            .card-section select:focus {
                border-color: #1DA1F2;
                outline: none;
            }

            /* Textarea */
            .card-section textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 0.95rem;
                margin-bottom: 16px;
                resize: vertical;
                transition: border-color 0.2s ease;
            }

            .card-section textarea:focus {
                border-color: #1DA1F2;
                outline: none;
            }

            /* Reassign button */
            .reassign-btn {
                background-color: #FFC107; /* warning style */
                color: #fff;
                padding: 10px 18px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                font-weight: 600;
                font-size: 0.95rem;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .reassign-btn:hover {
                background-color: #e0a800;
                transform: translateY(-2px);
            }

            /* Hide sections dynamically */
            #colleagueSection, #reassignSection {
                transition: all 0.3s ease;
            }











        </style>
    </head>
    <body>
    <div class="container">
        <div class="button-container">
            <a href="#" class="back-arrow" id="backArrow" title="Go Back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6" stroke-width="3" stroke="currentColor" fill="none"/></svg>
                Back
            </a>
            <a href="#" id="logout-link">
                <button>Logout</button>
            </a>
        </div>

        <div class="card">
            <?php
            // Fetching data from session
            $evangelistData = \app\core\Application::$app->session->get('evngDashboardData');
            $index = \app\core\Application::$app->session->get('index');

            // Extract fields
            $participant = htmlspecialchars($evangelistData[$index]->participantName);
            $mobile = htmlspecialchars($evangelistData[$index]->mobile);
            $country = htmlspecialchars($evangelistData[$index]->country);
            $language = htmlspecialchars($evangelistData[$index]->language);
            $evangelist = htmlspecialchars($evangelistData[$index]->evangelist);
            $recordDate = htmlspecialchars($evangelistData[$index]->recordDate);
            $mediaType = htmlspecialchars($evangelistData[$index]->mediaType);
            ?>

            <p><strong>Mobile:</strong> <?php echo $mobile; ?></p>
            <p><strong>Participant Name:</strong> <?php echo $participant; ?></p>
            <p><strong>Country:</strong> <?php echo $country; ?></p>
            <p><strong>Language:</strong> <?php echo $language; ?></p>
            <p><strong>Evangelist:</strong> <?php echo $evangelist; ?></p>
            <p><strong>Record Date:</strong> <?php echo $recordDate; ?></p>
        </div>

        <h5>Related Candidate Detail Records</h5>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr class="clickable-related-row">
                    <th class="fixed-column-header">Class No</th>
                    <th>Record Date</th>
                    <th>Class Link</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Login attempts</th>
                    <th>Mobile</th>
                    <th>Media Type</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($userDetails)): ?>
                    <tr>
                        <td colspan="8" class="no-records">
                            Evangelist has not requested any classes yet.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($userDetails as $user): ?>
                        <tr class="clickable-related-row"
                            data-classfrom="<?= htmlspecialchars($user->classFrom) ?>"
                            data-status="<?= htmlspecialchars($user->status) ?>"
                            data-username="<?= htmlspecialchars($user->participant) ?>"
                            data-password="<?= htmlspecialchars($user->password) ?>"
                            data-remark="<?= htmlspecialchars($user->remark) ?>"
                            data-login="<?= htmlspecialchars($user->login_attempts) ?>"
                            data-mobile="<?= htmlspecialchars($user->mobile) ?>"
                            data-mediaType="<?= htmlspecialchars($user->mediaType) ?>">
                            <td class="fixed-column"><?= htmlspecialchars($user->classFrom) ?></td>
                            <td><?= htmlspecialchars($user->recordDate) ?></td>
                            <td>
                                <span style="white-space: nowrap;">
                                    <a href="https://godsownwisdom.com" target="_blank">https://godsownwisdom.com</a> #
                                    User: <?= htmlspecialchars($user->participant) ?> #
                                    Pass: <?= htmlspecialchars($user->password) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($user->status) ?></td>
                            <td><?= htmlspecialchars($user->remark) ?></td>
                            <td><?= 3 - (int)$user->login_attempts ?></td>
                            <td><?= htmlspecialchars($user->mobile) ?></td>
                            <td><?= htmlspecialchars($user->mediaType) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>



        <div class="add-button-container">
            <button id="addButton" class="primary">Add</button>
        </div>

        <h5 class="form-title">Word Sharing to Candidate</h5>

        <div class="card form-card">
            <form id="wordSharingForm" method="post" action="/saveWordSharingAssignment">
                <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" name="language" id="language"
                           value="<?= htmlspecialchars($language) ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="form-label">Assignment Type</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="assignmentType" value="self" checked>
                            <span>I will take the topics</span>
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="assignmentType" value="colleague">
                            <span>Assign to Evangelist</span>
                        </label>
                    </div>
                </div>


                <div class="form-group card-section" id="colleagueSection" style="display: none;">
                    <label for="colleague">Select Evangelist</label>
                    <select name="colleague" id="colleague">
                        <option value="">-- Select Evangelist --</option>
                        <?php if (!empty($evangelists)): ?>
                            <?php foreach ($evangelists as $evangelist): ?>
                                <option value="<?= htmlspecialchars($evangelist) ?>">
                                    <?= htmlspecialchars($evangelist) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <!-- Remarks Field -->
                    <label for="reassign_remark">Remarks</label>
                    <textarea name="reassign_remark" id="reassign_remark" rows="3"
                              placeholder="Enter remarks for reassignment"></textarea>

                    <div class="form-actions" id="reassignSection" style="display: none;">
                        <button type="button" class="reassign-btn" onclick="sendReassignRequest()">🔁 Reassign</button>
                    </div>
                </div>


                <div class="form-group" id="addBtnSection">
                <button type="button" class="btn btn-primary" onclick="openSessionModal()">Add</button>
            </div>

            <!-- ✅ MOVE THIS HERE -->
            <div id="approvalStatus" style="margin-top: 20px;"></div>
        </form>

        <!-- ✅ Display approval history here -->
        <!--        <div id="approvalStatus" style="margin-top: 20px;"></div>-->
        <div id="sessionModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h3>📆 Schedule Word Session</h3>
                <form id="sessionScheduleForm">
                    <label for="sessionName">Select Session</label>
                    <select id="sessionName" name="sessionName" required>
                        <option value="">-- Select Session --</option>
                        <option value="1">Session 1: Salvation, incl plan and 1st coming</option>
                        <option value="2">Session 2: God the Father</option>
                        <option value="3">Session 3: Second coming incl Signs of Times</option>
                        <option value="4">Session 4: He has come, new name</option>
                        <option value="5">Session 5: Messenger sent by God</option>
                        <option value="6">Session 6: Righteousness</option>
                        <option value="7">Session 7: Zion, true Zion</option>
                        <option value="8">Session 8: Holy Mother</option>
                        <option value="9">Session 9: Church</option>
                        <option value="10">Session 10: Good News Retreat</option>
                    </select>

                    <label for="sessionDate">Select Date & Time</label>
                    <input type="datetime-local" id="sessionDate" name="sessionDate" required>

                    <div class="modal-actions">
                        <button type="button" onclick="closeSessionModal()">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="savedSessions" style="margin-top: 20px;"></div>
    </div>

    <!--<h5>Saved Word Sessions</h5>-->
    <!---->
    <!--<table id="wordSessionsTable" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">-->
    <!--    <thead>-->
    <!--    <tr>-->
    <!--        <th>Session Name</th>-->
    <!--        <th>Session Date</th>-->
    <!--        <th>Status</th>-->
    <!--        <th>Participant</th>-->
    <!--        <th>Language</th>-->
    <!--        <th>Remark</th>-->
    <!--        <th>Actions</th>-->
    <!--    </tr>-->
    <!--    </thead>-->
    <!--    <tbody>-->
    <!--    <tr><td colspan="7" style="padding:10px; text-align:center;">No sessions found yet.</td></tr>-->
    <!--    </tbody>-->
    <!--</table>-->
    <!---->
    <!--<div id="wordSessionsCards" style="display: flex; flex-wrap: wrap; gap: 16px;">-->
    <!--    <p style="text-align:center;color:#666;">No sessions found yet.</p>-->
    <!--</div>-->


        <script type="text/javascript">
            // Handle row clicks to pass query parameters
            document.querySelectorAll('.clickable-related-row').forEach(row => {
                row.addEventListener('click', function () {
                    const classFrom = this.getAttribute('data-classfrom');
                    const status = this.getAttribute('data-status');
                    const username = this.getAttribute('data-username');
                    const password = this.getAttribute('data-password');
                    const remark = this.getAttribute('data-remark');
                    const mobile = this.getAttribute('data-mobile');
                    const mediaType = this.getAttribute('data-mediaType');
                    const index = <?= json_encode(\app\core\Application::$app->session->get('index')); ?>;

                    const url = new URL('/getClassNumber', window.location.origin);
                    url.searchParams.append('classFrom', classFrom);
                    url.searchParams.append('status', status);
                    url.searchParams.append('username', username);
                    url.searchParams.append('password', password);
                    url.searchParams.append('remark', remark);
                    url.searchParams.append('mobile', mobile);
                    url.searchParams.append('mediaType', mediaType);
                    url.searchParams.append('index', index);

                    window.location.href = url;
                });
            });

            document.getElementById('addButton').addEventListener('click', function() {
                window.location.href = '/register';
            });

            // Navigate back using the back arrow
            document.getElementById('backArrow').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior
                window.location.href = '/evngDashboard1'; // Replace with your desired URL
            });

            document.addEventListener('contextmenu', event => event.preventDefault());
        </script>
    <script>
        function openSessionModal() {
            document.getElementById("sessionModal").style.display = "flex";
        }

        function closeSessionModal() {
            document.getElementById("sessionModal").style.display = "none";
        }

        // Handle session schedule form submit
        document.getElementById("sessionScheduleForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const sessionName = document.getElementById("sessionName").value;
            const sessionDate = document.getElementById("sessionDate").value;

            if (!sessionName || !sessionDate) {
                alert("Please fill out all fields.");
                return;
            }

            // ✅ You can use AJAX here to POST to your backend
            // For now, just show a success message
            alert(`Session "${sessionName}" scheduled for ${sessionDate}`);

            // Close the modal
            closeSessionModal();
        });
    </script>

    <script>
        document.querySelectorAll('input[name="assignmentType"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const type = this.value;
                document.getElementById('colleagueSection').style.display = (type === 'colleague') ? 'block' : 'none';
                document.getElementById('reassignSection').style.display = (type === 'colleague') ? 'block' : 'none';
                document.getElementById('addBtnSection').style.display = (type === 'self') ? 'block' : 'none';
            });
        });
    </script>
    <script>
        document.getElementById("wordSharingForm").addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent normal form submission

            const form = e.target;
            const formData = new URLSearchParams();
            for (const pair of new FormData(form)) {
                formData.append(pair[0], pair[1]);
            }

            fetch('/saveWordSharingAssignment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("✅ Word Sharing assigned successfully!");
                        loadApprovalStatus();  // Refresh the approval status section
                        form.reset();
                    } else {
                        alert("❌ Failed: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An unexpected error occurred.");
                });
        });
    </script>
    <script>
        document.getElementById("sessionScheduleForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const sessionId = document.getElementById("sessionName").value;
            const sessionDate = document.getElementById("sessionDate").value;

            if (!sessionId || !sessionDate) {
                alert("Please fill out all fields.");
                return;
            }

            const data = new URLSearchParams();
            data.append("mobile", "<?= htmlspecialchars($mobile) ?>");
            data.append("participant", "<?= htmlspecialchars($candidate) ?>");
            data.append("language", "<?= htmlspecialchars($language) ?>");
            data.append("sessionName", sessionId);
            data.append("sessionDate", sessionDate);

            fetch("/saveWordSession", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: data
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        alert("✅ " + response.message);
                        closeSessionModal();
                        loadWordSessions();  // 🔔 Ensure the list updates after saving
                    } else {
                        alert("❌ " + response.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error occurred while saving session.");
                });
        });

    </script>
    <script>
        const candidateMobile = "<?= htmlspecialchars($mobile) ?>";
        const candidateName = "<?= htmlspecialchars($participant) ?>";



        function sendReassignRequest() {
            const colleague = document.getElementById("colleague").value;
            const language = document.getElementById("language").value;
            const remarks = document.getElementById("reassign_remark").value.trim();
            if (!colleague) {
                alert("Please select a colleague.");
                return;
            }
            if (!remarks) {
                alert("Please enter remarks before reassigning.");
                return;
            }

            const data = new URLSearchParams();
            data.append("mobile", candidateMobile);
            data.append("candidate_name", candidateName);
            data.append("language", language);
            data.append("assigned_by", "<?= $_SESSION['evngName'] ?? '' ?>");
            data.append("assigned_to", colleague);
            data.append("remarks", "Word sharing reassignment request");
            data.append("remarks", remarks);


            fetch("/reassignWordSharing", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: data
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        alert("✅ Reassignment request sent successfully!");
                        loadApprovalStatus(); // 🔄 Refresh the history immediately
                        // ✅ Clear dropdown and remarks after successful reassignment
                        document.getElementById("colleague").selectedIndex = 0;
                        document.getElementById("reassign_remark").value = "";
                    } else {
                        alert("❌ Failed: " + response.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("An error occurred while sending request.");
                });
        }

    </script>

    <script>

        function loadWordSessions() {
            const sessionContainer = document.getElementById("savedSessions");
            sessionContainer.innerHTML = "<p>🔄 Loading saved sessions...</p>";

            fetch(`/getWordSessions?mobile=<?= urlencode($mobile) ?>`)
                .then(response => response.json())
                .then(data => {
                    sessionContainer.innerHTML = ""; // Clear loading text
                    if (data.success && Array.isArray(data.sessions)) {
                        if (data.sessions.length === 0) {
                            sessionContainer.innerHTML = "<p>📭 No sessions found.</p>";
                        } else {
                            let html = "<h4>📝 My Word Sessions</h4><div style='display: flex; flex-direction: column; gap: 12px;'>";

                            data.sessions.forEach(session => {
                                const sessionName = session.session_name || 'Unknown Session';
                                const div = document.createElement("div");
                                div.className = "form-group";
                                div.innerHTML = `
                                <div style="
                                    border: 1px solid #ddd;
                                    border-left: 4px solid #1DA1F2;
                                    background: #f5faff;
                                    padding: 12px 16px;
                                    border-radius: 6px;
                                    margin-bottom: 10px;
                                ">
                               <!--      <p><strong>🆔 ID:</strong> ${session.id}</p> -->
 <input type="hidden" value="${session.id}">
<p><strong>📖 Session:</strong> ${session.session_id}</p>
<p><strong>👨‍🏫 Session Name:</strong> ${sessionName}</p>
<p><strong>📅 Date:</strong> ${session.session_date}</p>
<p><strong>🚩 Status:</strong> ${session.status}</p>
<p><strong>👤 Assigned To:</strong> ${session.evangelist}</p>
<p><strong>💬 Remark:</strong> ${session.remark}</p>

                                    <button class="tab-btn edit-btn"
                                        onclick="openEditSessionModal(
                                            '${session.id}',
                                            'Session ${session.session_id}',
                                            '${session.session_date}',
                                            '${session.status || ""}',
                                             decodeURIComponent('${encodeURIComponent(session.remark || "")}'),
                                            '${session.evangelist || ""}'
                                        )">✏️ Edit</button>
                                </div>
                            `;
                                sessionContainer.appendChild(div);
                            });
                        }
                    } else {
                        sessionContainer.innerHTML = "<p style='color:red;'>Failed to load sessions.</p>";
                    }
                })
                .catch(error => {
                    console.error(error);
                    sessionContainer.innerHTML = "<p style='color:red;'>Error occurred while fetching sessions.</p>";
                });

            loadApprovalStatus(); // Keep approval status updated
        }


    </script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            loadWordSessions();
        });

    </script>
    <div id="editSessionModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div class="modal-content" style="background:#fff; padding:20px; border-radius:8px; width:400px; position:relative;">
            <span onclick="closeEditSessionModal()" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">&times;</span>
            <h3>✏️ Edit Session</h3>
            <form id="editSessionForm">
                <input type="hidden" id="editSessionId" name="sessionId" >

                <label>Date & Time</label>
                <input type="datetime-local" id="editSessionDate" name="sessionDate" required><br><br>

                <label>Status</label>
                <select id="editSessionStatus" name="status" required>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Missed">Missed</option>
                    <option value="Cancelled">Cancelled</option>
                </select><br><br>

                <label>Assigned To (Evangelist)</label>
                <input type="text" id="editSessionEvangelist" name="evangelist" required readonly><br><br>


                <label>Remark</label>
                <textarea id="editSessionRemark" name="remark" rows="3"></textarea><br><br>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
    <script>
        function openEditSessionModal(id, name, dateTime, status, remark, evangelist) {
            document.getElementById("editSessionId").value = id;
            document.getElementById("editSessionDate").value = dateTime;
            document.getElementById("editSessionStatus").value = status;
            remark = remark || '';
            // normalize newlines and decode any stray HTML entity markers if needed
            remark = remark.replace(/\r\n/g, "\n").replace(/\r/g, "\n");
            document.getElementById("editSessionRemark").value = remark;
            document.getElementById("editSessionEvangelist").value = evangelist;

            document.getElementById("editSessionModal").style.display = "flex";
        }

        function closeEditSessionModal() {
            document.getElementById("editSessionModal").style.display = "none";
        }

        document.getElementById("editSessionForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const data = new URLSearchParams(new FormData(this));

            fetch("/updateSession", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: data
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        alert("✅ Session updated successfully!");
                        closeEditSessionModal();
                        loadWordSessions();  // This will fetch updated sessions and display them
                    } else {
                        alert("❌ " + response.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    //alert("An error occurred while updating session.");
                });
        });

    </script>

    <script>
        function loadApprovalStatus() {
            fetch(`/getApprovals?mobile=${encodeURIComponent(candidateMobile)}`)
                .then(res => res.json())
                .then(data => {
                    let html = "<h4>📖 Reassignment History</h4><div style='display: flex; flex-direction: column; gap: 12px;'>";
                    const statusDiv = document.getElementById("approvalStatus");
                    if (data.success && Array.isArray(data.approvals)) {
                        if (data.approvals.length === 0) {
                            statusDiv.innerHTML = "<p style='color: gray;'>No previous reassignments.</p>";
                        } else {
                            let html = "<h4>📖 Reassignment History</h4>";
                            data.approvals.forEach(item => {
                                const color = item.status === 'Approved' ? 'green' :
                                    item.status === 'Rejected' ? 'red' : 'orange';

                                html += `
        <div style="
            border: 1px solid #ccc;
            border-left: 5px solid ${color};
            padding: 12px 16px;
            border-radius: 8px;
            background-color: #f9f9f9;
        ">
            <p><strong>📲 Assigned to:</strong> ${item.assigned_to}</p>
            <p><strong>🔁 Status:</strong> <span style="color: ${color};">${item.status}</span></p>
            <p><strong>🕓 On:</strong> ${new Date(item.created_at).toLocaleString()}</p>
        </div>
    `;
                            });
                            html += "</div>";
                            statusDiv.innerHTML = html;
                        }
                    } else {
                        statusDiv.innerHTML = "<p style='color:red;'>Failed to load approvals.</p>";
                    }
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById("approvalStatus").innerHTML = "<p style='color:red;'>Error fetching data.</p>";
                });
        }

    </script>
        <!-- 🌟 Appointments Section -->
        <div id="appointmentsSection" class="card-section" style="margin-top: 40px;">
            <h2 class="section-title">📅 Appointments</h2>

            <?php
            // Generate query params for Add Appointment
            $queryParams = http_build_query([
                'participantName' => $participant ?? '',
                'mobile' => $mobile ?? '',
                'evangelist1' => $evangelist1 ?? '',
                'country' => $country ?? ''
            ]);
            ?>

            <div class="button-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <p style="color: #555; font-weight: 500;">Manage candidate appointments below:</p>
                <a href="/addAppointmentE?<?= $queryParams ?>" class="btn-compact">
                    ➕ Add Appointment
                </a>
            </div>

            <div class="table-wrapper" style="overflow-x:auto; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <table style="width:100%; border-collapse:collapse; min-width:1500px;">
                    <thead>
                    <tr>
                        <th>Candidate Mobile</th>
                        <th>Sathvartha Name</th>
                        <th>Appointment IST</th>
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
                        <th>Sathvartha Ready</th>
                        <th>Fellowship Status</th>
                        <th>Evangelist Feedback</th>
                        <th>Panel Feedback</th>
                        <th>Local Organizer Feedback</th>
                        <th>Final Feedback</th>
                        <th>Sathvartha Attendance</th>
                        <th>Sathvartha Feedback</th>
                        <th>Caring Meet Status</th>
                        <th>Caring Status</th>
                        <th>Travel Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Home Mission Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($appointments)): ?>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr class="clickable-row" data-id="<?= $appointment['id'] ?>">
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
                                <td><?= htmlspecialchars($appointment['event_name_hs']) ?></td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    </tbody></table></div> <!-- close table and wrapper early -->
            <p class="no-records" style="text-align:center; padding: 20px; color:#777; font-style:italic;">
                📭 No appointments found.
            </p>
        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <style>
            .section-title {
                text-align: center;
                color: #007BFF;
                font-size: 1.6rem;
                font-weight: 600;
                margin-bottom: 20px;
                border-bottom: 3px solid #1DA1F2;
                display: inline-block;
                padding-bottom: 6px;
            }

            .primary-btn {
                background-color: #1DA1F2;
                color: #fff;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .primary-btn:hover {
                background-color: #0d8ddb;
                transform: translateY(-2px);
            }

            table th {
                background-color: #007BFF;
                color: #fff;
                text-align: left;
                padding: 10px;
                font-size: 0.9rem;
                white-space: nowrap;
            }

            table td {
                background-color: #f9f9f9;
                padding: 8px 10px;
                border-bottom: 1px solid #ddd;
                font-size: 0.9rem;
                color: #333;
            }

            tr:nth-child(even) td {
                background-color: #f2f8ff;
            }

            tr:hover td {
                background-color: #e8f2ff;
            }

            .clickable-row {
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .no-records {
                text-align: center;
                padding: 20px;
                color: #777;
                font-style: italic;
            }
            .btn-compact {
                background-color: #007BFF;
                color: #fff;
                padding: 4px 10px;
                border-radius: 5px;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                box-shadow: 0 1px 2px rgba(0,0,0,0.08);
                line-height: 1.2;
            }

            .btn-compact:hover {
                background-color: #0d8ddb;
                transform: translateY(-1px);
            }

        </style>

        <script>
            document.querySelectorAll('#appointmentsSection .clickable-row').forEach(row => {
                row.addEventListener('click', () => {
                    const id = row.getAttribute('data-id');
                    window.location.href = `/viewAppointmentE?id=${id}`;
                });
            });
        </script>




    </div>
    </body>
    </html>
