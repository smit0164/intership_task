<?php
use core\Database;
use core\App;
$currentUserId=5;
$db=App::resolve('core\Database');

                                                                                                    
$note=$db->query("select * from notes where id=:id",[
'id'=>$_POST['id'],
])->findOrFail();

authorized($note['user_id']===$currentUserId);
$db->query('delete from notes where id=:id',[
'id'=>$_POST['id']
]);
header('location:/notes');
exit();
