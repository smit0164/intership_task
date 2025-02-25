<?php
use Core\Database\App;
header('Content-Type: application/json'); // Ensure JSON response

$groupName = trim($_POST['groupName'] ?? '');
$groupId = $_POST['groupId'] ?? 0;

if (empty($groupName)) {
    echo json_encode(false);
    exit;
}

// Database query
$db = App::resolve('Core\Database\Database');
$existingGroup = $db->query(
    "SELECT id FROM `groups` WHERE groupName = :groupName AND id != :groupId",
    ['groupName' => $groupName, 'groupId' => $groupId]
)->find();


if ($existingGroup) {
    // If the group name already exists, return false
    echo json_encode( false);
} else {
    // If the group name is valid (doesn't exist), return true
    echo json_encode(true);
}
exit;
