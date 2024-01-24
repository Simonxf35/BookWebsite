<?php
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include necessary files
    require_once "dbh.inc.php";  // Update with your actual file name
    require_once "register_model.inc.php";
    require_once "register_contra.inc.php";
    require_once "config_session.inc.php";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // CSRF token validation
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token validation failed!");
        }
    
        // Rest of your code for handling form submission
        if (isset($_POST["signup"])) {
            // Your existing code for signup
        } elseif (isset($_POST["login"])) {
            // Your existing code for login
        }
    }

    // For sign-up
    if (isset($_POST["signup"])) {
        // Collect form data and sanitize
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $age = trim($_POST["age"]);
        $email = trim($_POST["emailaddress"]);
        $password = $_POST["password"];

        // Error Handling Code 
        $errors = [];
        if (empty($firstname) || empty($lastname) || empty($age) || empty($email) || empty($password)) {
            $errors["empty_input"] = "Fill in all fields!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email address!";
        } elseif (!is_numeric($age) || $age < 0) {
            $errors["invalid_age"] = "Invalid age!";
        } elseif (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        // Password validation
        if (strlen($password) < 8) {
            $errors["password_length"] = "Password must be at least 8 characters long.";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors["password_uppercase"] = "Password must contain at least one uppercase letter.";
        }

        if ($errors) {
            $_SESSION["register_errors"] = $errors;
            $_SESSION["register_data"] = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "age" => $age,
                "email" => $email
            ];
            header("Location: index.php");
            exit();
        }

        // Create user and handle success or failure
        $userCreated = create_user($pdo, $password, $email, $firstname, $lastname, $age);
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
        // Collect form data and sanitize
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        // Error Handling
        $errors = [];
        if (empty($email) || empty($password)) {
            $errors["empty_input"] = "Fill in all fields!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email address!";
        } elseif (!is_email_registered($pdo, $email)) {
            $errors["email_not_registered"] = "Email not registered!";
        } else {
            // Verify password
            if (!verify_user_credentials($pdo, $email, $password)) {
                $errors["invalid_credentials"] = "Invalid email or password!";
            }
        }

        if ($errors) {
            $_SESSION["login_errors"] = $errors;
            header("Location: login.php");
            exit();
        }

        // Set session variables and redirect to a logged-in page
        $_SESSION["user_email"] = $email;
        // You can also set other user information in session
        header("Location: dashboard.php");
        exit();
    }
}
?>
