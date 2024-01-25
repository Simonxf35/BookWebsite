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

// Prepare the SQL statement to fetch the file path
$stmt = $conn->prepare("SELECT file_path FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId); // 'i' specifies the data type as integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['file_path'];

    // Security check for the file path
    if (strpos($filePath, "..") !== false) {
        die("Invalid file path.");
    }

    // Construct the full file path
    $fullPath = '/path/to/your/books/directory/' . $filePath;

    if (file_exists($fullPath)) {
        // Set headers to download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fullPath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fullPath));
        flush(); // Flush system output buffer
        readfile($fullPath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid book ID.";
}

$stmt->close();
$conn->close();
?>
