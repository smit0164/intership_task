<?php
namespace Core;
class Router{
  protected $routes =[];
  public function get($url,$controller){
    $this->routes[]=[
         'url'=>$url,
         'controller'=>$controller,
         'method'=>'GET',
    ];
  }
  public function post($url,$controller){
    $this->routes[]=[
        'url'=>$url,
         'controller'=>$controller,
         'method'=>'POST',
    ];
  }
  public function delete($url,$controller){
    $this->routes[]=[
        'url'=>$url,
         'controller'=>$controller,
         'method'=>'DELETE',
    ];
  }
  public function put($url,$controller){
    $this->routes[]=[
        'url'=>$url,
         'controller'=>$controller,
         'method'=>'PUT',
    ];
  }

  public function route($path,$method){
    foreach($this->routes as $route){
           if($route['url'] === $path && $route['method'] === $method){
             require getBasePath($route['controller']);
            return;   
           }
    }
    $this->abort();
  }
  private function abort(){
    http_response_code(404);
    echo "404 - Not Found";
    exit;
  }
}