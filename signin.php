<?php
session_start();
include 'db_connect.php'; // Include the database connection file

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                echo "Signin successful!";
            } else {
                throw new Exception("Invalid password.");
            }
        } else {
            throw new Exception("User not found.");
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Signin failed: " . $e->getMessage();
    } finally {
        $conn->close();
    }
}
?>
