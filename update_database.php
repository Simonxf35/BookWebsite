<?php
include 'db_connect.php'; // Include the database connection file

$sql = "ALTER TABLE books ADD COLUMN file_path VARCHAR(255)";
if ($conn->query($sql) === TRUE) {
    echo "Column added successfully";
} else {
    echo "Error adding column: " . $conn->error;
}

$conn->close();
?>
