<?php
// Database Configuration
$dbHost = "localhost";
$dbUser = "your_phpmyadmin_username";
$dbPass = "your_phpmyadmin_password";
$dbName = "your_database_name";

// Establishing MySQLi Connection
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Connection Check
if ($mysqli->connect_errno) {
    exit("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Sample Query Execution
$query = "SELECT * FROM your_table";
if ($results = $mysqli->query($query)) {
    // Processing the results
    while ($row = $results->fetch_assoc()) {
        // Do something with each row
    }
    // Free result set
    $results->free();
} else {
    // Handle query error
    echo "Query failed: " . $mysqli->error;
}

// Closing the Connection
$mysqli->close();
?>
