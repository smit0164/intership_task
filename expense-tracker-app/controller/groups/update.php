<?php
session_start();

use Core\Validator;
use Core\Database\App;

$groupId = $_POST['id'];
$groupName = $_POST['groupName'];

$_SESSION['groupId'] = $groupId;
$_SESSION['groupName'] = $groupName;
$_SESSION['errors']['editGroupError']=[];
if (!Validator::string($groupName)) {
    $_SESSION['errors']['editGroupError'] = "Group name is required!";
    header("Location: /");
    exit();
}


if (Validator::groupExists($groupName)) {
    $_SESSION['errors']['editGroupError'] = "Group name is already available in the database!";
    header("Location: /");
    exit();
}


$db = App::resolve('Core\Database\Database');
$exists = $db->query("SELECT id FROM `groups` WHERE id = :groupId", [
    'groupId' => $groupId
])->find();

if (!$exists) {
    die("Error: Group ID $groupId does not exist.");
}

$affectedRows = $db->query('UPDATE `groups` SET groupName = :groupName WHERE id = :groupId', [
    'groupName' => $groupName,
    'groupId' => $groupId
])->rowCount();

if ($affectedRows === 0) {
    die("No rows were updated. Either the group ID does not exist or the new value is the same as the old value.");
}

unset($_SESSION['errors']['editGroupError']);
unset($_SESSION['groupId'] );
unset($_SESSION['groupName']);


header("location: /");
die();
