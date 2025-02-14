<?php
use core\Database;
use core\App;
$currentUserId=5;
$db=App::resolve('core\Database');

$id=$_GET['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->findOrFail();

authorized($note['user_id']===$currentUserId);


view("notes/show.view.php",[
    'heading'=>'Notes',
    'note'=>$note,
]);
