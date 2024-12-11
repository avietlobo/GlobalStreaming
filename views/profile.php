<?php
$videoFilePath = 'video.mp4'; // Replace with the path to your video file

function streamVideo($file) {
    $videoSize = filesize($file);

    // Get the 'Range' header from the request
    $videoRange = $_SERVER['HTTP_RANGE'] ?? '';

    // Parse the range header (if present) to get start and end bytes
    if ($videoRange) {
        $videoRange = str_replace('bytes=', '', $videoRange);
        list($start, $end) = explode('-', $videoRange);
        $start = intval($start);
        $end = $end ? intval($end) : $videoSize - 1;
    } else {
        $start = 0;
        $end = $videoSize - 1;
    }

    $chunkSize = ($end - $start) + 1;

    // Set response headers for partial content and content length
    header('HTTP/1.1 206 Partial Content');
    header("Content-Range: bytes $start-$end/$videoSize");
    header('Accept-Ranges: bytes');
    header("Content-Length: $chunkSize");
    header('Content-Type: video/mp4');

    // Open the video file and seek to the start position
    $handle = fopen($file, 'rb');
    fseek($handle, $start);

    // Stream the video in chunks
    while (!feof($handle) && connection_status() === 0) {
        echo fread($handle, 4096);
        flush();
    }

    fclose($handle);
}

streamVideo($videoFilePath);
?>
