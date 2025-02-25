<?php
use Core\Database\App;

header('Content-Type: application/json');

$db = App::resolve('Core\Database\Database');

$type = $_GET['type'] ?? '';

if ($type === 'groups') {
    // Fetch all groups correctly
    $groups = $db->query("SELECT id, groupName FROM `groups`")->findAll();

    echo json_encode(["success" => true, "groups" => $groups]);
} elseif ($type === 'expenses' && isset($_GET['groupId'])) {
    $groupId = $_GET['groupId'];

    // Fetch expenses for a specific group correctly
    $expenses = $db->query("SELECT id, expenseName, expenseAmount, expenseDate ,expenseGroup FROM expenses WHERE expenseGroup = :groupId", [
        'groupId' => $groupId
    ])->findAll();
    
    echo json_encode(["success" => true, "expenses" => $expenses]);
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
exit;
