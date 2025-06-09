<?php
/** @var $model \app\models\RegisterModel */
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Request</title>
    <style>
        /* CSS for positioning the logout button at the top-right corner */
        .navbar {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            background-color: #ffffff;
        }

        .navbar a {
            text-decoration: none;
        }

        .logout-button {
            margin-left: auto;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="#" id="logout-link">
        <button type="button" class="logout-button">Logout</button>
    </a>
</div>

<div class="container">
    <h1>Class Request</h1>

<?php $form = \app\core\form\Form::begin('',"post")  ?>
<input type="hidden" name="recordDate" value="<?php echo htmlspecialchars($model->recordDate); ?>">
<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
$index = app\core\Application::$app->session->get('index7D');
// Default value for evangelist
$mobile = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[$index]->mobile)) {
// Get the evangelist value from the first element
    $mobile = $evangelistData[$index]->mobile;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'mobile')->dropdownField([
    $mobile => $mobile, // Set the retrieved evangelist as both the key and the value
// Add other options if needed
]);
?>
<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
$index = app\core\Application::$app->session->get('index7D');
// Default value for evangelist
$participant = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[$index]->participantName)) {
// Get the evangelist value from the first element
    $participant = $evangelistData[$index]->participantName;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'participant')->dropdownField([
    $participant => $participant, // Set the retrieved evangelist as both the key and the value
// Add other options if needed
]);
?>
<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
// Default value for evangelist
$evangelist = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[0]->evangelist)) {
// Get the evangelist value from the first element
$evangelist = $evangelistData[0]->evangelist;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'evangelist')->dropdownField([
$evangelist => $evangelist, // Set the retrieved evangelist as both the key and the value
// Add other options if needed
]);
?>

<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
$index = app\core\Application::$app->session->get('index7D');
// Default value for evangelist
$wgroup = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[$index]->wgroup)) {
// Get the evangelist value from the first element
    $wgroup = $evangelistData[$index]->wgroup;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'wgroup')->dropdownField([
    $wgroup => $wgroup, // Set the retrieved evangelist as both the key and the value
// Add other options if needed
]);
?>
<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
$index = app\core\Application::$app->session->get('index7D');
// Default value for evangelist
$language = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[$index]->language)) {
// Get the evangelist value from the first element
    $language = $evangelistData[$index]->language;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'language')->dropdownField([
    $language => $language, // Set the retrieved evangelist as both the key and the value
// Add other options if needed
]);
?>
<?php
// Define language to class mapping
//$languageToClassCount = [
//    'English' => 37,
//    'Spanish' => 35,
//    'Malayalam' => 44,
//    'Hindi' => 34,
//    'Tamil' => 53,
//    'Italian' => 52,
//    'Portuguese' => 45,
//    'French' => 35,
//    'Arabic' => 35,
//    'Kanada' => 35,
//    'Konkani-Goan' => 37,
//    'Konkani-Mangalore' => 35,
//    'Tagalog' => 44,
//    // Add more languages as needed
//];

$languageToClassCount = require_once 'language_class_mappings7D.php';

// Assuming $language is defined and represents the current language
$classOptions = [];

// Check if the current language exists in the mapping
if (array_key_exists($language, $languageToClassCount)) {
    // Generate options for classFrom dropdown based on the mapped value
    for ($i = 2; $i <= $languageToClassCount[$language]; $i++) {
        $classOptions[$i] = $i;
    }



    // Render the form field with the retrieved class options
    echo $form->field($model, 'classFrom')->dropdownField(
        $classOptions,
        ['prompt' => 'Select Class From'] // Optional prompt text
    );
} else {
    // Handle case where language is not found in the mapping (optional)
    echo "Language not supported.";
}
?>
<input type="hidden" name="expiryDate" value="<?php echo htmlspecialchars($model->expiryDate); ?>">
<input type="hidden" name="classTo" value="<?php echo htmlspecialchars($model->classTo); ?>">
<?php echo $form->field($model,'status')->dropdownField([
    'Ongoing' => 'Ongoing',
    'Repeating' => 'Repeating'
]) ?>
<?php echo $form->field($model,'mediaType')->dropdownField([
    'Web Audio' => 'Web Audio'
]) ?>

<!--    --><?php
//    // The mediaType is passed directly from the controller
//    $mediaType = isset($mediaType) ? $mediaType : ''; // Default to empty if not set
//
//    // Transform mediaType to Web Video or Web Audio if needed
//    if ($mediaType === 'Video') {
//        $mediaType = 'Web Video';
//    } elseif ($mediaType === 'Audio') {
//        $mediaType = 'Web Audio';
//    }
//
//
//    // Define allowed media types
//    $allowedMediaTypes = [
//        'Web Video' => 'Web Video',
//        'Web Audio' => 'Web Audio',
//    ];
//
//    // Create an array for the dropdown options
//    $options = array_merge([$mediaType => $mediaType], $allowedMediaTypes);
//
//    // Render the form field with the mediaType as the default value
//    echo $form->field($model, 'mediaType')->dropdownField($options);
//    ?>



<?php echo $form->field($model,'remark')  ?>
<?php echo $form->field($model,'classLink')  ?>
<?php echo $form->field($model,'feedback')  ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData7');
$index = app\core\Application::$app->session->get('index7D');
?>

<a href="/getClassDetails7D?username=<?= urlencode($evangelist); ?>&candidate=<?= urlencode($participant); ?>&mobile=<?= urlencode($mobile); ?>&index=<?= urlencode($index); ?>" class="btn btn-secondary">Back</a>
<?php  \app\core\form\Form::end()  ?>


<!---->
<!--<form action ="" method = "post">-->
<!--  <div class="form-group">-->
<!--    <label>Record Date</label>-->
<!--    <input type="text" name="recordDate" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Mobile</label>-->
<!--    <input type="text" name="mobile" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Participant Name</label>-->
<!--    <input type="text" name="participant" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Evangelist</label>-->
<!--    <input type="text" name="evangelist" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>WhatsApp Group</label>-->
<!--    <input type="text" name="wgroup" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Language</label>-->
<!--    <input type="text" name="language" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Expiry Date and Time</label>-->
<!--    <input type="text" name="expiryDate" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Class From</label>-->
<!--    <input type="text" name="classFrom" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Class To</label>-->
<!--    <input type="text" name="classTo" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Status</label>-->
<!--    <input type="text" name="status" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Media Type</label>-->
<!--    <input type="text" name="mediaType" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Remark</label>-->
<!--    <input type="text" name="remark" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Class Link</label>-->
<!--    <input type="text" name="classLink" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Participant Feedback</label>-->
<!--    <input type="text" name="feedback" class="form-control">-->
<!--  </div>-->
<!--  <button type="submit" class="btn btn-primary">Submit</button>-->
<!--</form>-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var video = document.getElementById("video");

            var timeStarted = -1;
            var timePlayed = 0;
            var duration = 0;

            var timeEnded = 0;
            var playTimestamp = null;
            var logoutTimestamp = null;
            var videoPaused = -1;


            // If video metadata is loaded, get duration
            // if (video.readyState > 0)
            //     getDuration.call(video);
            // // If metadata not loaded, use event to get it
            // else
            // {
            //     video.addEventListener('loadedmetadata', getDuration);
            // }

            // Remember time user started the video
            // function videoStartedPlaying() {
            //     timeStarted = new Date().getTime()/1000;
            //
            //      playTimestamp = new Date().toISOString(); // Capture the play timestamp
            //
            //
            //
            //
            // }

            // function videoStoppedPlaying(event) {
            //     // Start time less than zero means stop event was fired without start event
            //     if (timeStarted > 0) {
            //         var playedFor = new Date().getTime()/1000 - timeStarted;
            //         timeStarted = -1;
            //         // Add the new number of seconds played
            //         timePlayed += playedFor;
            //
            //         if (event.type === "ended") {
            //         timeEnded = new Date().getTime() / 1000;
            //     }
            //
            //
            //
            //     }
            //     document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
            //     // Count as complete only if the end of the video was reached
            //     if (timePlayed >= duration && event.type == "ended") {
            //         document.getElementById("status").className = "complete";
            //     }
            // }
            //


            // function getDuration() {
            //     duration = video.duration;
            //     document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
            //     console.log("Duration: ", duration);
            // }
            //
            // function updateSessionVariable(key, value) {
            //
            //
            //     // Send an AJAX request to update the session variable
            //     var xhr = new XMLHttpRequest();
            //     xhr.open("POST", "update_session", true);
            //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            //     xhr.send(key + "=" + value);
            // }
            //
            // video.addEventListener("play", videoStartedPlaying);
            // video.addEventListener("playing", videoStartedPlaying);
            //
            // video.addEventListener("ended", videoStoppedPlaying);
            // video.addEventListener("pause", videoStoppedPlaying);


            const logoutLink = document.getElementById('logout-link');
            //
            // const videoElement = document.getElementById('video');
            // const audioElement = document.getElementById('audio');

            logoutLink.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default click behavior

                // Capture the logout timestamp
                logoutTimestamp = new Date().toISOString();

                // Convert playTimestamp and logoutTimestamp to Unix timestamps (milliseconds)
// var playUnixTimestamp = new Date(playTimestamp).getTime();
// var logoutUnixTimestamp = new Date(logoutTimestamp).getTime();

// Calculate the time difference in seconds
// var timeElapsedInSeconds = (logoutUnixTimestamp - playUnixTimestamp) / 1000;
//
//
//
//      if (timeStarted !== -1  && videoPaused === -1) {
//         timePlayed = timeElapsedInSeconds;
//     }
//
//
//
//
//   if (videoElement) {
//     // Check if the video is currently playing (not paused)
//     if (!videoElement.paused) {
//         videoElement.pause(); // Pause the video
//     }
//       videoElement.src = "test2.php";
//           // Update the session variable
//         updateSessionVariable('watch_time', timePlayed);
//
// }
//
// if (audioElement) {
//     // Check if the video is currently playing (not paused)
//     if (!audioElement.paused) {
//         audioElement.pause(); // Pause the video
//     }
//       audioElement.src = "test2.php";
//        // Update the session variable
//         updateSessionVariable('watch_time', timePlayed);
// }




                //
                // // Make the fetch call to /swt here
                //        fetch('/swt', {
                //            method: 'POST',
                //            headers: {
                //                'Content-Type': 'application/json', // Adjust the content type as needed
                //                // You may include any necessary headers, such as CSRF tokens or authentication tokens, here.
                //            },
                //            body: JSON.stringify({ watch_time: timePlayed }), // Include the data to send
                //        })
                //        .then(response => {
                //            if (response.status === 200) {
                //                // Handle a successful response
                //                console.log('SWT API call was successful');
                //            } else {
                //                // Handle errors or failure
                //                console.error('SWT API call failed');
                //                // You can display an error message to the user or take appropriate action.
                //            }
                //        })
                //        .catch(error => {
                //            console.error('Error during SWT API call:', error);
                //            // Handle network errors or other issues
                //        });
                //
                //




                // Redirect to the login page immediately
                // window.location.href = '/';

                // Make an AJAX request to the /logout endpoint
                fetch('/logoutEv', {
                    method: 'POST', // or 'GET' if your API supports GET requests for logout
                    headers: {
                        'Content-Type': 'application/json', // Adjust the content type as needed
                        // You may include any necessary headers, such as CSRF tokens or authentication tokens, here.
                    },
                })
                    .then(response => {
                        if (response.status === 200) {
                            // Logout was successful
                            // You can redirect the user to the homepage or perform any other actions.
                            window.location.href = '/login'; // Redirect to the homepage
                        } else {
                            // Handle logout failure or errors
                            console.error('Logout failed');
                            // You can display an error message to the user or take appropriate action.
                        }
                    })
                    .catch(error => {
                        console.error('Error during logout:', error);
                        // Handle network errors or other issues
                    });
            });
        });
    </script>
</body>
</html>