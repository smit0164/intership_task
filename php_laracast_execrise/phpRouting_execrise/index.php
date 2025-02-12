<?php

$routes=[
    '/'=>function(){
        require "view/home.php";
    },
    '/about'=>function(){
        require "view/about.php";
    },

    '/contact'=>function(){
        require "view/contact.php";
    }
];

$uri=$_SERVER['PATH_INFO'] ?? '/';

if(array_key_exists($uri, $routes)){
       $routes[$uri]();
}else{
    http_response_code(404);
    echo '404 - Page not found';
}
