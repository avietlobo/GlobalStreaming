<?php


//        echo '<pre>';
////        var_dump($model->language);
//var_dump('hi');
//        echo '</pre>';

// Check user authentication (optional)
// Implement your own authentication logic here
// Example: if user is not logged in or lacks permissions, deny access

// Set the appropriate content type for video streaming
header('Content-Type: video/mp4');

// Path to the video file
$videoPath = 'file/English.mp4';

// Open the video file
$videoFile = fopen($videoPath, 'rb');

// Check if the file opened successfully
if ($videoFile === false) {
    // Handle file not found or other errors
    header("HTTP/1.0 404 Not Found");
    exit;
}

// Get the file size
$fileSize = filesize($videoPath);

// Set the content length for the browser to display the video length correctly
header("Content-Length: $fileSize");

// Disable caching of the video
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Expires: 0');

// Stream the video in chunks
while (!feof($videoFile)) {
    // Adjust the chunk size according to your needs
    $chunkSize = 1024 * 1024; // 1MB
    echo fread($videoFile, $chunkSize);
    ob_flush();
    flush();
}

// Close the video file
fclose($videoFile);
