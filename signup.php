<?php
include 'db_connect.php'; // Include the database connection file

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = test_input($_POST['username']);
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute and check
        if ($stmt->execute()) {
            echo "Signup successful!";
        } else {
            throw new Exception("Error in signup process.");
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Signup failed: " . $e->getMessage();
    } finally {
        $conn->close();
    }
}
?>
