<?php
session_start();
require "../config/db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $todo=trim($_POST["todo"]);
    if(empty($todo)){
        $_SESSION['error']="To do is required";
        header("location:../pages/dashboard.php");
        exit();
    }


    try{
        $sql="INSERT INTO tasks (user_id,task_description,status,created_at)
        VALUES(?,?,?,NOW())";
        $stmt=$conn->prepare($sql);
        $success=$stmt->execute([$_SESSION['user_id'],htmlspecialchars($todo),"pending"]);
        if ($success) {
                 $_SESSION['success'] = "Your to-do has been added to the database.";
                 header("Location: ../pages/dashboard.php");
                 exit(); 
        }
        
    }catch(PDOException $e){
        echo"erro";
        
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: ../pages/dashboard.php");
        exit();
    }

   
}
?>