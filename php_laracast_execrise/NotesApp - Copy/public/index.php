<?php
const BASE_PATH=__DIR__.'/../';

require BASE_PATH."core/"."function.php";






spl_autoload_register(function($class){
    $result=str_replace('\\','/',$class);
   
    require base_path("{$result}.php");
});
require base_path('bootstrap.php');
$router=new \core\Router();
$routes = require base_path("routes.php");

$url=parse_url($_SERVER["REQUEST_URI"])['path'];
$method=$_POST['_method']??$_SERVER['REQUEST_METHOD'];

$router->route($url,$method);


