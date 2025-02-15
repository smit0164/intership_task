<?php
session_start();
const BASE_PATH=__DIR__.'/../'; 
require BASE_PATH."Core/function.php";
spl_autoload_register(function($class){
    $result=str_replace('\\','/',$class);
    $file=getBasePath("{$result}.php");
    require $file;
});

$config=require getBasePath("config.php");
$router=new \core\Database($config['database']);
print_r($router);
die();