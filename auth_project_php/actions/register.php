<?php
session_start();
require '../config/db.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password = $_POST['password'];
    
    if(empty($username)||empty($email)|| empty($password)){
       $_SESSION['error']="All field are required";
       header("location: ../register.php");
       exit();
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION['error']="Invalid email format";
        header("location: ../register.php");
        exit();
    }
    if(strlen($password)<6){
        $_SESSION['error']="Password must be at least 6 characters long.";
        header("location: ../register.php");
        exit();
    }

   try{
       echo"hiii";
       $stmt=$conn->prepare("SELECT ID FROM USERS WHERE EMAIL=? OR USERNAME=?");
       $stmt->execute([$email,$username]);
       if($stmt->fetch()){
           $_SESSION['error']="email or username is already exits.";
           header("location: ../register.php");
           exit();
       }
       $hashpassword=password_hash($password,PASSWORD_BCRYPT);
       $stmt=$conn->prepare("INSERT INTO users (username,email,password) values(?,?,?)");
       if($stmt->execute([$username,$email,$hashpassword])){
        $_SESSION['success'] = "Registration successful! Please login.";
        header("location: ../login.php");
        exit();
       }else{
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: ../register.php");
        exit();
       }
   }catch(PDOException $e){
        $_SESSION['error']="Database error:" .$e->getMessage();
        header("Location: ../register.php");
        exit();
   }
   
}

?>