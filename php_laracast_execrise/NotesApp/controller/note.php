<?php
$heading="Note";
$config=require('config.php');
$db=new Database($config['database']);
$id=$_GET['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->fetch();
if(!$note){
    abort();
}
if($note['user_id']!==5){
   abort(403);
}

require "view/note.view.php";