<?php
namespace Http\Forms;
use core\Validator;
use core\App;
class RegisterForm{
    protected $errors=[];
    public function validate($email,$password){
        if(!Validator::email($email)){
            $this->errors['email']="Please provide a valid email address.";
        }
        if(!Validator::string($password)){
            $this->errors['password']="Please provide a valid password.";
        }
        return empty($this->errors);
    }
    public function errors()
     {
        return $this->errors;
     }
     public function error($key,$error){
        $this->errors[$key]=$error;
     }

     public function emailExists($email){
        $db=App::resolve('core\Database');
        $result=$db->query("SELECT COUNT(*) FROM users WHERE email = :email",[
             'email'=>$email,
        ])->find();
        return $result===0?false:true;
     }

}