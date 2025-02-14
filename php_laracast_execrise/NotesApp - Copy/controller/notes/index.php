<?php
use core\Database;
use core\App;
$db=App::resolve('core\Database');
$notes=[];

$notes=$db->query("select * from notes")->get();


view("notes/index.view.php",[
    'heading'=>'Notes',
    'notes'=>$notes,
]);