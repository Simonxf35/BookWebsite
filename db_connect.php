<?php
$host = 'localhost';  // or IP address like '192.168.0.1'
$user = 'db_user';    // your database username
$password = 'db_password'; // your database password
$dbname = 'my_database';  // your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use $conn to interact with the database
?>
