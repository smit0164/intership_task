<?php

use Core\Database;
use Core\App;
use Core\Validator;

$db=App::resolve('Core\Database');

$errors=[];
if(!Validator::string($_POST['todo'],1,100)){
    $errors['todo']="A Todo must rely between 1 and 100 character";
}

if(!empty($errors)){
    require getBasePath('view/index.view.php');
}

if(empty($errors)){
    $db->query('INSERT INTO todos (task) VALUES(:task)',[
        'task'=>$_POST['todo'],
      ]);
      header("location: /");
      die();
}


