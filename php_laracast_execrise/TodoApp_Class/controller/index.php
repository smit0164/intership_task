<?php
use Core\Database;
use Core\App;
$db=App::resolve('Core\Database');
$todos=[];
$todos=$db->query("select * from todos")->get();

require getBasePath('view/index.view.php');