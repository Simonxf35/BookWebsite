<?php
declare(strict_types=1);

function check_register_errors() {
    if (isset($_SESSION["register_errors"])) {
        $errors = $_SESSION["register_errors"];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='form-error'>" . $error . "</p>";
        }

        unset($_SESSION["register_errors"]);
    }
}
?>