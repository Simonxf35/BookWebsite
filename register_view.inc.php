<?php
declare(strict_types=1);



function check_register_errors() {
    // insert HTML code here so that we can display errors

    if (isset($_SESSION["register_data"]["username"] && !isset($_SESSION 
    ["register_errors"]["userame_taken"]))
    
        echo "" .$_SESSION["register_data"]["username"]. '">';
} else {
    echo ""; 
    }
}

function check_register_errors() {
    if (isset($_SESSION["register_errors"])) {
        $errors = $_SESSION["register_errors"];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='form-error'>" . $error . "</p>";
        }

        unset($_SESSION["register_errors"]);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
         
    }
}
?>