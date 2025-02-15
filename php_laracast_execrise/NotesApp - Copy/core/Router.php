<?php
namespace core;
use core\Middleware\Middleware;
use core\Middeleware\Auth;
use core\Middeleware\Guest;

class Router{
    protected $routes=[];
    public function add($method,$uri,$controller){
             $this->routes[]=[
                'uri'=>$uri,
                'controller'=>$controller,
                'method'=>$method,
                'middleware'=>NULL
             ];
            return $this;
    }
    public function get($uri,$controller){
         return $this->add('GET',$uri,$controller);
         
    }
    public function delete($uri,$controller){
        return $this->add('DELETE',$uri,$controller);
    }
    public function post($uri,$controller){
        return $this->add('POST',$uri,$controller); 
    }
    public function patch($uri,$controller){
        return $this->add('PATCH',$uri,$controller);
    }
    public function put($uri,$controller){
        return $this->add('PUT',$uri,$controller);   
    }

    public function route($url,$method){
        foreach($this->routes as $route){
           if($route['uri']===$url && $route['method']=== strtoupper($method)){
            if($route['middleware']){
               Middleware::resolve($route['middleware']);
                
            } 
            return require base_path($route['controller']);
           }
        }
        $this->abort();
    }
    protected function abort($code=404){
        http_response_code($code);
        require base_path("view/{$code}.php");
        die();
    } 
    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware']=$key;
        return $this;
    }
}




// $routes = require base_path("routes.php");


// function routeToController($url,$routes){
//     if(array_key_exists($url,$routes)){
//         require base_path($routes[$url]);
//     }else{
//          abort();
//     }
// }
// function abort($code=404){
//     http_response_code($code);
//     require base_path("view/{$code}.php");
//     die();
// }
// $url=parse_url($_SERVER["REQUEST_URI"])['path'];
// routeToController($url,$routes);