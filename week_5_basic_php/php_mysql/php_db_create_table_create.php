<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername", $username, $password);
    
    // Set error mode to exceptions
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Table MyGuests created successfully123";
    $sql = "CREATE DATABASE myper";
    $conn->exec($sql);

    
    $conn->exec("USE myper");

    $sql = "CREATE TABLE MyGuests (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
     $conn->exec($sql);
     echo "Table MyGuests created successfully";
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$conn = null;
?>
