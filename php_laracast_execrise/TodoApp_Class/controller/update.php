<?php
use Core\App;
use Core\Database;
use Core\Validator;
$db=App::resolve('Core\Database');
$errors=[];
$todo=$db->query("select * from todos where id=:id",[
    'id'=>$_POST['id']
])->find();

if(!Validator::string($_POST['task'],1,100)){
    $errors['todo']="A Todo must rely between 1 and 100 character";
}
if(!empty($errors)){
    require getBasePath("view/edit.view.php");
}


$db->query('UPDATE todos SET task = :task WHERE id = :id',[
    'task'=>$_POST['task'],
    'id'=>$_POST['id']
]);
header("location:/");
die();