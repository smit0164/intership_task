<?php
namespace Core\Database;

class App{
    protected static $container;
    public static function setContainer($container){
        self::$container=$container;
    }
    public static function getContainer(){
         return self::$container; 
    } 
    public static  function resolve($key){
        return self::getContainer()->resolver($key);
    }
}