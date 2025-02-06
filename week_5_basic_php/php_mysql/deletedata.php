<?php
$server="localhost";
$username="root";
$password="";
$dbname="myper";
try{
  $conn=new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="DELETE FROM myguests WHERE id=4";
  $conn->exec($sql);
  echo "Record delete sucessfully123";
}catch(PDOException $e){
     echo $sql . "<br>".$e->getMessage();
}
$conn = null;
?>