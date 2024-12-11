<?php

/** @var $model \app\models\RegisterModel */

// $language = $_GET['language'] ?? '';
// $classFrom = $_GET['classFrom'] ?? '';


session_start();
$language = $_SESSION['language'] ?? '';
$classFrom = $_SESSION['classFrom'] ?? '';
error_log($language);
    error_log($classFrom);

$videoFilePath = getVideoFileName($language, $classFrom);




function logMessage($message) {
    error_log($message); // Write the message to the server's error log
}

function streamVideo($file) {
    // session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['user'])) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }

     // Check if the file exists
        if (!file_exists($file)) {
            header('HTTP/1.1 404 Not Found');
             echo "<p>Video file not found.</p>"; // Output the error message
            exit();
        }


    // Parse the 'Range' header
    $range = $_SERVER['HTTP_RANGE'] ?? '';
    $bytesPrefix = "bytes=";

    if (strpos($range, $bytesPrefix) === 0) {
        $bytesRange = substr($range, strlen($bytesPrefix));
        $parts = explode('-', $bytesRange);

        if (count($parts) === 2) {
            $rangeStart = trim($parts[0]);
            if (!empty($rangeStart)) {
                $start = intval($rangeStart);
            }

            $rangeEnd = trim($parts[1]);
            if (!empty($rangeEnd)) {
                $end = intval($rangeEnd);
            }
        }
    } else {
        // If 'Range' header is not present, set start and end to stream the entire video
        $start = 0;
        $end = filesize($file) - 1;
    }

    // Log range values for debugging
    logMessage("Range Start: " . $start);
    logMessage("Range End: " . $end);

    // Get the video size
    $videoSize = filesize($file);

    // Set response headers
    header('Content-Type: video/mp4');

    if (isset($start) && isset($end)) {
        // Partial content
         header('HTTP/1.1 200 OK');
        header("Accept-Ranges: bytes");
        header("Content-Length: $videoSize");


        // Open the video file and seek to the start position
        $handle = fopen($file, 'rb');
        fseek($handle, $start);
        $chunkSize = 1024 * 1024;

        // Stream the video in chunks
        while (!feof($handle) && connection_status() === 0) {
            echo fread($handle, $chunkSize);
            flush();
        }

        fclose($handle);
    } else {
        // Full content
        header('HTTP/1.1 200 OK');
        header("Accept-Ranges: bytes");
        header("Content-Length: $videoSize");

        // Check if the request method is HEAD
        if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
            exit();
        }

        // Stream the entire video
        readfile($file);
    }
}

function getVideoFileName($language, $classNumber): string {
    // Sanitize and validate inputs if needed
    // $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
    $language = preg_replace('/[^a-zA-Z-]+/', '', $language);
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    // return 'file/' . $language . '_' . $classNumber . '.mp4';
    return 'file/' . $language . '/' . $language . '_' . $classNumber . '.mp4';

}

streamVideo($videoFilePath);


?>
