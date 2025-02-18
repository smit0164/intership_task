<?php

use core\Validator;
use core\App;
use core\Database;
use Http\Forms\RegisterForm;
use core\Session;
$email=$_POST['email'];
$password=$_POST['password'];
$form=new RegisterForm();
if(!$form->validate($email,$password)){
    Session::flash('errors',$form->errors());
    Session::flash('old',[
        'email'=>$email,
    ]);
    redirect('/register');
}
if($form->emailExists($email)){
    $form->error('db','Email  Already Exits In DataBase...');
    Session::flash('errors',$form->errors());
    redirect('/register');
}
// $errors=[];
// if(!Validator :: email($email)){
//     $errors['email']="Please provide a valid email address.";
// }

// if(!Validator :: string($password,7,255)){
//     $errors['password']="Please provide a password of at least seven character";
// }

// if(!empty($errors)){
//     return view('registration/create.view.php',[
//          'errors'=>$errors
//     ]);
// }


$db=App::resolve('core\Database');
$user=$db->query('select * from users  where email = :email',[
     'email' =>$email
])->find();

if($user){
    header('location:/login');
}else{
    $db->query("INSERT INTO users(email,password) VALUES(:email,:password)",[
        'email'=>$email,
        'password'=>password_hash($password, PASSWORD_BCRYPT)
    ]);
   
    login($email);
   
    header("location: /");
    exit();
}

