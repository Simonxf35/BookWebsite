<?php
// db_connect.php

$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "library Space Management System"; // Your database name

// Create a connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to utf8mb4 for Unicode support
$conn->set_charset("utf8mb4");

// Optionally, you could add more error handling or logging here

// This file ends without closing the PHP tag to avoid accidental output
