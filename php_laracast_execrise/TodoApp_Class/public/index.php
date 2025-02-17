<?php
session_start();

const BASE_PATH=__DIR__.'/../'; 
require BASE_PATH."Core/function.php";
spl_autoload_register(function($class){
    $result=str_replace('\\','/',$class);
    $file=getBasePath("{$result}.php");
    require $file;
});
require getBasePath("bootstrap.php");
$config=require getBasePath("config.php");
$router=new \Core\Router();
require getBasePath("routes.php");

$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$method=$_SERVER['REQUEST_METHOD'];
if($method==='POST'){
    if(isset($_POST['_method'])){
        $method=$_POST['_method'];
    }
}

$router->route($path,$method);