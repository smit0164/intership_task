<?php
namespace Core;
use Core\Database\App;

class Validator
{
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;    
    }

    public static function number($value) {
        return is_numeric($value);
    }

    public static function date($value) {
        return strtotime($value) !== false;
    }

}
