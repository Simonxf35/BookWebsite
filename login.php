<?php
// Database connection details
$servername = "localhost";
$dbname = "lms1";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Initialize variables
$loginUsername = $loginPassword = "";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
    // Collect form data
    $loginUsername = sanitizeInput($_POST["loginUsername"]);
    $loginPassword = sanitizeInput($_POST["loginPassword"]);

    // Validate input (you can add more validation as needed)
    if (empty($loginUsername) || empty($loginPassword)) {
        $loginError = "Please enter both username and password.";
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $loginUsername);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User found, check password
            $stmt->bind_result($dbUsername, $hashedPassword);
            $stmt->fetch();

            if (password_verify($loginPassword, $hashedPassword)) {
                // Password is correct
                echo "Login successful! Welcome back, $loginUsername!";
            } else {
                $loginError = "Invalid password";
            }
        } else {
            $loginError = "User not found";
        }

        $stmt->close();
    }
}

$conn->close();
?>