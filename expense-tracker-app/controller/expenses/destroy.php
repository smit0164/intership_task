<?php

use Core\Database\App;
$id=$_POST['id'];
$db=App::resolve('Core\Database\Database');
$db->query('delete from `expenses` where id=:id',[
      'id'=>$id,
]);
header("Location: /");
exit();