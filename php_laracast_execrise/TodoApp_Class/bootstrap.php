<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();
$container->bind('Core\Database',function(){
    $config=require getBasePath("config.php");
    return new Database($config['database']);
});

APP::setContainer($container);
