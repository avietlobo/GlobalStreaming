<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details for Candidate Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f5;
            color: #333;
            line-height: 1.6;
            position: relative;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin-bottom: 40px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button.primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .logout-button {
            background-color: #007BFF;
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            font-size: 0.875em;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .floating-edit-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .floating-edit-button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .material-icons {
            font-size: 24px;
        }

        @media only screen and (max-width: 768px) {
            h1 { font-size: 2em; }
            .container { padding: 15px; }
            .card { padding: 15px; }
        }

        @media only screen and (max-width: 480px) {
            h1 { font-size: 1.5em; }
            .card { padding: 10px; }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="#" id="logout-link">
        <button style="position: absolute; top: 20px; right: 20px;">Logout</button>
    </a>

    <div class="card">
        <?php
        // Fetching evangelist data from session
        $evangelistData = \app\core\Application::$app->session->get('evngDashboardData');
        $index = app\core\Application::$app->session->get('index');

        // Storing fields in variables
        $participant = htmlspecialchars($evangelistData[$index]->participantName);
        $mobile = htmlspecialchars($evangelistData[$index]->mobile);
        $country = htmlspecialchars($evangelistData[$index]->country);
        $language = htmlspecialchars($evangelistData[$index]->language);
        $evangelist = htmlspecialchars($evangelistData[$index]->evangelist);
        $source = htmlspecialchars($evangelistData[$index]->source);
        $allotedDays = htmlspecialchars($evangelistData[$index]->allotedDays);
        $mediaType = htmlspecialchars($evangelistData[$index]->mediaType);
        $activeStatus = htmlspecialchars($evangelistData[$index]->activeStatus);
        $userid = htmlspecialchars($evangelistData[$index]->userid);
        $recordDate = htmlspecialchars($evangelistData[$index]->recordDate);

        // Retrieving class data passed via query parameters
        $data = $_GET;
        $classFrom = htmlspecialchars($data['classFrom']);
        $status = htmlspecialchars($data['status']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $remark = htmlspecialchars($data['remark']);
        $mobile= htmlspecialchars($data['mobile']);
        //$mediaType= htmlspecialchars($data['mediaType']);
        //$mediaType = htmlspecialchars(urldecode($data['mediaType']));
        $mediaType = htmlspecialchars(str_replace('+', ' ', urldecode($data['mediaType'])));        ?>

        <p><strong>Participant Name:</strong></p>
        <p><?= $participant; ?></p>

        <p><strong>Record Date:</strong></p>
        <p><?= $recordDate; ?></p>

        <p><strong>Evangelist:</strong></p>
        <p><?= $evangelist; ?></p>

        <p><strong>Language:</strong></p>
        <p><?= $language; ?></p>

        <p><strong>Class No:</strong></p>
        <p><?= $classFrom; ?></p>

        <p><strong>Status:</strong></p>
        <p><?= $status; ?></p>

        <p><strong>Class Link:</strong></p>
        <p>
            <a href="https://godsownwisdom.com" target="_blank">
                https://godsownwisdom.com # User: <?= $username; ?> # Pass: <?= $password; ?>
            </a>
        </p>

        <p><strong>Media Type:</strong></p>
        <p><?= $mediaType; ?></p>


        <p><strong>Remark:</strong></p>
        <p><?= $remark; ?></p>



    </div>

    <div class="button-container">
        <button onclick="goBackToDetails()" class="btn btn-secondary">Back</button>
    </div>
</div>


    <!-- Floating Edit Button -->
    <button class="floating-edit-button" onclick="editDetails()">
        <span class="material-icons">edit</span>
    </button>

<script type="text/javascript">
    function goBackToDetails() {
        // Base URL of the first view
        const baseUrl = 'http://localhost:9094/getClassDetails';
        //For prod
        //const baseUrl = 'http://godsownwisdom.com/getClassDetails';

        //For test
        //const baseUrl = 'http://testgow.site/getClassDetails';

        // Retrieve parameters from the query string of the second view
        const params = new URLSearchParams(window.location.search);

        // PHP variables retrieved from the session
        const index = <?= json_encode($index); ?>;
        const evangelist = <?= json_encode($evangelist); ?>;
        const mobile = <?= json_encode($mobile); ?>;
        const participantName =<?= json_encode($participant); ?>;

        // Prepare the new query parameters
        const url = new URL(baseUrl);
        url.searchParams.set('username', evangelist);  // Use evangelist for username
        url.searchParams.set('candidate', participantName);  // Original username
        url.searchParams.set('mobile', mobile);  // Original mobile
        url.searchParams.set('index', index);  // Correct index


        // Redirect to the new URL
        window.location.href = url.toString();
    }
</script>



    <script type="text/javascript">
        document.getElementById('backButton').addEventListener('click', function () {
            window.location.href = '/evngDashboard';
        });


        function editDetails() {
            const url = new URL(window.location.origin + '/editClassDetails');
            url.searchParams.append('participant', '<?= $participant; ?>');
            url.searchParams.append('recordDate', '<?= $recordDate; ?>');
            url.searchParams.append('evangelist', '<?= $evangelist; ?>');
            url.searchParams.append('language', '<?= $language; ?>');
            url.searchParams.append('classFrom', '<?= $classFrom; ?>');
            url.searchParams.append('status', '<?= $status; ?>');
            url.searchParams.append('username', '<?= $username; ?>');
            url.searchParams.append('password', '<?= $password; ?>');
            url.searchParams.append('mediaType', '<?= $mediaType; ?>');
            url.searchParams.append('remark', '<?= $remark; ?>');
            url.searchParams.append('mobile', '<?= $mobile; ?>');

            window.location.href = url.toString();
        }
    </script>
</div>
</body>
</html>
