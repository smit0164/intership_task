<?php
use core\Database;
use core\App;
$db=App::resolve('core\Database');
$notes=[];

$user=$db->query('select * from users where email=:email',[
    'email'=>$_SESSION['user'],
])->find();
$currentUserId=$user['id'];

$notes=$db->query("select * from notes where user_id=:id",[
         'id'=>$currentUserId,
])->get();


view("notes/index.view.php",[
    'heading'=>'Notes',
    'notes'=>$notes,
]);