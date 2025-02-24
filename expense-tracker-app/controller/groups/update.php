<?php

use Core\Validator;
use Core\Database\App;

header('Content-Type: application/json');

$groupId = $_POST['id'];
$groupName = $_POST['groupName'];
$errors = [];

// Validate group name
if (!Validator::string($groupName)) {
    $errors[] = "Group name is required!";
}

// Resolve database connection
$db = App::resolve('Core\Database\Database');

// Ensure group ID exists
$exists = $db->query("SELECT id FROM `groups` WHERE id = :groupId", [
    'groupId' => $groupId
])->find();

if (!$exists) {
    $errors[] = "Error: Group ID $groupId does not exist.";
}

// Check if group name is already taken (Only if it's not the same as the current group's name)
$existingGroup = $db->query("SELECT id FROM `groups` WHERE groupName = :groupName AND id != :groupId", [
    'groupName' => $groupName,
    'groupId' => $groupId
])->find();

if ($existingGroup) {
    $errors[] = "Group name is already available in the database!";
}

// Return errors if any exist
if (!empty($errors)) {
    echo json_encode(['success' => false, 'error' => implode(" ", $errors)]);
    exit();
}

// Update group name
$affectedRows = $db->query('UPDATE `groups` SET groupName = :groupName WHERE id = :groupId', [
    'groupName' => $groupName,
    'groupId' => $groupId
])->rowCount();

if ($affectedRows === 0) {
    echo json_encode(['success' => false, 'error' => "No changes made. Either the group ID does not exist or the name is the same."]);
    exit();
}

// Return success message
echo json_encode(['success' => true, 'message' => "Group updated successfully."]);
exit();
