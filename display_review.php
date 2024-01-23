<?php
// Database configuration
$dbHost = "localhost";
$dbUser = "username";
$dbPass = "password";
$dbName = "database_name";

// Create connection
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL query to fetch data
$sql = "SELECT username, comment, posted_at FROM reviews ORDER BY posted_at DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row["username"]. "</strong>: " . $row["comment"] . "<br><em>Posted on: " . $row["posted_at"] . "</em></p>";
    }
} else {
    echo "No reviews yet.";
}

$mysqli->close();
?>
