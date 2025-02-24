<?php

session_start();
use core\Session;
const BASE_PATH=__DIR__.'/../';
use core\ValidationException;

require BASE_PATH."core/"."function.php";

require BASE_PATH.'/vendor/autoload.php';



// spl_autoload_register(function($class) {
//     $result = str_replace('\\', '/', $class);
//     $file = base_path("{$result}.php");
//     require $file;
// });

require base_path('bootstrap.php');
$router=new \core\Router();
require base_path("routes.php");
$url=parse_url($_SERVER["REQUEST_URI"])['path'];
$method=$_POST['_method']??$_SERVER['REQUEST_METHOD'];

try{
    $router->route($url,$method);
}catch(ValidationException $exception){
    Session::flash('errors',$exception->errors);
    Session::flash('old',$exception->old);
    return redirect($router->previousUrl());
}

Session::unflash();





