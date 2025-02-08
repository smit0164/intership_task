<?php
session_start();
require "../config/db.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $taskid=$_POST['complete'];
    try{
        $sql="UPDATE tasks SET status='completed' WHERE id=?";
        $stmt=$conn->prepare($sql);
        $succes=$stmt->execute([$taskid]);
        if($succes){
            $_SESSION['success']="your data update sucessfully";
            header("location:../pages/dashboard.php");
            exit();
        }else{
            $_SESSION['error']="something went wrong while updating your data";
            header("location:../pages/dashboard.php");
            exit();
        }

    }catch(PDOException $e){
          echo $e->getMessage();
    }
}