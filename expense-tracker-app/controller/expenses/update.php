<?php


use Core\Validator;
use Core\Database\App;
header('Content-Type: application/json');
$expenseName   = isset($_POST['expenseName']) ? trim($_POST['expenseName']) : '';
$expenseAmount = isset($_POST['expenseAmount']) ? trim($_POST['expenseAmount']) : '';
$expenseDate   = isset($_POST['expenseDate']) ? trim($_POST['expenseDate']) : '';
$expenseGroup  = isset($_POST['expenseGroup']) ? trim($_POST['expenseGroup']) : '';
$expenseId     = isset($_POST['id']) ? trim($_POST['id']) : '';

$errors = [];

// Manually validate each field
if (!Validator::string($expenseName)) {
    $errors['expenseName'] = "Expense name is required!";
}
if (!Validator::number($expenseAmount)) {
    $errors['expenseAmount'] = "Expense amount is required!";
}
if (!Validator::date($expenseDate)) {
    $errors['expenseDate'] = "Expense date is required!";
}
if (!Validator::string($expenseGroup )) {
    $errors['expenseId'] = "Expense ID is required!";
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

$db = App::resolve('Core\Database\Database');

 $db->query(
    'UPDATE `expenses` SET expenseName = :expenseName, expenseAmount = :expenseAmount, expenseDate = :expenseDate,expenseGroup=:expenseGroup WHERE id = :expenseId',
    [
        'expenseName'   => $expenseName,
        'expenseAmount' => $expenseAmount,
        'expenseDate'   => $expenseDate,
        'expenseGroup'  =>$expenseGroup,
        'expenseId'     => $expenseId
    ]
);


echo json_encode(['success' => true, 'message' => "Expense updated successfully."]);
exit();