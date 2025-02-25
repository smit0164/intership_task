<?php

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

try {


    // Insert expense
    $result =$db->query("INSERT INTO expenses (expenseName, expenseAmount, expenseDate, expenseGroup) 
         VALUES (:expenseName, :expenseAmount, :expenseDate, :expenseGroup)", [
        'expenseName' => $expenseName,
        'expenseAmount' => $expenseAmount,
        'expenseDate' => $expenseDate,
        'expenseGroup' => $expenseGroup
    ]);
    if (!$result) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => "Failed to create expense. Please try again later."
        ]);
        exit;
    }

    // Return success response
    echo json_encode([
        "success" => true,
        "message" => "Expense added successfully!"
    ]);
    exit;
} catch (\Exception $e) {
    error_log("Error creating Expense: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "An error occurred. Please try again later."
    ]);
    exit;
}
