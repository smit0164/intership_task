<?php
session_start();
use core\Validator;
use core\App;
use core\Database;

$email=$_POST['email'];
$password=$_POST['password'];

$errors=[];
if(!Validator :: email($email)){
    $errors['email']="Please provide a valid email address.";
}

if(!Validator :: string($password,7,255)){
    $errors['password']="Please provide a password of at least seven character";
}

if(!empty($errors)){
    return view('registration/create.view.php',[
         'errors'=>$errors
    ]);
}


$db=App::resolve('core\Database');
$user=$db->query('select * from users  where email = :email',[
     'email' =>$email
])->find();

if($user){
    header('location:/');
}else{
    $db->query("INSERT INTO users(email,password) VALUES(:email,:password)",[
        'email'=>$email,
        'password'=>password_hash($password, PASSWORD_BCRYPT)
    ]);
   
    login($email);
   
    header("location: /");
    exit();
}

