<?php

use Core\Validator;
use Core\Database\App;
header('Content-Type: application/json');

$groupId = isset($_POST['id']) ? trim($_POST['id']) : '';
$groupName = isset($_POST['editGroupName']) ? trim($_POST['editGroupName']) : '';

$errors = [];

if (!Validator::string($groupName)) {
    $errors[] = "Group name is required!";
}

$db = App::resolve('Core\Database\Database');

if (!empty($errors)) {
    echo json_encode(['success' => false, 'error' => implode(" ", $errors)]);
    exit();
}

try {
    $db->query('UPDATE `groups` SET groupName = :groupName WHERE id = :groupId', [
        'groupName' => $groupName,
        'groupId'   => $groupId
    ]);
    echo json_encode(['success' => true, 'message' => "Group updated successfully."]);
    exit();
} catch (\Exception $e) {
    error_log("Error updating group: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => "An error occurred. Please try again later."]);
    exit();
}
