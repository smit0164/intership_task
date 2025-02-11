<?php
require "function.php";

require "Database.php";

$config=require "config.php";

$db=new Database($config['database']);
$_GET[]
$posts=$db->query("select * from posts")->fetchAll();
print_r($posts);
   
  

