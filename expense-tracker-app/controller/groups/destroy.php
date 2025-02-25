<?php

use Core\Database\App;

$id = isset($_POST['groupId']) ? trim($_POST['groupId']) : '';

if (!$id) {
    echo json_encode(["success" => false, "error" => "Invalid group ID"]);
    exit();
}

$db = App::resolve('Core\Database\Database');

try {
   $db->query('DELETE FROM `groups` WHERE id = :id', [
        'id' => $id,
    ]);
    echo json_encode(["success" => true]);
    exit();
} catch (\Exception $e) {
    error_log("Error deleting group: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "An error occurred while deleting the group."]);
    exit();
}
