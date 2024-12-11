<?php
/** @var $model \app\models\CandidateModel */
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
<!--        <h1 class="display-5">Add New Candidate</h1>-->
        <h1>  </h1>
        <a class="btn btn-primary btn-sm" href="#" id="logout-link">Logout</a>
    </div>




<?php $form = \app\core\form\Form::begin('',"post")  ?>


    <div class="mbsc-row">
        <div class="mbsc-col-12 mbsc-col-md-6 mbsc-col-lg-3">
<?php echo $form->field($model,'mobile')  ?>
        </div>

<input type="hidden" name="recordDate" value="<?php echo htmlspecialchars($model->recordDate); ?>">
<?php echo $form->field($model,'participantName')  ?>
<?php echo $form->field($model, 'country')->dropdownField([
    'Afghanistan' => 'Afghanistan',
    'Albania' => 'Albania',
    'Algeria' => 'Algeria',
    'Andorra' => 'Andorra',
    'Angola' => 'Angola',
    'Antigua and Barbuda' => 'Antigua and Barbuda',
    'Argentina' => 'Argentina',
    'Armenia' => 'Armenia',
    'Australia' => 'Australia',
    'Austria' => 'Austria',
    'Azerbaijan' => 'Azerbaijan',
    'Bahamas' => 'Bahamas',
    'Bahrain' => 'Bahrain',
    'Bangladesh' => 'Bangladesh',
    'Barbados' => 'Barbados',
    'Belarus' => 'Belarus',
    'Belgium' => 'Belgium',
    'Belize' => 'Belize',
    'Benin' => 'Benin',
    'Bhutan' => 'Bhutan',
    'Bolivia' => 'Bolivia',
    'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
    'Botswana' => 'Botswana',
    'Brazil' => 'Brazil',
    'Brunei' => 'Brunei',
    'Bulgaria' => 'Bulgaria',
    'Burkina Faso' => 'Burkina Faso',
    'Burundi' => 'Burundi',
    'Côte d\'Ivoire' => 'Côte d\'Ivoire',
    'Cabo Verde' => 'Cabo Verde',
    'Cambodia' => 'Cambodia',
    'Cameroon' => 'Cameroon',
    'Canada' => 'Canada',
    'Central African Republic' => 'Central African Republic',
    'Chad' => 'Chad',
    'Chile' => 'Chile',
    'China' => 'China',
    'Colombia' => 'Colombia',
    'Comoros' => 'Comoros',
    'Congo (Congo-Brazzaville)' => 'Congo (Congo-Brazzaville)',
    'Costa Rica' => 'Costa Rica',
    'Croatia' => 'Croatia',
    'Cuba' => 'Cuba',
    'Cyprus' => 'Cyprus',
    'Czechia (Czech Republic)' => 'Czechia (Czech Republic)',
    'Democratic Republic of the Congo' => 'Democratic Republic of the Congo',
    'Denmark' => 'Denmark',
    'Djibouti' => 'Djibouti',
    'Dominica' => 'Dominica',
    'Dominican Republic' => 'Dominican Republic',
    'Ecuador' => 'Ecuador',
    'Egypt' => 'Egypt',
    'El Salvador' => 'El Salvador',
    'Equatorial Guinea' => 'Equatorial Guinea',
    'Eritrea' => 'Eritrea',
    'Estonia' => 'Estonia',
    'Eswatini (fmr. "Swaziland")' => 'Eswatini (fmr. "Swaziland")',
    'Ethiopia' => 'Ethiopia',
    'Fiji' => 'Fiji',
    'Finland' => 'Finland',
    'France' => 'France',
    'Gabon' => 'Gabon',
    'Gambia' => 'Gambia',
    'Georgia' => 'Georgia',
    'Germany' => 'Germany',
    'Ghana' => 'Ghana',
    'Greece' => 'Greece',
    'Greenland' => 'Greenland',
    'Grenada' => 'Grenada',
    'Guatemala' => 'Guatemala',
    'Guinea' => 'Guinea',
    'Guinea-Bissau' => 'Guinea-Bissau',
    'Guyana' => 'Guyana',
    'Haiti' => 'Haiti',
    'Holy See' => 'Holy See',
    'Honduras' => 'Honduras',
    'Hungary' => 'Hungary',
    'Iceland' => 'Iceland',
    'Indonesia' => 'Indonesia',
    'Iran' => 'Iran',
    'Iraq' => 'Iraq',
    'Ireland' => 'Ireland',
    'Israel' => 'Israel',
    'Italy' => 'Italy',
    'Jamaica' => 'Jamaica',
    'Japan' => 'Japan',
    'Jordan' => 'Jordan',
    'Kazakhstan' => 'Kazakhstan',
    'Kenya' => 'Kenya',
    'Kiribati' => 'Kiribati',
    'Kuwait' => 'Kuwait',
    'Kyrgyzstan' => 'Kyrgyzstan',
    'Laos' => 'Laos',
    'Latvia' => 'Latvia',
    'Lebanon' => 'Lebanon',
    'Lesotho' => 'Lesotho',
    'Liberia' => 'Liberia',
    'Libya' => 'Libya',
    'Liechtenstein' => 'Liechtenstein',
    'Lithuania' => 'Lithuania',
    'Luxembourg' => 'Luxembourg',
    'Madagascar' => 'Madagascar',
    'Malawi' => 'Malawi',
    'Malaysia' => 'Malaysia',
    'Maldives' => 'Maldives',
    'Mali' => 'Mali',
    'Malta' => 'Malta',
    'Marshall Islands' => 'Marshall Islands',
    'Mauritania' => 'Mauritania',
    'Mauritius' => 'Mauritius',
    'Mexico' => 'Mexico',
    'Micronesia' => 'Micronesia',
    'Moldova' => 'Moldova',
    'Monaco' => 'Monaco',
    'Mongolia' => 'Mongolia',
    'Montenegro' => 'Montenegro',
    'Morocco' => 'Morocco',
    'Mozambique' => 'Mozambique',
    'Myanmar (formerly Burma)' => 'Myanmar (formerly Burma)',
    'Namibia' => 'Namibia',
    'Nauru' => 'Nauru',
    'Nepal' => 'Nepal',
    'Netherlands' => 'Netherlands',
    'New Zealand' => 'New Zealand',
    'Nicaragua' => 'Nicaragua',
    'Niger' => 'Niger',
    'Nigeria' => 'Nigeria',
    'North Korea' => 'North Korea',
    'North Macedonia' => 'North Macedonia',
    'Norway' => 'Norway',
    'Oman' => 'Oman',
    'Palau' => 'Palau',
    'Palestine State' => 'Palestine State',
    'Panama' => 'Panama',
    'Papua New Guinea' => 'Papua New Guinea',
    'Paraguay' => 'Paraguay',
    'Peru' => 'Peru',
    'Philippines' => 'Philippines',
    'Poland' => 'Poland',
    'Portugal' => 'Portugal',
    'Puerto Rico' => 'Puerto Rico',
    'Qatar' => 'Qatar',
    'Romania' => 'Romania',
    'Russia' => 'Russia',
    'Rwanda' => 'Rwanda',
    'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
    'Saint Lucia' => 'Saint Lucia',
    'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
    'Samoa' => 'Samoa',
    'San Marino' => 'San Marino',
    'Sao Tome and Principe' => 'Sao Tome and Principe',
    'Saudi Arabia' => 'Saudi Arabia',
    'Senegal' => 'Senegal',
    'Serbia' => 'Serbia',
    'Seychelles' => 'Seychelles',
    'Sierra Leone' => 'Sierra Leone',
    'Singapore' => 'Singapore',
    'Slovakia' => 'Slovakia',
    'Slovenia' => 'Slovenia',
    'Solomon Islands' => 'Solomon Islands',
    'Somalia' => 'Somalia',
    'South Africa' => 'South Africa',
    'South Korea' => 'South Korea',
    'South Sudan' => 'South Sudan',
    'Spain' => 'Spain',
    'Sri Lanka' => 'Sri Lanka',
    'Sudan' => 'Sudan',
    'Suriname' => 'Suriname',
    'Sweden' => 'Sweden',
    'Switzerland' => 'Switzerland',
    'Syria' => 'Syria',
    'Taiwan' => 'Taiwan',
    'Tajikistan' => 'Tajikistan',
    'Tanzania' => 'Tanzania',
    'Thailand' => 'Thailand',
    'Timor-Leste' => 'Timor-Leste',
    'Togo' => 'Togo',
    'Tonga' => 'Tonga',
    'Trinidad and Tobago' => 'Trinidad and Tobago',
    'Tunisia' => 'Tunisia',
    'Turkey' => 'Turkey',
    'Turkmenistan' => 'Turkmenistan',
    'Tuvalu' => 'Tuvalu',
    'Uganda' => 'Uganda',
    'Ukraine' => 'Ukraine',
    'United Arab Emirates' => 'United Arab Emirates',
    'United Kingdom' => 'United Kingdom',
    'United States of America' => 'United States of America',
    'Uruguay' => 'Uruguay',
    'Uzbekistan' => 'Uzbekistan',
    'Vanuatu' => 'Vanuatu',
    'Venezuela' => 'Venezuela',
    'Vietnam' => 'Vietnam',
    'Yemen' => 'Yemen',
    'Zambia' => 'Zambia'
]) ?>

<?php echo $form->field($model, 'language')->dropdownField([
    'English' => 'English',
    'Kannada' => 'Kannada',
    'Konkani-Goan' => 'Konkani-Goan',
    'Konkani-Mangalore' => 'Konkani-Mangalore',
    'Portuguese' => 'Portuguese',
    'Hindi' => 'Hindi',
    'Italian' => 'Italian',
    'Malayalam' => 'Malayalam',
    'Spanish' => 'Spanish',
    'Tamil' => 'Tamil',
    'Tagalog' => 'Tagalog',
    'Arabic' => 'Arabic',
    'French' => 'French'
]) ?>


<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData');
$evangelist2 = \app\core\Application::$app->session->get('evngName');


// Default value for evangelist
$evangelist = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[0]->evangelist)) {
    // Get the evangelist value from the first element
    $evangelist = $evangelist2;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'evangelist')->dropdownField([
    $evangelist2 => $evangelist2, // Set the retrieved evangelist as both the key and the value
    // Add other options if needed
]);
?>


<?php echo $form->field($model,'source')->dropdownField([
    'Facebook' => 'Facebook',
    'TeleCall' => 'TeleCall',
    'Telegram' => 'Telegram',
    'Twitter' => 'Twitter'
]) ?>
<?php echo $form->field($model,'allotedDays')->dropdownField([
    'Random' => 'Random Days',
    'Sunday' => 'Sunday',
    'Monday' => 'Monday',
    'Tuesday' => 'Tuesday',
    'Wednesday' => 'Wednesday',
    'Thursday' => 'Thursday',
    'Friday' => 'Friday',
    'Saturday' => 'Saturday',
    'SatSun' => 'Saturday / Sunday',
    'Daily' => 'Daily'
]) ?>
<?php echo $form->field($model,'mediaType')->dropdownField([
    'Web Video' => 'Web Video',
    'Web Audio' => 'Web Audio'
]) ?>
<?php echo $form->field($model,'activeStatus')->dropdownField([
    'Active' => 'Active',
    'Exit' => 'Exit/Drop-out',
    'Completed' => 'Completed',
    'Withdrawn' => 'Withdrawn',
    'Inactive' => 'Inactive'
]) ?>


<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData2');

// Default value for evangelist
$wgroup = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[0]->wgroupId)) {
    // Get the evangelist value from the first element
    $wgroup = $evangelistData[0]->wgroupId;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'wgroup')->dropdownField([
    $wgroup => $wgroup, // Set the retrieved evangelist as both the key and the value
    // Add other options if needed
]);
?>


<?php
// Get evangelist data from session
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData2');

// Default value for evangelist
$email = '';

// Check if evangelistData is not empty and the first element has the evangelist property
if (!empty($evangelistData) && isset($evangelistData[0]->email)) {
    // Get the evangelist value from the first element
    $email = $evangelistData[0]->email;
}

// Render the form field with the retrieved evangelist value
echo $form->field($model, 'userid')->dropdownField([
    $email => $email, // Set the retrieved evangelist as both the key and the value
    // Add other options if needed
]);
?>
<?php echo $form->field($model,'remark')  ?>
<button type="submit" class="btn btn-primary">Submit</button>
<!-- Add a back button -->
<a href="/evngDashboard1" class="btn btn-secondary">Back</a>

<?php  \app\core\form\Form::end()  ?>

<?php  \app\core\form\Form::end()  ?>

<!--<form action ="" method = "post">-->
<!--<div class="form-group">-->
<!--    <label>Mobile</label>-->
<!--    <input type="text" name="mobile" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Record Date</label>-->
<!--    <input type="text" name="recordDate" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Participant Name</label>-->
<!--    <input type="text" name="participant" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Country</label>-->
<!--    <input type="text" name="country" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Language</label>-->
<!--    <input type="text" name="language" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Evangelist</label>-->
<!--    <input type="text" name="evangelist" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Source</label>-->
<!--    <input type="text" name="source" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Alloted Days</label>-->
<!--    <input type="text" name="allotedDays" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Media Type</label>-->
<!--    <input type="text" name="mediaType" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Active Status</label>-->
<!--    <input type="text" name="status" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>USERID</label>-->
<!--    <input type="email" name="userID" class="form-control">-->
<!--  </div>-->
<!--  <div class="form-group">-->
<!--    <label>Remark</label>-->
<!--    <input type="text" name="remark" class="form-control">-->
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