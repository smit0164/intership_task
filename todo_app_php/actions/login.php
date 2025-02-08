<?php
session_start();
require "../config/db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
   

  try{
    $sql="SELECT * FROM users WHERE username=?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$username]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
   
    if($user && password_verify($password,$user['PASSWORD'])){
             $_SESSION['user_id']=$user['id'];
             $_SESSION['user_name']=$user['username'];
             $_SESSION['success'] = "Login successful";
            header("location:../pages/dashboard.php");
            exit();
    }else{
        $_SESSION['error']="Your Username and Password not match";
        header("location:../pages/login.php");
        exit();
    }
  }catch(PDOException $e){
        echo $e->getMessage();
  } 

}

?>