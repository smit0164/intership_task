<?php
use core\Database;
use core\App;

$db=App::resolve('core\Database');

$id=$_GET['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->findOrFail();
$user=$db->query('select * from users where email=:email',[
    'email'=>$_SESSION['user'],
])->find();
$currentUserId=$user['id'];
authorized($note['user_id']===$currentUserId);

view("notes/edit.view.php",[
    'heading'=>'Edit Notes',
     'errors'=>[],
     'note'=>$note
]);