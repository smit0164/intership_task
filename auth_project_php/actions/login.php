<?php
session_start();

require "../config/db.php";
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $remember=isset($_POST['remember']);


    if(empty($username)||empty($password)){
        $_SESSION['error']="Username and password are required";
        header('loction:../login.php');
        exit();
    }
    $stmt=$conn->prepare("SELECT * FROM USERS WHERE username=?");
    $stmt->execute([$username]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    
    
    if($user && password_verify($password,$user['password'])){
         $_SESSION['user_id']=$user['id'];
         $_SESSION['username']=$user['username'];
        if($remember){
            $token=bin2hex(random_bytes(16));
            setcookie("remember_token",$token,time()+86400,"/");
            $stmt=$conn->prepare("UPDATE users SET remember_token = ? WHERE ID=?");
            $stmt->execute([$token,$user['id']]);
        } 
        $_SESSION['success'] = "Login successful!";
        header("Location: ../pages/dashboard.php");
        exit();
    }else{
        echo "Invalid login!";
    }


}



?>