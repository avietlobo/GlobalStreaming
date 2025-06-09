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
        $evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
        $index = \app\core\Application::$app->session->get('index7D');

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
            <tr>
                <th class="fixed-column-header">Class No</th>
                <th>Record Date</th>
                <th>Class Link</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Mobile</th>
                <th>Media Type</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($userDetails)): ?>
                <tr>
                    <td colspan="7" class="no-records">
                        Evangelist has not requested any classes yet.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($userDetails as $user): ?>
                    <tr class="clickable-row"
                        data-classfrom="<?= htmlspecialchars($user->classFrom) ?>"
                        data-status="<?= htmlspecialchars($user->status) ?>"
                        data-username="<?= htmlspecialchars($user->participant) ?>"
                        data-password="<?= htmlspecialchars($user->password) ?>"
                        data-remark="<?= htmlspecialchars($user->remark) ?>"
                        data-mobile="<?= htmlspecialchars($user->mobile) ?>"
                        data-mediaType="<?= htmlspecialchars($user->mediaType) ?>">
                        <td class="fixed-column"><?= htmlspecialchars($user->classFrom) ?></td>
                        <td><?= htmlspecialchars($user->recordDate) ?></td>
                        <td>
                            <span style="white-space: nowrap;">
                                <a href="https://godsownwisdom.com/v2" target="_blank">https://godsownwisdom.com/v2</a> #
                                User: <?= htmlspecialchars($user->participant) ?> #
                                Pass: <?= htmlspecialchars($user->password) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($user->status) ?></td>
                        <td><?= htmlspecialchars($user->remark) ?></td>
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

    <script type="text/javascript">
        // Handle row clicks to pass query parameters
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function () {
                const classFrom = this.getAttribute('data-classfrom');
                const status = this.getAttribute('data-status');
                const username = this.getAttribute('data-username');
                const password = this.getAttribute('data-password');
                const remark = this.getAttribute('data-remark');
                const mobile = this.getAttribute('data-mobile');
                const mediaType = this.getAttribute('data-mediaType');
                const index = <?= json_encode(\app\core\Application::$app->session->get('index')); ?>;

                const url = new URL('/getClassNumber7D', window.location.origin);
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
            window.location.href = '/register7D';
        });

        // Navigate back using the back arrow
        document.getElementById('backArrow').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            window.location.href = '/evngDashboard7'; // Replace with your desired URL
        });

        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</div>
</body>
</html>
