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

        .back-arrow {
            display: flex;
            align-items: center;
            color: #007BFF;
            font-size: 24px;
            text-decoration: none;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .back-arrow svg {
            width: 24px;
            height: 24px;
            margin-right: 8px;
            fill: currentColor;
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

        .back-button {
            font-size: 24px; /* Adjust size */
            color: #007BFF; /* Match with theme color */
            cursor: pointer; /* Change cursor to pointer */
            position: absolute; /* Position absolutely within the container */
            top: 20px; /* Adjust the top position */
            left: 20px; /* Adjust the left position */
            text-decoration: none; /* Remove underline */
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


        /* Styling for the Copy Button */
        .copy-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1em;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-top: 10px;  /* Adds space between the class link and the button */
        }

        .copy-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .copy-button:focus {
            outline: none;
        }

        .copy-button .material-icons {
            margin-right: 8px;
            font-size: 20px;
        }

        .copy-container {
            display: block;  /* Block display to make button appear below the link */
            margin-top: 20px; /* Adds space before button */
        }

        .copied-feedback {
            font-size: 0.9em;
            color: #4CAF50;
            margin-top: 10px; /* Adds space between "Copied!" message and the button */
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .copied-feedback.show {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
<div class="container">


    <div class="button-container">
        <a href="#"  class="back-arrow" id="backArrow" onclick="goBackToDetails()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6" stroke-width="3" stroke="currentColor" fill="none"/>
            </svg>
            Back
        </a>
    </div>


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
        $mobile = htmlspecialchars($data['mobile']);
        $mediaType = htmlspecialchars($data['mediaType']);
        ?>

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
        <p class="copy-container">
            <a href="https://godsownwisdom.com" target="_blank" id="classLink">
                https://godsownwisdom.com # User: <?= $username; ?> # Pass: <?= $password; ?>
            </a>
            <button class="copy-button" onclick="copyClassLink()">
                <span class="material-icons">content_copy</span> Copy
            </button>
            <span id="copiedFeedback" class="copied-feedback">Copied!</span> <!-- "Copied" message -->

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
    // Navigate back using the back arrow
    // document.getElementById('backArrow').addEventListener('click', function (event) {
    //     event.preventDefault(); // Prevent default link behavior
    //     window.location.href = '/evngDashboard'; // Replace with your desired URL
    // });

    // Ensure the DOM is fully loaded before the function is called
    // Function to copy class link to clipboard
    // function copyClassLink() {
    //     // Get the text content of the class link
    //     const classLinkElement = document.getElementById('classLink');
    //
    //     // Ensure the element exists before proceeding
    //     if (classLinkElement) {
    //         const classLink = classLinkElement.textContent;
    //
    //         // Create a new textarea element to use for copying the content
    //         const textArea = document.createElement('textarea');
    //         textArea.value = classLink;  // Set the value of the textarea to the class link text
    //         document.body.appendChild(textArea);  // Append the textarea to the document body
    //         textArea.select();  // Select the text in the textarea
    //         textArea.setSelectionRange(0, 99999);  // For mobile devices
    //         document.execCommand('copy');  // Execute the copy command
    //         document.body.removeChild(textArea);  // Remove the textarea from the DOM
    //
    //         // Show "Copied!" feedback message
    //         const copiedFeedback = document.getElementById('copiedFeedback');
    //         copiedFeedback.classList.add('show'); // Show the "Copied!" text
    //
    //         // Hide the "Copied!" message after 2 seconds
    //         setTimeout(function() {
    //             copiedFeedback.classList.remove('show');
    //         }, 2000);
    //     } else {
    //         // If classLink element is not found, show an error
    //         console.error('Class Link element not found!');
    //     }
    // }

    function copyClassLink() {
        // Get the text content of the class link
        const classLinkElement = document.getElementById('classLink');

        // Ensure the element exists before proceeding
        if (classLinkElement) {
            const classLink = classLinkElement.textContent;

            // Use Clipboard API for modern browsers
            navigator.clipboard.writeText(classLink).then(function() {
                // Show "Copied!" feedback message
                const copiedFeedback = document.getElementById('copiedFeedback');
                copiedFeedback.classList.add('show'); // Show the "Copied!" text

                // Hide the "Copied!" message after 2 seconds
                setTimeout(function() {
                    copiedFeedback.classList.remove('show');
                }, 5000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        } else {
            // If classLink element is not found, show an error
            console.error('Class Link element not found!');
        }
    }

    // Ensure the DOM is fully loaded before any interactions
    document.addEventListener('DOMContentLoaded', function () {
        // Any other DOM-specific logic can be added here
    });

    function goBackToDetails() {
        // Base URL of the first view
        //const baseUrl = '/getClassDetails';

        <?php
        $region = $_ENV['REGION'];
        $baseUrl = '';

        if ($region === 'LOCAL') {
            $baseUrl = $_ENV['BASE_URL'];
        } elseif ($region === 'UAT') {
            $baseUrl = $_ENV['TEST_BASE_URL'];
        } elseif ($region === 'PROD') {
            $baseUrl = $_ENV['PROD_BASE_URL'];
        }
        ?>

        // JavaScript variable set by PHP
        const baseUrl = "<?php echo $baseUrl; ?>";


        //const baseUrl = 'http://localhost:9094/getClassDetails';

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
        const participantName = <?= json_encode($participant); ?>;

        // Prepare the new query parameters
        const url = new URL(baseUrl);
        url.searchParams.set('username', evangelist);  // Use evangelist for username
        url.searchParams.set('candidate', participantName);  // Original username
        url.searchParams.set('mobile', mobile);  // Original mobile
        url.searchParams.set('index', index);  // Correct index

        // Redirect to the new URL
        window.location.href = url.toString();
    }

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

</body>
</html>
