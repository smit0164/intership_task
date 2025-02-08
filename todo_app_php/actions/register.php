<?php
session_start();
require "../config/db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=trim($_POST['username']);
    $email=trim($_POST["email"]);
    $password=$_POST["password"];
    
    if(empty($username)||empty($email)||empty($password)){
         $_SESSION['error']="All feild are required";
         header("location:../pages/register.php");
         exit();
    }

    $sql="select * from users where username=? OR email=?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$username,$email]);
    if($stmt->fetch()){
        $_SESSION['error']="username or email is alredy exits";
        header("location:../pages/register.php");
        exit();
    }
    try{

        $hashpassword=password_hash($password,PASSWORD_BCRYPT);
        $sql="INSERT INTO users (username,email,PASSWORD) values(?,?,?)";
        $stmt=$conn->prepare($sql);
        $success=$stmt->execute([$username,$email,$hashpassword]);
        if($success){
            header("location: ../pages/login.php");
            exit();
        }else{
            $_SESSION['error']="some issue while entering the detail in db";
            header("location:../pages/register.php");
            exit();
        }

    }catch(PDOException $e){
        echo "Register process failed:". $e->getMessage();
    }
   
}

?>