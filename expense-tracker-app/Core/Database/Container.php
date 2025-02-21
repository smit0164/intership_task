<?php
namespace Core\Database;

use Exception; 
class Container {
    protected $bindings = []; 

    public function bind($key, $resolver) {
        $this->bindings[$key] = $resolver; 
    }

    public function resolver($key) { 
        if (!array_key_exists($key, $this->bindings)) { 
            throw new Exception("No key matching: " . $key);
        }

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }
}
