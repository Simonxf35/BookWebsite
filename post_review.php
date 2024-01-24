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

    // Assuming BookID and UserID are retrieved from a form or session
    $bookId = $_POST['bookId']; // or $_SESSION['bookId'], etc.
    $userId = $_POST['userId']; // or $_SESSION['userId'], etc.
    $rating = $_POST['rating'];

    // Get user input from form
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
