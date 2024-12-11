<?php

use app\core\Application;

//            echo '<pre>';
//            var_dump(Application::$app->user);
//            echo '</pre>';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>God's Own Wisdom</title>
    

    
  </head>
  <body>
<!--  <nav class="navbar navbar-expand-lg bg-body-tertiary">-->
<!--  <div class="container-fluid">-->
      <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-0">
              
   
          <div class="container">
<!--    <a class="navbar-brand" href="#"></a>-->
<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--      <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->
<!--    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!---->
<!--      <ul class="navbar-nav me-auto mb-2 mb-lg-0">-->
<!--        <ul class="navbar-nav mr-auto">-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link active" aria-current="page" href="/">Login</a>-->
        </li>
        <?php if (Application::isGuest()): ?>
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="/candidate">Add New Candidate</a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="/register">Request class</a>-->
<!--        </li>-->
        <?php else: ?>
<!--          <li class="nav-item">-->
<!--              <a class="nav-link" href="/profile">Profile</a>-->
<!--          </li>-->
<!--          <li class="nav-item">-->
<!--              <a class="nav-link" href="/video">Video</a>-->
<!--          </li>-->
<!--          <li class="nav-item">-->
<!--              <a class="nav-link" href="/test">Test</a>-->
<!--          </li>-->
<!--          <li class="nav-item">-->
<!--              <a class="nav-link" href="/logout">Welcome --><?php //echo Application::$app->user->getDisplayName() ?>
<!--              (Logout)</a>-->
<!--          </li>-->
            <ul class="navbar-nav ml-auto">
           <li class="nav-item" style="display: flex; align-items: center;">
              

               <img src="images/logo.jpg" alt="Logo" width="70" id="logo-image" style="pointer-events: none; margin-right: 5px;">
             <a class="nav-link" href="#" id="logout-link">
                 <!--<img src="images/logo.jpg" alt="Logo" width="50" id="logo-image">-->
                  <span style="margin-left: 10px;">
                   <!--<a class="getstarted scrollto" href="#" id="logout-link">-->
                  <!--Welcome <?php echo Application::$app->user->getDisplayName() ?> (Logout)-->
                   Welcome <?php echo Application::$app->user->getDisplayName() ?> &nbsp;&nbsp; <button type="button" class="btn btn-primary">Logout</button>
                   
              </a>
          </li>
            </ul>


      </ul>
        <?php endif; ?>
     
    </div>
</nav>
    <div class="container mt-4">
   {{content}}
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    if (video.readyState > 0)
        getDuration.call(video);
    // If metadata not loaded, use event to get it
    else
    {
        video.addEventListener('loadedmetadata', getDuration);
    }

    // Remember time user started the video
    function videoStartedPlaying() {
        timeStarted = new Date().getTime()/1000;
        
         playTimestamp = new Date().toISOString(); // Capture the play timestamp
        
      

        
    }

    function videoStoppedPlaying(event) {
        // Start time less than zero means stop event was fired without start event
        if (timeStarted > 0) {
            var playedFor = new Date().getTime()/1000 - timeStarted;
            timeStarted = -1;
            // Add the new number of seconds played
            timePlayed += playedFor;
            
            if (event.type === "ended") {
            timeEnded = new Date().getTime() / 1000;
        }
            
            
            
        }
        document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
        // Count as complete only if the end of the video was reached
        if (timePlayed >= duration && event.type == "ended") {
            document.getElementById("status").className = "complete";
        }
    }
    
    

    function getDuration() {
        duration = video.duration;
        document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
        console.log("Duration: ", duration);
    }
    
    function updateSessionVariable(key, value) {


        // Send an AJAX request to update the session variable
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_session", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(key + "=" + value);
    }

    video.addEventListener("play", videoStartedPlaying);
    video.addEventListener("playing", videoStartedPlaying);

    video.addEventListener("ended", videoStoppedPlaying);
    video.addEventListener("pause", videoStoppedPlaying);
        
    
        const logoutLink = document.getElementById('logout-link');
        
         const videoElement = document.getElementById('video');
         const audioElement = document.getElementById('audio');

        logoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default click behavior
            
             // Capture the logout timestamp
     logoutTimestamp = new Date().toISOString();
     
     // Convert playTimestamp and logoutTimestamp to Unix timestamps (milliseconds)
var playUnixTimestamp = new Date(playTimestamp).getTime();
var logoutUnixTimestamp = new Date(logoutTimestamp).getTime();

// Calculate the time difference in seconds
var timeElapsedInSeconds = (logoutUnixTimestamp - playUnixTimestamp) / 1000;
     

    
     if (timeStarted !== -1  && videoPaused === -1) {
        timePlayed = timeElapsedInSeconds;
    } 
    

            
            
  if (videoElement) {
    // Check if the video is currently playing (not paused)
    if (!videoElement.paused) {
        videoElement.pause(); // Pause the video
    }
      videoElement.src = "test2.php";
          // Update the session variable
        updateSessionVariable('watch_time', timePlayed);
            
}

if (audioElement) {
    // Check if the video is currently playing (not paused)
    if (!audioElement.paused) {
        audioElement.pause(); // Pause the video
    }
      audioElement.src = "test2.php";
       // Update the session variable
        updateSessionVariable('watch_time', timePlayed);
}





 // Make the fetch call to /swt here
        fetch('/swt', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Adjust the content type as needed
                // You may include any necessary headers, such as CSRF tokens or authentication tokens, here.
            },
            body: JSON.stringify({ watch_time: timePlayed }), // Include the data to send
        })
        .then(response => {
            if (response.status === 200) {
                // Handle a successful response
                console.log('SWT API call was successful');
            } else {
                // Handle errors or failure
                console.error('SWT API call failed');
                // You can display an error message to the user or take appropriate action.
            }
        })
        .catch(error => {
            console.error('Error during SWT API call:', error);
            // Handle network errors or other issues
        });




        

 // Redirect to the login page immediately
        // window.location.href = '/';

            // Make an AJAX request to the /logout endpoint
            fetch('/logout', {
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
                    window.location.href = '/'; // Redirect to the homepage
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
    var audio = document.getElementById("audio");

    var timeStarted = -1;
    var timePlayed = 0;
    var duration = 0;
    
    var timeEnded = 0;
    var playTimestamp = null;
    var logoutTimestamp = null;
    var audioPaused = -1;
    
   
    // If video metadata is loaded, get duration
    if (audio.readyState > 0)
        getDuration.call(audio);
    // If metadata not loaded, use event to get it
    else
    {
        audio.addEventListener('loadedmetadata', getDuration);
    }

    // Remember time user started the audio
    function audioStartedPlaying() {
        timeStarted = new Date().getTime()/1000;
        
         playTimestamp = new Date().toISOString(); // Capture the play timestamp
        
      

        
    }

    function audioStoppedPlaying(event) {
        // Start time less than zero means stop event was fired without start event
        if (timeStarted > 0) {
            var playedFor = new Date().getTime()/1000 - timeStarted;
            timeStarted = -1;
            // Add the new number of seconds played
            timePlayed += playedFor;
            
            if (event.type === "ended") {
            timeEnded = new Date().getTime() / 1000;
        }
            
            
            
        }
        document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
        // Count as complete only if the end of the audio was reached
        if (timePlayed >= duration && event.type == "ended") {
            document.getElementById("status").className = "complete";
        }
    }
    
    

    function getDuration() {
        duration = audio.duration;
        document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
        console.log("Duration: ", duration);
    }
    
    function updateSessionVariable(key, value) {


        // Send an AJAX request to update the session variable
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_session", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(key + "=" + value);
    }

    audio.addEventListener("play", audioStartedPlaying);
    audio.addEventListener("playing", audioStartedPlaying);

    audio.addEventListener("ended", audioStoppedPlaying);
    audio.addEventListener("pause", audioStoppedPlaying);
        
    
        const logoutLink = document.getElementById('logout-link');
         const audioElement = document.getElementById('audio');

        logoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default click behavior
            
             // Capture the logout timestamp
     logoutTimestamp = new Date().toISOString();
     
     // Convert playTimestamp and logoutTimestamp to Unix timestamps (milliseconds)
var playUnixTimestamp = new Date(playTimestamp).getTime();
var logoutUnixTimestamp = new Date(logoutTimestamp).getTime();

// Calculate the time difference in seconds
var timeElapsedInSeconds = (logoutUnixTimestamp - playUnixTimestamp) / 1000;
     

    
     if (timeStarted !== -1  && audioPaused === -1) {
        timePlayed = timeElapsedInSeconds;
    } 
    

            
            
  if (audioElement) {
    // Check if the video is currently playing (not paused)
    if (!audioElement.paused) {
        audioElement.pause(); // Pause the audio
    }
      audioElement.src = "test2.php";
          // Update the session variable
        updateSessionVariable('watch_time', timePlayed);
            
}

if (audioElement) {
    // Check if the video is currently playing (not paused)
    if (!audioElement.paused) {
        audioElement.pause(); // Pause the audio
    }
      audioElement.src = "test2.php";
       // Update the session variable
        updateSessionVariable('watch_time', timePlayed);
}





 // Make the fetch call to /swt here
        fetch('/swt', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Adjust the content type as needed
                // You may include any necessary headers, such as CSRF tokens or authentication tokens, here.
            },
            body: JSON.stringify({ watch_time: timePlayed }), // Include the data to send
        })
        .then(response => {
            if (response.status === 200) {
                // Handle a successful response
                console.log('SWT API call was successful');
            } else {
                // Handle errors or failure
                console.error('SWT API call failed');
                // You can display an error message to the user or take appropriate action.
            }
        })
        .catch(error => {
            console.error('Error during SWT API call:', error);
            // Handle network errors or other issues
        });




        

 // Redirect to the login page immediately
        // window.location.href = '/';

            // Make an AJAX request to the /logout endpoint
            fetch('/logout', {
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
                    window.location.href = '/'; // Redirect to the homepage
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

<script>
    // JavaScript Code
    
</script>




  </body>
</html>