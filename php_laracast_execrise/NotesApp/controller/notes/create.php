<?php
$heading="Create Note Page";
$config=require('config.php');
$db=new Database($config['database']);
require "Validator.php";
if($_SERVER["REQUEST_METHOD"]==='POST'){
   
    $errors=[];
    if(!Validator::string($_POST['body'],1,100)){
      
           $errors['body']="A body must contain minimum 1 or maximum 100 character";
    }
    
    if(empty($errors)){
        $db->query('INSERT INTO notes(body,user_id) VALUES(:body,:user_id)',[
            'body'=>$_POST['body'],
             'user_id'=>5,
          ]);
    }
     
}
require "view/notes/create.view.php";