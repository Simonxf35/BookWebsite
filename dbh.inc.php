<?php

$host = 'localhost';
$dbname = '';
$username = 'root';
$dbpassword = '';

try{
    $pdo = new PDO("mysql:host=host;dbname=$dbname", $dbusername, 
    $dbpassword);
    $pdo ->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Could not connect to database" .$e->getMessage());
}

?>