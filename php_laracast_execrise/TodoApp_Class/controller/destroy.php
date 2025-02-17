<?php
use Core\Database;
use Core\App;

$db=App::resolve('Core\Database');

$db->query('delete  from todos where id=:id',[
    'id'=>$_POST['id']
]);
header('location:/');
exit();