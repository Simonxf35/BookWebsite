<?php
session_start(); // Start the session

include 'db_connect.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to download books.";
    exit; // Stop further execution if the user is not logged in
}

// Validate and sanitize the input
$bookId = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

if (!$bookId) {
    echo "No book specified.";
    exit;
}

// Prepare the SQL statement to fetch the file data
$stmt = $conn->prepare("SELECT file_data, file_name, file_type FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fileData = $row['file_data'];
    $fileName = $row['file_name'];
    $fileType = $row['file_type'];

    // Set headers to download the file
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $fileType);
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($fileData));
    ob_clean();
    flush(); // Flush system output buffer
    echo $fileData;
    exit;
} else {
    echo "File not found.";
}

$stmt->close();
$conn->close();
?>
