<?php
$host = 'localhost'; // or your database host
$user = 'username'; // your database username
$password = 'password'; // your database password
$dbname = 'your_database_name'; // your database name

// Create a new MySQLi instance for the database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to utf8mb4 for handling text data
$conn->set_charset("utf8mb4");
?>
