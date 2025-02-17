<?php
function getBasePath($path){
    return BASE_PATH.$path;
}
function login($name,$email,$id){
   $_SESSION['name']=$name;
   $_SESSION['email']=$email;
   $_SESSION['id']=$id;
}