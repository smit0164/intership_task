<?php
namespace Core;

class Container {
    protected $bindings = [];
    protected $instances = [];

    public function bind($key, $resolver) {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key) { 
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for {$key}");
        }

        if (!array_key_exists($key, $this->instances)) {
           
            $this->instances[$key] = call_user_func($this->bindings[$key]);
        }

        
        return $this->instances[$key];
    }
}
