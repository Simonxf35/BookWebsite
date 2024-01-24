<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "lms1";

    // Create connection
    $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve form data
    $bookId = $mysqli->real_escape_string($_POST['bookId']);
    $userId = $mysqli->real_escape_string($_POST['userId']);
    $rating = $mysqli->real_escape_string($_POST['rating']);
    $comment = $mysqli->real_escape_string($_POST['comment']);

    // SQL query to insert data using prepared statements
    $stmt = $mysqli->prepare("INSERT INTO Review (BookID, UserID, Rating, Comment, ReviewDate) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $bookId, $userId, $rating, $comment);

    if ($stmt->execute()) {
        echo "Review posted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
