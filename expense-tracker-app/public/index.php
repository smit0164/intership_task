<?php

const BASE_PATH=__DIR__.'/../';

require BASE_PATH."Core/function.php";

spl_autoload_register(function($class) {
    $result = str_replace('\\', '/', $class);
    $file = basePath("{$result}.php");
    require $file;
});
require basePath('bootstrap.php');
$router=new Core\Router();
require basePath('routes.php');
$url=parse_url($_SERVER["REQUEST_URI"])['path'];
$method=$_POST['_method']??$_SERVER['REQUEST_METHOD'];
$router->route($url,$method);
