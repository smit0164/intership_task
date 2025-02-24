<?php
session_start();
use Core\Validator;
use Core\Database\App;

header('Content-Type: application/json');

// Get input values safely
$expenseName = isset($_POST['expenseName']) ? trim($_POST['expenseName']) : '';
$expenseAmount = isset($_POST['expenseAmount']) ? trim($_POST['expenseAmount']) : '';
$expenseGroup = isset($_POST['expenseGroup']) ? trim($_POST['expenseGroup']) : '';
$expenseDate = isset($_POST['expenseDate']) ? trim($_POST['expenseDate']) : '';

$errors = [];

// Validate inputs
if (!Validator::string($expenseName, 3)) {
    $errors['expenseName'] = "Expense name must be at least 3 characters!";
}

if (!Validator::number($expenseAmount) || $expenseAmount <= 0) {
    $errors['expenseAmount'] = "Amount must be a valid positive number!";
}

if (!Validator::string($expenseGroup)) {
    $errors['expenseGroup'] = "Please select a valid expense group!";
}

if (!Validator::date($expenseDate)) {
    $errors['expenseDate'] = "Please select a valid date!";
}

// If there are errors, return response
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "errors" => $errors
    ]);
    exit;
}

$db = App::resolve('Core\Database\Database');

// Fetch group ID to ensure it's valid
$group = $db->query("SELECT id FROM `groups` WHERE id = :groupId", [
    'groupId' => $expenseGroup
])->find();

if (!$group) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "errors" => ["expenseGroup" => "Selected group does not exist!"]
    ]);
    exit;
}

// Insert expense
$db->query("INSERT INTO expenses (expenseName, expenseAmount, expenseDate, expenseGroup) 
            VALUES (:expenseName, :expenseAmount, :expenseDate, :expenseGroup)", [
    'expenseName' => $expenseName,
    'expenseAmount' => $expenseAmount,
    'expenseDate' => $expenseDate,
    'expenseGroup' => $group['id']
]);

// Return success response
echo json_encode([
    "success" => true,
    "message" => "Expense added successfully!"
]);
exit;
