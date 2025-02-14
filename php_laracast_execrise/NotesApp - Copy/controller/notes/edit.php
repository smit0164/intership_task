<?php
use core\Database;
use core\App;

$db=App::resolve('core\Database');
$currentUserId=5;
$id=$_GET['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->findOrFail();

authorized($note['user_id']===$currentUserId);

view("notes/edit.view.php",[
    'heading'=>'Edit Notes',
     'errors'=>[],
     'note'=>$note
]);