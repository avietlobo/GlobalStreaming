<?php

/** @var $model \app\models\RegisterModel */

//$language = $_GET['language'] ?? '';
//$classFrom = $_GET['classFrom'] ?? '';


session_start();
// $language = $_SESSION['language'] ?? '';
$language = $_GET['language'] ?? '';
$classFrom = $_SESSION['classFrom'] ?? '';

$audioFilePath = getAudioFileName($language, $classFrom);




function logMessage($message) {
    error_log($message); // Write the message to the server's error log
}

function streamAudio($file) {
    session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['user'])) {
        header('HTTP/1.1 401 Unauthorized');
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
        // If 'Range' header is not present, set start and end to stream the entire audio
        $start = 0;
        $end = filesize($file) - 1;
    }

    // Log range values for debugging
    logMessage("Range Start: " . $start);
    logMessage("Range End: " . $end);

    // Get the audio size
    $audioSize = filesize($file);

    // Set response headers
    header('Content-Type: audio/mp3');

    if (isset($start) && isset($end)) {
        // commented line 69 - 73 as byte range requests was supported by production server. However 206 requests are not supported in iphone
        // Partial content
        // header('HTTP/1.1 206 Partial Content');
        // header("Content-Range: bytes $start-$end/$audioSize"); // Correctly specify the range
        // header("Accept-Ranges: bytes");
        // header("Content-Length: " . ($end - $start + 1));
        
        header('HTTP/1.1 200 OK');
        header("Accept-Ranges: bytes");
        header("Content-Length: $audioSize");

        // Open the video file and seek to the start position
        $handle = fopen($file, 'rb');
        fseek($handle, $start);
        $chunkSize = 1024 * 1024;

        // Stream the audio in chunks
        while (!feof($handle) && connection_status() === 0) {
            echo fread($handle, $chunkSize);
            flush();
        }

        fclose($handle);
    } else {
        // Full content
        header('HTTP/1.1 200 OK');
        header("Accept-Ranges: bytes");
        header("Content-Length: $audioSize");

        // Check if the request method is HEAD
        if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
            exit();
        }

        // Stream the entire audio
        readfile($file);
    }
}

function getAudioFileName($language, $classNumber): string {
    // Sanitize and validate inputs if needed
    // $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
      $language = preg_replace('/[^a-zA-Z-]+/', '', $language);
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    // return 'file/' . $language . '_' . $classNumber . '.mp3';
    return 'file/' . $language . '/' . $language . '_' . $classNumber . '.mp3';

}

streamAudio($audioFilePath);

?>
