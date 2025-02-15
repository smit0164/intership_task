<?php

use core\Validator;
use core\App;
use core\Database;

$email=$_POST['email'];
$password=$_POST['password'];

$errors=[];
if(!Validator :: email($email)){
    $errors['email']="Please provide a valid email address.";
}

if(!Validator :: string($password)){
    $errors['password']="Please provide a valid password.";
}

if(!empty($errors)){
    return view('session/create.view.php',[
         'errors'=>$errors
    ]);
}
$db=App::resolve('core\Database');
$user=$db->query("select * from users where email=:email",[
    'email'=>$email
])->find();

if($user){
    if(password_verify($password,$user['password'])){
        login($user['email']);
        header("location: /");
        exit();
    }
  
}
return view('session/create.view.php',[
    'errors'=>"No matching account found for that email address"
]);
