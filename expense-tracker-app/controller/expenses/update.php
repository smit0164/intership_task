<?php
session_start();

use Core\Validator;
use Core\Database\App;

$expenseDetails = [
    'expenseName' => $_POST['expenseName'],
    'expenseAmount' => $_POST['expenseAmount'],
    'expenseDate' => $_POST['expenseDate'],
    'expenseId' => $_POST['id'],
];


$_SESSION['expenseId'] = $_POST['id'];
$_SESSION['expenseName'] = $_POST['expenseName'];
$_SESSION['expenseAmount'] = $_POST['expenseAmount'];
$_SESSION['expenseDate'] = $_POST['expenseDate'];
$_SESSION['errors']['expenseEditError'] = [];

foreach ($expenseDetails as $expenseName => $value) {
    if (!Validator::string($value)) {
        $_SESSION['errors']['expenseEditError'][$expenseName] = "{$expenseName} is required!";
    }
}

if (Validator::expenseExists($expenseDetails['expenseName'], $expenseDetails['expenseAmount'])) {
    $_SESSION['errors']['expenseEditError']['Databse'] = "Change expenseName and expenseAmount becuse both are already available in the database!";
}

if (!empty($_SESSION['errors']['expenseEditError'])) {
    header("Location: /");
    exit();
}

$db = App::resolve('Core\Database\Database');

$affectedRows = $db->query(
    'UPDATE `expenses` SET expenseName = :expenseName, expenseAmount = :expenseAmount, expenseDate = :expenseDate WHERE id = :expenseId',
    [
        'expenseName' => $expenseDetails['expenseName'],
        'expenseAmount' => $expenseDetails['expenseAmount'],
        'expenseDate' =>  $expenseDetails['expenseDate'],
        'expenseId' => $expenseDetails['expenseId']
    ]
)->rowCount();

if ($affectedRows === 0) {
    die("No rows were updated. Either the group ID does not exist or the new value is the same as the old value.");
}

unset($_SESSION['id']);
unset($_SESSION['expenseName']);
unset($_SESSION['expenseAmount']);
unset($_SESSION['expenseDate']);
unset($_SESSION['errors']['expenseEditError']);

header("location: /");
die();
