<?php
use Core\Database\App;
$id = isset($_POST['expenseId']) ? trim($_POST['expenseId']) : '';
$db=App::resolve('Core\Database\Database');
try {
    $db->query('DELETE FROM `expenses` WHERE id = :id', [
        'id' => $id
    ]);
    echo json_encode(['success' => true, 'message' => 'Expense deleted successfully']);
    exit();
} catch (\Exception $e) {
    error_log("Error deleting expense: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'An error occurred while deleting the expense.']);
    exit();
}