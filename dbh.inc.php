<?php

$host = 'localhost';
$dbname = 'websitedatabase'; // Name of your database
$username = 'root'; // Your database username
$dbpassword = 'password123'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

?>