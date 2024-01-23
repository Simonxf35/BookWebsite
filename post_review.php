<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get user input from form
    $username = $mysqli->real_escape_string($_POST['username']);
    $comment = $mysqli->real_escape_string($_POST['comment']);

    // SQL query to insert data
    $sql = "INSERT INTO reviews (username, comment) VALUES ('$username', '$comment')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Review posted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
