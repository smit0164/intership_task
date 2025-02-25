<?php
use Core\Database\App;

header('Content-Type: application/json'); // Ensure JSON response

try {
    $db = App::resolve('Core\Database\Database');

    // Fetch values more efficiently
    $totalSum = $db->query("SELECT SUM(expenseAmount) FROM expenses")->fetchColumn() ?? 0;
    $maxExpense = $db->query("SELECT MAX(expenseAmount) FROM expenses")->fetchColumn() ?? 0;
    $thisMonth = $db->query("
        SELECT SUM(expenseAmount) 
        FROM expenses 
        WHERE MONTH(expenseDate) = MONTH(CURRENT_DATE()) 
        AND YEAR(expenseDate) = YEAR(CURRENT_DATE())
    ")->fetchColumn() ?? 0;

    echo json_encode([
        'total_expense' => $totalSum,
        'max_expense' => $maxExpense,
        'total_this_month' => $thisMonth
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
