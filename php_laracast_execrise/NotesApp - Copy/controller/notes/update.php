<?php
use core\App;
use core\Database;
use core\Validator;
$db=App::resolve(Database::class);
$currentUserId=5;
$note=$db->query("select * from notes  WHERE id=:id ",[
      'id'=>$_POST['id']
])->findOrFail();
authorized($note['user_id']===$currentUserId);
$errors=[];
if(!Validator::string($_POST['body'],1,100)){
    $errors['body']="A body cannot have more than 100 character";
}
if(count($errors)){
    return view("notes/edit.view.php",[
        'heading'=>'Edit Notes',
         'errors'=>[],
         'note'=>$note
    ]);
}

$db->query('update notes set body=:body where  id=:id',[
    'id'=>$_POST['id'],
    'body'=>$_POST['body']
]);
header("location: /notes");
die();