<?php
session_start();
require "../config/db.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $taskid=$_POST["delete"];
    try{
        $sql="DELETE FROM tasks where id=?";
        $stmt=$conn->prepare($sql);
        $sucess=$stmt->execute([$taskid]);
        if($sucess){
            $_SESSION['success'] ="your Todo delete sucessfully";
        }else{
            $_SESSION['error'] ="some error occur while deleteing your Todo";
        }
        header("location:../pages/dashboard.php");
        exit();
    }catch(PDOException $e){
    
        echo  $_SESSION['error'].$e->getMessage();
        header("location:../pages/dashboard.php");
        exit();
    }
    
}


?>