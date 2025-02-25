<?php
use Core\Database\App;
header('Content-Type: application/json');

$groupName = isset($_POST['groupName']) ? trim($_POST['groupName']) : '';

if (empty($groupName)) {
    echo json_encode(false);
    exit;
}

$db = App::resolve('Core\Database\Database');
$exists = $db->query("SELECT COUNT(*) FROM `groups` WHERE `groupName` = :groupName", [
    'groupName' => $groupName
])->fetchColumn();

if ($exists > 0) {
    echo json_encode(false);
} else {
    echo json_encode(true);
}
exit;
