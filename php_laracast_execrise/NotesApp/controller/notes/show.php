<?php
$heading="Note";
$currentUserId=5;
$config=require('config.php');
$db=new Database($config['database']);
$id=$_GET['id'];
$note=$db->query("select * from notes where id=:id",[
    'id'=>$id,
])->findOrFail();

authorized($note['user_id']===$currentUserId);


require "view/notes/show.view.php";