<?php
$server="localhost";
$username="root";
$password="";
$dbname="myper";
try{
  $conn=new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql="UPDATE myguests SET lastname='xyz' WHERE id=2";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  echo $stmt->rowCount() . " records UPDATED successfully";
}catch(PDOException $e){
     echo $sql . "<br>" .$e->getMessage();
}
$conn = null;
?>