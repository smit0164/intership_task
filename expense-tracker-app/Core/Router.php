<?php
namespace Core;

class Router{
    protected $routes=[];
    public function add($url,$controller,$method){
        $this->routes[]=[
            'url'=>$url,
            'controller'=>$controller,
            'method'=>$method,
        ];
    }
    public function get($url,$controller){
        $this->add($url,$controller,'GET');
        return $this;
    }
    public function post($url,$controller){
        $this->add($url,$controller,'POST');
        return $this;
    }
    public function put($url,$controller){
        $this->add($url,$controller,'PUT');
        return $this;
    }
    public function patch($url,$controller){
        $this->add($url,$controller,'PATCH');
        return $this;
    }
    public function delete($url,$controller){
        $this->add($url,$controller,'DELETE');
        return $this;
    }
    public function route($url,$method){
        foreach($this->routes as $route){
             if($route['url']===$url && $route['method']===$method){
                    return  require basePath($route['controller']);
             }
        }
        $this->abort();
    }
    public function abort(){
        require basePath('404.php');
    }

}