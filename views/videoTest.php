<?php
/** @var $model \app\models\RegisterModel */
?>
<!DOCTYPE html>

<html>

<head>

    <title>Video Streaming2</title>

</head>

<body>
<h1>Video Stream  </h1>
<h4>Candidate <?php echo $model->participant  ?> is requesting for <?php echo $model->language  ?> class Number <?php echo $model->classFrom.','.$model->classTo ?> in <?php echo $model->mediaType ?> format</h4>
<?php
// Replace 'video.mp4' with the path to your video file
$requestedFile1 = getVideoFileName($model->language,$model->classFrom);

$videoFilePath = $requestedFile1;

function getVideoFileName($language, $classNumber): string
{
    // Sanitize and validate inputs if needed
    $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    return 'file/' . $language . '_' . $classNumber . '.mp4';
}
?>

<video id = "videoplayer" controlsList="nodownload" width="640" height="360" controls>
<!--    controlsList="nodownload"-->
    Your browser does not support the video tag.
</video>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type = "text/javascript">
document.addEventListener('contextmenu', event => event.preventDefault());

</script>

<script type="text/javascript">

$(document).ready(function(){
    var strSRC = '<?php echo $videoFilePath; ?>';
    var strTYPE = 'video/mp4';
$("#videoplayer").html('<source src="'+strSRC+'" type="'+strTYPE+'"></source>');
document.getElementById("videoplayer").play();
});


</script>


</body>

</html>

