<?php
session_start();
 use Core\Validator;
 use Core\Database\App;

$expenseDetails=[
   'expenseName'=>$_POST['expenseName'],
   'expenseAmount'=>$_POST['expenseAmount'],
   'expenseGroup'=>$_POST['expenseGroup'],
   'expenseDate'=>$_POST['expenseDate'],
];
$_SESSION['expenseName'] = $_POST['expenseName'];
$_SESSION['expenseAmount'] = $_POST['expenseAmount'];
$_SESSION['expenseDate'] = $_POST['expenseDate'];
$_SESSION['expenseGroup']=$_POST['expenseGroup'];
$_SESSION['errors']['expenseError'] = [];

foreach($expenseDetails as $expenseName=>$value){
    if(!Validator::string($value)){
        $_SESSION['errors']['expenseError'][$expenseName]="{$expenseName} is required!";
    }
}
if (!empty($_SESSION['errors']['expenseError'])) {
    header("Location: /");
    exit();
}
$db=App::resolve('Core\Database\Database');
$groupName = $_POST['expenseGroup'];
$db->query("SELECT id FROM `groups` WHERE groupName = :groupName", [
    'groupName' => $groupName
]);
$groupId  = $db->find();

if (!$groupId) {
    die("Error: Group not found!");
}
$db->query("INSERT INTO expenses (expenseName, expenseAmount, expenseDate, expenseGroup) 
            VALUES (:expenseName, :expenseAmount, :expenseDate, :expenseGroup)", [
    'expenseName' => $_POST['expenseName'],
    'expenseAmount' =>$_POST['expenseAmount'],
    'expenseDate' => $_POST['expenseDate'],
    'expenseGroup' => $groupId['id']
]);

unset( $_SESSION['errors']['expenseError']);
unset($_SESSION['expenseName']);
unset($_SESSION['expenseAmount']);
unset($_SESSION['expenseDate']);
header("Location: /");
exit();

