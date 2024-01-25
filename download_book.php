<?php
session_start(); // Start the session

include 'db_connect.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to download books.";
    exit; // Stop further execution of the script
}

if(isset($_GET['file']) && !empty($_GET['file'])) {
    $filePath = urldecode($_GET['file']);

    // Security check to prevent directory traversal attacks
    if(strpos($filePath, "..") !== false) {
        die("Invalid file path.");
    }

    // Construct the full file path
    $fullPath = '/path/to/your/books/directory/' . $filePath;

    if(file_exists($fullPath)) {
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
    echo "No file specified.";
}
?>
