<?php
// Sample index.php with multiple GET routes

// Define a simple routing mechanism
function route($path) {
    $routes = [
        '/' => 'homePage',
        '/about' => 'aboutPage',
        '/contact' => 'contactPage',
    ];

    if (array_key_exists($path, $routes)) {
        $handler = $routes[$path];
        return call_user_func($handler);
    } else {
        header("HTTP/1.0 404 Not Found");
        return '404 - Page not found';
    }
}

// Define route handlers
function homePage() {
    return 'Welcome to the home page!';
}

function aboutPage() {
    return 'This is the about page.';
}

function contactPage() {
    return 'You can contact us on this page.';
}

// Get the requested URL path
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$response = route($requestPath);

// Output the response
echo $response;
?>
