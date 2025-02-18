<?php
use core\Database;
use core\App;

$db=App::resolve('core\Database');

$id=$_GET['id'];
$user=$db->query('select * from users where email=:email',[
    'email'=>$_SESSION['user'],
])->find();
$currentUserId=$user['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->findOrFail();

authorized($note['user_id']===$currentUserId);


view("notes/show.view.php",[
    'heading'=>'Notes',
    'note'=>$note,
]);
