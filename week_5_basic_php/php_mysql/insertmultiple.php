<?php
$servername="localhost";
$username="root";
$password="";
$dbname="myper";
try{
    $conn =new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();
    $conn->exec("INSERT INTO MyGuests(firstname,lastname,email)VALUES('smit','patel','smithpatel895@gmail.com')");
    $conn->exec("INSERT INTO MyGuests(firstname,lastname,email)VALUES('smit1','patel1','smithpatel895@gmail.com')");
    $conn->exec("INSERT INTO MyGuests(firstname,lastname,email)VALUES('smit1','patel1','smithpatel895@gmail.com')");
    $conn->commit();
    echo "New recordes created succesfully";
}catch(PDOException $e){
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>