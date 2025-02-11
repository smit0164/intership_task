<?php
$url=parse_url($_SERVER["REQUEST_URI"])['path'];


$routes=[
    '/'=>"controller/index.php",
    '/about'=>"controller/about.php",
    '/contact'=>"controller/contact.php",
];
function routeToController($url,$routes){
    if(array_key_exists($url,$routes)){
        require $routes[$url];
    }else{
         abort();
    }
}
function abort($code=404){
    http_response_code($code);
    require "view/{$code}.php";
    die();
}
routeToController($url,$routes);