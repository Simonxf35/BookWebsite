<?php
declare(strict_types=1);

function display_register_errors() {
    // Check for specific registration data errors
    if (isset($_SESSION["register_data"]["username"]) && !isset($_SESSION["register_errors"]["username_taken"])) {
        echo htmlspecialchars($_SESSION["register_data"]["username"]);
    }

    echo "<br>";

    // Check for general registration errors
    if (isset($_SESSION["register_errors"])) {
        foreach ($_SESSION["register_errors"] as $error) {
            echo "<p class='form-error'>" . htmlspecialchars($error) . "</p>";
        }

        // Clear the errors after displaying them
        unset($_SESSION["register_errors"]);
    }

    // Check for successful signup
    if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<p class='form-success'>Registration successful!</p>";
    }
}
?>
