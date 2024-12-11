<?php

// Path to the video file

if (isset($_GET['file'])) {
    // Get the value of the 'file' parameter
    $fileParam = $_GET['file'];

    echo $fileParam;
}

function getVideoFileName($language, $classNumber): string
{
    // Sanitize and validate inputs if needed
    $language = preg_replace('/[^a-zA-Z]/', '', $language); // Remove any non-alphabetic characters from language
    $classNumber = intval($classNumber); // Convert classNumber to an integer

    // Concatenate the language and classNumber to form the video file name
    return $language . '_' . $classNumber . '.mp4';
}