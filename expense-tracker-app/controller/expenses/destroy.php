<?php


use Core\Database\App;
$id = $_POST['expenseId'];


$db=App::resolve('Core\Database\Database');
$db->query('DELETE FROM `expenses` WHERE id = :id', [
    'id' => $id
]);
echo json_encode(['success' => true, 'message' => 'Expense deleted successfully']);
exit();