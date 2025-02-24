<?php
use Core\Database\App;
header('Content-Type: application/json'); // Ensure JSON response

$groupName = trim($_POST['groupName'] ?? '');
$groupId = $_POST['groupId'] ?? 0;

if (empty($groupName)) {
    echo json_encode(["valid" => false, "message" => "Group name is required."]);
    exit;
}

// Database query
$db = App::resolve('Core\Database\Database');
$existingGroup = $db->query(
    "SELECT id FROM `groups` WHERE groupName = :groupName AND id != :groupId",
    ['groupName' => $groupName, 'groupId' => $groupId]
)->find();

// ✅ Always return a valid JSON response
if ($existingGroup) {
    echo json_encode("Group name is already taken!"); // String message (Not an object)
} else {
    echo json_encode(true); // Pass validation
}
exit;
