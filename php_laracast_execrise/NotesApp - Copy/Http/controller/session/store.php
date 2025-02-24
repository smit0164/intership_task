<?php

use core\Validator;
use core\App;
use core\Database;
use Http\Forms\LoginForm;
use core\Authenticator;
use core\Session;
use core\ValidationException;
$attributes=[
    'email'=>$_POST['email'],
    'password'=>$_POST['password'],
];
$form=LoginForm::validate($attributes);


$signedIn=(new Authenticator)->attempt(
    $attributes['email'],$attributes['password']
);
if(!$signedIn){
    $form->error('email','No matching account found for that email address and password.')->throw();
    
}
redirect('/');







  


