<?php
namespace Http\Forms;
use core\Validator;
use core\ValidationException;
class LoginForm
{
   protected $errors=[];
   public function __construct(public array $attributes){
         if(!Validator :: email($attributes['email'])){
            $this->errors['email']="Please provide a valid email address.";
         }
         if(!Validator :: string($attributes['password'])){
               $this->errors['password']="Please provide a valid password.";
         }
   }
     public static function  validate($attributes)
     {
      $instance = new static($attributes); 
   
       return $instance->failed() ? $instance->throw():$instance;
     
     }
     public function failed(){
        return COUNT($this->errors);
     }
     public function throw(){
      ValidationException::throw($this->errors(), $this->attributes);
     }
     public function errors()
     {
        return $this->errors;
     }
     public function error($key,$error){
          $this->errors[$key]=$error;
          return $this;
     }

}