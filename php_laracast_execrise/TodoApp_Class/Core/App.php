<?php
namespace Core;


class App {
    protected static $container; 

   
    public static function setContainer($container) {
        static::$container = $container; 
    }

   
    public static function resolve($key) {
        if (!static::$container) {
            throw new \Exception("Container has not been set.");
        }
        
        return static::$container->resolve($key); 
    }
}
