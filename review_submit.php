<?php
session_start();

include 'db_connect.php'; // Make sure this file exists and correctly sets up the database connection

function submitReview($bookId, $userId, $rating, $reviewText) {
    global $conn;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reviews (book_id, user_id, rating, review) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $bookId, $userId, $rating, $reviewText);

    // Execute and check
    if ($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error submitting review: " . $stmt->error;
    }

    $stmt->close();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to signin page
    header('Location: signin.php');
    exit();
}

// Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id']; // Assuming book_id is passed in POST request
    $userId = $_SESSION['user_id']; // User ID from session
    $rating = $_POST['rating']; // Assuming rating is passed in POST request
    $reviewText = $_POST['review']; // Assuming review text is passed in POST request

    submitReview($bookId, $userId, $rating, $reviewText);
}
?>
