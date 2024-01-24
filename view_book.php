<?php
session_start();

// Function to check if the user is authenticated
function isUserAuthenticated() {
    // Check if the user's authentication token (e.g., session or JWT) is set
    return isset($_SESSION['user_id']);
}

// Function to read and display the contents of a text file from the database
function viewTextFileFromDatabase($bookId) {
    // Database connection parameters
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'lms1';

    // Check if the user is authenticated
    if (!isUserAuthenticated()) {
        echo "Error: Unauthorized access. Please log in.";
        return;
    }

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a SQL query to retrieve the book content
    $sql = "SELECT book_content FROM table_books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $stmt->store_result();

    // Check if a record was found
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($fileContent);
        $stmt->fetch();

        // Display the contents of the text file
        echo '<pre>' . htmlspecialchars($fileContent) . '</pre>';
    } else {
        echo "Error: Book not found!";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

// Check if the user is authenticated
if (isUserAuthenticated() && isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];
    viewTextFileFromDatabase($bookId);
} elseif (!isUserAuthenticated()) {
    echo "Error: Unauthorized access. Please log in.";
} else {
    echo "Error: Book ID not provided in the URL.";
}
?>
