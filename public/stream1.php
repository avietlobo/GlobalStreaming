<?php

// Path to the video file

$file = 'VID_20230322_190327_06622.mp4';

// Set the appropriate content type

header('Content-Type: video/mp4');

// Open and stream the video file

$fp = fopen($file, 'rb');

while (!feof($fp)) {

    // Read the video file in chunks

    $chunk = fread($fp, 1024 * 1024);

    // Output the chunk to the browser

    echo $chunk;

    // Flush the output buffer

    ob_flush();

    flush();

}

fclose($fp);

?>