<?php

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// include all the SQL query
include __DIR__ . '/query.php';

// Define routes
$routes = [
    '/' => 'home.php',
    '/major-depression-disorder'=> 'major-depression-disorder.php'
    // '/about' => 'about.php',
    // '/contact' => 'contact.php'
];

// Get the requested URI
$request_uri = $_SERVER['REQUEST_URI'];

// If the route exists, include the corresponding file
if (isset($routes[$request_uri])) {
    include __DIR__ . '/' . $routes[$request_uri];
} else {
    // Handle 404 - Not Found
    http_response_code(404);
    echo '404 - Not Found';
}
