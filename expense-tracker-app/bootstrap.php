<?php
use Core\Database\Container;
use Core\Database\Database;
use Core\Database\App;
$container=new Container();
$container->bind('Core\Database\Database',function(){
    $config=require basePath("config.php");
    return new Database($config['database']);
});

App::setContainer($container);
