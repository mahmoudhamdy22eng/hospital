<?php
session_start();
// Connect to database 
$dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
$user = 'root';
$pass = 'Ma123456*';

try {
        $conn = new PDO($dsn, $user, $pass); 

// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
}
?>
