<?php
use core\Response;
function url($value){
    return $_SERVER["REQUEST_URI"]==$value;
  }

  function authorized($condition){
           if(!$condition){
             abort(Response::FORBIDDEN);
           }
  }
  function base_path($path){
    return BASE_PATH . $path;
  }
  function view($path,$attribute=[]){
    extract($attribute);
   require base_path('view/'.$path);
  }
  function abort($code=404){
    http_response_code($code);
    require base_path("view/{$code}.php");
    die();
} 

function redirect($path){
  header("location:{$path}");
  exit();
}
function old($key,$default=''){
 
   return  core\Session::get('old')[$key] ?? $default;
}