<?php  
session_start();

if(isset($_SESSION['userid'])){
    header('location:pages/dashboard.php');
}
header('location:pages/login.php');

?>
