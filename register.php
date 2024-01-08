<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include necessary files
    require_once "db.php";  // Update with your actual file name
    require_once "register_model.inc.php";
    require_once "register_contra.inc.php";
    require_once "config_session.inc.php";

    // For sign-up
    if (isset($_POST["signup"])) {
        // Collect form data and sanitize
        $username = trim($_POST["username"]);
        $email = trim($_POST["emailaddress"]);
        $password = $_POST["password"];

        // Error Handling Code 
        $errors = [];
        if (empty($username) || empty($password) || empty($email)) {
            $errors["empty_input"] = "Fill in all fields!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email used!";
        } elseif (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        } elseif (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered";
        }

        // Password validation
        if (strlen($password) < 8) {
            $errors["password_length"] = "Password must be at least 8 characters long.";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors["password_uppercase"] = "Password must contain at least one uppercase letter.";
        }
        // Add other password checks as necessary

        if ($errors) {
            $_SESSION["register_errors"] = $errors;
            $_SESSION["register_data"] = ["username" => $username, "email" => $email];
            header("Location: index.php");
            exit();
        }

        // Create user and handle success or failure
        $userCreated = create_users($pdo, $password, $username, $email);
        if ($userCreated) {
            header("Location: index.php?signup=success");
        } else {
            header("Location: index.php?signup=error");
        }
        exit();
    }

    // For login
    elseif (isset($_POST["login"])) {
        // Login logic here
    }
}
?>
