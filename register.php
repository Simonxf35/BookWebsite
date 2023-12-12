<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // For sign-up
    if (isset($_POST["signup"])) {
        // Collect form data
        $firstName = $_POST["FirstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["LastName"];
        $userName = $_POST["userName"];
        $email = $_POST["emailaddress"];
        $confirmEmail = $_POST["confirmEmail"];
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        // TODO: Check if username or email is already taken (replace with actual database check)
        // For example, you might use a database query to check if the username or email already exists
        $isUsernameTaken = false; // Replace with the actual check
        $isEmailTaken = false; // Replace with the actual check

        if ($isUsernameTaken) {
            die("Username is already taken. Please choose another.");
        }

        if ($isEmailTaken) {
            die("Email is already taken. Please use another email address.");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // TODO: Store user information securely (e.g., use a database)
        // For example, you might insert the user data into a database table
        // with columns like id, firstName, middleName, lastName, userName, email, hashedPassword

        // Display a success message (for demonstration purposes)
        echo "Sign-up successful! Welcome, $userName!";
    }

    // For login
    elseif (isset($_POST["login"])) {
        // Assuming you have the user's information retrieved from the database
        $storedUserName = "stored_user_name"; // Replace with the actual stored username
        $storedHashedPassword = "$2y$10$gFCzflH8GMi6vu/ZhA5PnO5x6lcj6/6HlfUIZcE/Mh5Y3NSI7Cz9u"; // Replace with the actual stored hashed password

        // Collect login form data
        $loginUserName = $_POST["loginUserName"];
        $loginPassword = $_POST["loginPassword"];

        // Verify entered password with the stored hashed password
        if ($loginUserName === $storedUserName && password_verify($loginPassword, $storedHashedPassword)) {
            // Password is correct
            echo "Login successful! Welcome back, $loginUserName!";
        } else {
            // Password is incorrect
            echo "Login failed. Invalid username or password.";
        }
    }
}
?>
