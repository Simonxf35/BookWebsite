<?php

$host = 'localhost';
$dbname = 'websitedatabase';
$username = 'root';
$dbpassword = 'password123'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>

<?php
$servername = "localhost";
$dbUsername = "username";
$dbPassword = "password";
$dbName = "database_name";

