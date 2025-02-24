<?php


use Core\Database\App;
$id = $_POST['groupId'];

if (!$id) {
    echo json_encode(["success" => false, "error" => "Invalid group ID"]);
    exit();
}

$db=App::resolve('Core\Database\Database');

$db->query('delete from `groups` where id=:id',[
      'id'=>$id,
]);

echo json_encode(["success" => true]);
exit();