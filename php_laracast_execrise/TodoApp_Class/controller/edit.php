<?php
use Core\Database;
use Core\App;

$db=App::resolve('Core\Database');
$id=$_GET['id'];
$todo=$db->query("select * from todos where id=:id",[
    'id'=>$id
])->find();

require  getBasePath("view/edit.view.php");

