<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the signin page
    header('Location: signin.php');
    exit;
}

// Check if the book ID is present in the GET request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No book specified.";
    exit;
}

$bookId = $_GET['id'];

// Database connection
include 'db_connect.php'; // Ensure this file exists and contains the database connection setup

// Fetch book details
$stmt = $conn->prepare("SELECT file_path FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
    $filePath = $book['file_path'];

    // Check if the file exists and is readable
    if (file_exists($filePath) && is_readable($filePath)) {
        // Set headers to download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath);
        exit;
    } else {
        echo "File not found or not accessible.";
    }
} else {
    echo "Invalid book ID or book not found.";
}

$stmt->close();
$conn->close();
?>
