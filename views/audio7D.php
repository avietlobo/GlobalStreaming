<?php
/** @var $model \app\models\RegisterModel */
?>
<?php
/** @var $model \app\models\RegisterModel */

// Start a new session or resume the existing session
//session_start();

// Set session variables for language and classFrom
$_SESSION['language'] = $model->language;
$_SESSION['classFrom'] = $model->classFrom;
$_SESSION['participant'] = $model->participant;
$_SESSION['evangelist'] = $model->evangelist;
$_SESSION['password'] = $model->password;
// error_log("participant from video.php: " . $_SESSION['participant']);

// Define different text for different languages
if ($_SESSION['language'] === 'English') {
    $text = "But we speak God’s wisdom, a hidden mystery, which God decreed before the ages for our glory (1 Cor 2:7)";
} elseif ($_SESSION['language'] === 'Spanish') {
    $text = "Sino hablamos sabiduría de Dios en misterio, la sabiduría oculta; la cual Dios predestinó antes de los siglos para nuestra gloria (1 Cor 2:7)";
} 
elseif ($_SESSION['language'] === 'Hindi') {
    
 $text = "इसके स्थान पर हम तो परमेश्वर के उस रहस्यपूर्ण विवेक को देते हैं जो छिपा हुआ था और जिसे अनादि काल से परमेश्वर ने हमारी महिमा के लिये निश्चित किया था। (1 कोर 2:7)";
}
elseif ($_SESSION['language'] === 'Italian') {
    $text = "Parliamo invece della sapienza di Dio, che è nel mistero, che è rimasta nascosta e che Dio ha stabilito prima dei secoli per la nostra gloria. (1 Cor 2:7)";
}

elseif ($_SESSION['language'] === 'French') {
    $text = "Nous prêchons la sagesse de Dieu, mystérieuse et cachée, que Dieu, avant les siècles, avait destinée pour notre gloire, (1 Cor 2:7)";
}

elseif ($_SESSION['language'] === 'Portuguese') {
    $text = "Mas falamos a sabedoria de Deus em mistério, que esteve oculta, a qual Deus preordenou antes dos séculos para nossa glória; (1 Cor 2:7)";
}

elseif ($_SESSION['language'] === 'Tagalog') {
    $text = "Subalit ang ipinapahayag namin ay ang lihim na karunungan ng Diyos na hindi nahayag noong una, na itinalaga na niya para sa ating ikaluluwalhati bago pa likhain ang sanlibutan.(1 Cor 2:7)";
}

elseif ($_SESSION['language'] === 'Tamil') {
    $text = "உலகத்தோற்றத்திற்கு முன்னே தேவன் நம்முடைய மகிமைக்காக ஏற்படுத்தினதும், மறைக்கப்பட்டதுமாயிருந்த இரகசியமான தேவஞானத்தையே பேசுகிறோம் (1கொரி 2:7)";
}

elseif ($_SESSION['language'] === 'Malayalam') {
    $text = "രഹസ്യവും നിഗൂഢവുമായ ദൈവികജ്‌ഞാനമാണു ഞങ്ങള്‍ പ്രസംഗിക്കുന്നത്‌. അതു നമ്മുടെ മഹത്വത്തിനായിയുഗങ്ങള്‍ക്കുമുമ്പ്‌തന്നെ ദൈവം നിശ്‌ചയിച്ചിട്ടുള്ളതുമാണ്‌.
1 കോറിന്തോസ്‌ 2:7";
}

elseif ($_SESSION['language'] === 'Konkani-Goan') {
    $text = "Ami porgôtt kortanv ti zannvai Devachi guddart zannvai: ti lipoun dovôrloli zannvai; ti Devan kallam-iugam adim amchê mhoimê khatir fuddench tharail’li. (1 Kor 2:7)";
}


else {
    // Default text for other languages
    $text = "But we speak God’s wisdom, a hidden mystery, which God decreed before the ages for our glory (1 Cor 2:7)";
}

session_write_close();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Audio Streaming</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 100%;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }
        video {
            max-width: 100%;
            height: auto;
        }
        
        .image-container {
        text-align: center; /* Center the image horizontally */
         margin-bottom: 20px;
    }

    /* Define the CSS styles for the audio container */
    .audio-container {
        text-align: center; /* Center the audio player horizontally */
    }
    </style>
<!--    <link rel="stylesheet" href="file/plyr.scss" />-->
    <!--<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />-->

    <!-- Include Plyr JS -->
<!--    <script src="file/plyr.js"></script>-->


    <!--<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>-->
    
    </style>
      <style>
        /* CSS Code */
        #status span.status {
            display: none;
            font-weight: bold;
        }

        span.status.complete {
            color: green;
        }

        span.status.incomplete {
            color: red;
        }

        #status.complete span.status.complete {
            display: inline;
        }

        #status.incomplete span.status.incomplete {
            display: inline;
        }
    </style>

</head>

<body>
<!--<h1>Audio Stream  </h1>-->
<!--<h4>Candidate <?php echo $model->participant  ?> is requesting for <?php echo $model->language  ?> class Number <?php echo $model->classFrom.','.$model->classTo ?> in <?php echo $model->mediaType ?> format</h4>-->
<div class="container">
    
       <p style="font-weight: bold;"><?php echo $text; ?></p>
   
<!--<video  controls width="640" height="340">-->
<!--    controlsList="nodownload"-->
<!--    <source src="stream.php?file=--><?php //echo urlencode($model->language.$model->classFrom); ?><!--" type="video/mp4">-->

<!--    <source src="stream3.php?file=--><?php //echo urlencode($model->language . '_' . $model->classFrom); ?><!--" type="video/mp4">-->
<!--    <source src="stream3.php?file=--><?php //echo urlencode($model->language . '_' . $model->classFrom); ?><!--" type="video/mp4">-->


<!--        <source src="test.php" type="video/mp4">-->

     <!--<source id="video-source" type="audio/mp3">-->
     
     <!--<audio autoplay loop id="video-source" controls>-->
              <!--<audio autoplay id="video-source" controls>-->
             
                  <div class="image-container">
                 <img src="images/bg-1.jpg" alt="Image description" width="200" height="200">
                 </div>


                   <div class="audio-container">
                  
                  <!--<audio autoplay controls>-->
                  <audio controls id="audio" controlsList="nodownload">
                  
         <!--<audio controls autoplay >-->
                  
                  <!--Line 93 was previous code when we were passing query parameters-->
                  <!--<source src="test1.php?language=<?php echo urlencode($model->language); ?>&classFrom=<?php echo urlencode($model->classFrom); ?>" type="audio/mp3">-->
                  
                    <source src="test17D.php?language=<?php echo urlencode($model->language); ?>" type="audio/mp3" >
                  
                   <!--<source src="mySong.aac" type="audio/mp3">-->
                      
                 <!--<source src="test1.php?language=--><?php echo urlencode($model->language); ?><!--&classFrom=--><?php echo urlencode($model->classFrom); ?><!--" type="audio/mp3">-->
                    
                      </audio>
                      
                      </div>
                      
                      <!--<button id="playButton">Play Audio</button>-->
     
     <!--<audio id="video-source" controls>-->
         
    
     <!--</audio-->
     
     
     <!--<audio id="video-source" type="audio/mp3" controls>-->
    
<!--    <source src="test.php?language=--><?php //echo urlencode($model->language); ?><!--&classFrom=--><?php //echo urlencode($model->classFrom); ?><!--" type="video/mp4">-->





</audio>
</div>
<!--<div id="status" class="incomplete">-->
<!--        <span>Play status: </span>-->
<!--        <span class="status complete">COMPLETE</span>-->
<!--        <span class="status incomplete">INCOMPLETE</span>-->
<!--        <br />-->
<!--    </div>-->

<!--    <div>-->
<!--        <span id="played">0</span> seconds out of-->
<!--        <span id="duration"></span> seconds. (only updates when the video pauses)-->
<!--    </div>-->


<script type = "text/javascript">
    // import Plyr from "../public/file/plyr";

    // document.addEventListener("DOMContentLoaded", () => {
    //     const player = new Plyr('.plyr__audio-embed audio');
    // });
document.addEventListener('contextmenu', event => event.preventDefault());
// Use JavaScript to generate the video source dynamically



// var language = '<?php echo $model->language; ?>';
// var classFrom = '<?php echo $model->classFrom; ?>';

// var videoSourceElement = document.getElementById("video-source");
// var videoFilePath = "test1.php?language=" + encodeURIComponent(language) + "&classFrom=" + encodeURIComponent(classFrom);
// videoSourceElement.src = videoFilePath;


//  const playButton = document.getElementById("playButton");
//     const audioElement = document.getElementById("video-source");

//     // Function to start audio playback
//     function startAudioPlayback() {
//         audioElement.play();
//     }

//     // Add a click event listener to the button
//     playButton.addEventListener("click", startAudioPlayback);





</script>


</body>

</html>

