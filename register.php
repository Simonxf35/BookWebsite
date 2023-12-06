<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $FirstName = $_POST["FirstName"];
    $middleName = $_POST["middleName"];
    $LastName = $_POST["LastName"];
    $userName = $_POST["userName"];
    $email = $_POST["emailaddress"];
    $comfirmEmail = $_POST["comfirmEmail"];
    $password = $_POST["password"];
    

    // Validate password
    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    // Check for at least one uppercase letter
    if (!preg_match("/[A-Z]/", $password)) {
        die("Password must contain at least one uppercase letter.");
    }

    // Check for at least one lowercase letter
    if (!preg_match("/[a-z]/", $password)) {
        die("Password must contain at least one lowercase letter.");
    }

    // Check for at least one numerical digit
    if (!preg_match("/[0-9]/", $password)) {
        die("Password must contain at least one numerical digit.");
    }

    // Check for at least one special character
    if (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        die("Password must contain at least one special character.");
    }

    // TODO: Implement email validation

    // TODO: Store user information securely (e.g., use password hashing)

    // Display a success message (for demonstration purposes)
    echo "Sign-up successful! Welcome, $username!";
}
?>