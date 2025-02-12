<?php


require "Database.php";
$config=require "config.php";

$db=new Database($config['database']);
$success=$db->query("INSERT INTO blog (title) values('my second blog')");
if($success){
    echo "Your Data is Insert Succesfully";
}else{
    echo "something wrong happen";
}