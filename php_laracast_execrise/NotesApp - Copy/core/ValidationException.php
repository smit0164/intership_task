<?php

namespace core;

class ValidationException extends \Exception
{
    public array $errors = [];
    public array $old = [];

    public static function throw(array $errors, array $old): never
    {
        $instance = new static();
        $instance->errors = $errors;
        $instance->old = $old ?? [];
        throw $instance;
    }
}
