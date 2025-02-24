<?php

use core\Database;
use core\Validator;

use core\App;
$db=App::resolve('core\Database');

$errors=[];

   
    
    if(!Validator::string($_POST['body'],1,100)){
      
           $errors['body']="A body must contain minimum 1 or maximum 100 character";

    }
    if(!empty($errors)){
        
        return view("notes/create.view.php",[
            'heading'=>'Notes',
             'errors'=>$errors
        ]);
    }
    if(empty($errors)){
        $user=$db->query('select * from users where email=:email',[
            'email'=>$_SESSION['user'],
        ])->find();
       
        $db->query('INSERT INTO notes(body,user_id) VALUES(:body,:user_id)',[
            'body'=>$_POST['body'],
             'user_id'=>$user['id'],
          ]);
                
        header("location: /notes");
        die();
    }
