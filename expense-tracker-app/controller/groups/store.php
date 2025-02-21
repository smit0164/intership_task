<?php
session_start();
use Core\Validator;
use Core\Database\App;

$groupName=$_POST['groupName'];
if(!Validator::string($groupName)){
      $_SESSION['errors']['groupError']="Group name is required!";
      header("Location: /");
      exit();
}

if(Validator::groupExists($groupName)){
      $_SESSION['errors']['groupError']="Group name is already available in the database!";
      header("Location: /");
     exit();
}

$db=App::resolve('Core\Database\Database');

$result=$db->query("INSERT INTO `groups`(groupName) VALUES (:groupName)", [
      'groupName' => $groupName,
]);
if($result){
      if(isset($_SESSION['errors']['groupError'])){
            unset($_SESSION['errors']['groupError']);
      }
      header("Location: /"); 
      exit();
}