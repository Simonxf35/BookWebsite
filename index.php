<?php
// Database connection details
$servername = "localhost"; // Change to your server name
$username = "your_phpmyadmin_username";
$password = "your_phpmyadmin_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Now $conn is the connection variable you can use for database queries

// Example query
$sql = "SELECT * FROM your_table";
$result = $conn->query($sql);

// Process the result, fetch data, etc.

// Close connection when done
$conn->close();
?>
Ensure you replace "your_phpmyadmin_username", "your_phpmyadmin_password", "your_database_name", and "your_table" with your actual phpMyAdmin username, password, database name, and table name.

If you are using PDO, the connection code will look slightly different:

php
Copy code
<?php
// Database connection details
$servername = "localhost"; // Change to your server name
$username = "your_phpmyadmin_username";
$password = "your_phpmyadmin_password";
$dbname = "your_database_name";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Now $conn is the connection variable you can use for database queries

    // Example query
    $sql = "SELECT * FROM your_table";
    $result = $conn->query($sql);

    // Process the result, fetch data, etc.
}
catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
finally {
    // Close connection when done
    $conn = null;
}
?>