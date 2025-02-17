<?php
namespace core;
use core\Session;
class Authenticator
{
    public function attempt($email,$password){
        $user=App::resolve('core\Database')->query("select * from users where email=:email",[
            'email'=>$email
        ])->find();
        if($user){
            if(password_verify($password,$user['password'])){
                $this->login($user['email']);
                return true;
            }
        }
        return false;
    }

  
   public function login($user){
        $_SESSION['user']=$user;
        session_regenerate_id(true);
    }
    
    public function logout() { // Add a logout function to destroy the session
        Session::destroy();
    }
}