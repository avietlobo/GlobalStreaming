<!DOCTYPE html>
<html>
<head>
    <title>Video Player</title>
    <link href="https://vjs.zencdn.net/7.15.4/video-js.min.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
</head>
<body>
<video id="my-video" class="video-js" controls width="640" height="340" data-setup='{}'>
    <source src="stream.php" type="video/mp4">
    Your browser does not support the video tag.
</video>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var player = videojs('my-video');
    });
</script>
</body>
</html>
