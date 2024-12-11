<?php

// Path to the video file

$requestedFile = $_GET['file'];

$parts = explode(",", $requestedFile);

// Retrieve the separate strings
$firstPart = $parts[0];  // "english"
$secondPart = $parts[1]; // "11"
echo '<pre>';
var_dump($secondPart);
echo '</pre>';

if(str_contains($firstPart, 'English'))
{

    $requestedFile1 = getVideoFileName($firstPart,1);
    echo '<pre>';
    var_dump($requestedFile1);
    echo '</pre>';
    $requestedFile = 'VID_20230322_190327_06622.mp4';
    $file = $requestedFile1;
}

if(str_contains($firstPart, 'French'))
{
    $requestedFile = 'VID_20230322_190327_06622.mp4';
    $file = $requestedFile;
}



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



function getVideoFileName($language, $classNumber): string
{
    // Sanitize and validate inputs if needed
    $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    $videoFileName = $language . '_' . $classNumber . '.mp4';

    return $videoFileName;
}


?>