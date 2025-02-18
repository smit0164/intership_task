<?php
use core\Database;
use core\App;

$db=App::resolve('core\Database');

                                                                                                    
$note=$db->query("select * from notes where id=:id",[
'id'=>$_POST['id'],
])->findOrFail();
$user=$db->query('select * from users where email=:email',[
    'email'=>$_SESSION['user'],
])->find();
$currentUserId=$user['id'];
authorized($note['user_id']===$currentUserId);
$db->query('delete from notes where id=:id',[
'id'=>$_POST['id']
]);
header('location:/notes');
exit();
