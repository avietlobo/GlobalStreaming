<?php

// Path to the video file

if (isset($_GET['file'])) {
    // Get the value of the 'file' parameter
    $fileParam = $_GET['file'];

    echo $fileParam;

    // Decode the URL-encoded parameter to get the original value
    $decodedFile = urldecode($fileParam);

    // Use explode to split the string into an array using the underscore "_" as the delimiter
    $parts = explode('_', $decodedFile);

    // Now you have the 'language' and 'classFrom' in the $parts array
    // $parts[0] will contain the language and $parts[1] will contain the classFrom

    if (count($parts) === 2) {
        $language = $parts[0];
        $classFrom = $parts[1];

        $requestedFile1 = getVideoFileName($language,$classFrom);
        $file = $requestedFile1;
        // Now you can use $language and $classFrom as needed
        // For example, to output them:
        echo "Language: " . $language . "<br>";
        echo "Class From: " . $classFrom . "<br>";

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


    } else {
        // Incorrect format, handle the situation accordingly
        echo "Invalid format!";
    }
}

function getVideoFileName($language, $classNumber): string
{
    // Sanitize and validate inputs if needed
    $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    return $language . '_' . $classNumber . '.mp4';
}