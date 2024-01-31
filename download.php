<?php
include 'db_connect.php'; // Include your database connection

$file_id = $_GET['file_id']; // Get the file ID from the URL

// Query the database to get the file information
// Assuming you have a table 'files' with columns 'id', 'name', and 'data' (blob)
$stmt = $conn->prepare("SELECT name, data, mime_type FROM files WHERE id = ?");
$stmt->bind_param("i", $file_id);
$stmt->execute();
$stmt->bind_result($name, $data, $mime_type);
$stmt->fetch();
$stmt->close();

// Set headers to download the file instead of displaying it
header('Content-Description: File Transfer');
header('Content-Type: ' . $mime_type); // Mime type of the file
header('Content-Disposition: attachment; filename="' . basename($name) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($data));

// Clear the output buffer
ob_clean();
flush();

// Output the file
echo $data;

// Close the database connection
$conn->close();
exit;
?>
