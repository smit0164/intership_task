<?php
//classes and object

class Car{
    public $brand;

    public function setBrand($name){
        $this->brand = $name;
    }
    public function getName(){
        return $this->brand;
    }
}

$myCar=new Car();
$myCar->setBrand("honda");
$result=$myCar->getName();
echo $result;

//construct:it ia mehtod that run when object is created
class person{
    public $name;

    public function __construct($personname){
        echo "<br>";
      echo"this is constructor function";
            $this->name=$personname;
            echo "<br>";
        echo $this->name;
    }
    public function __destruct(){
        echo "<br>";
        echo "Object Destroyed! Name: $this->name\n";
    }
}

$p_name=new person("smit");
unset($p); 

//Acces Modifier:public,private,protected
class User{
    public $name1="Smit123";
    private $password="Ast@";
    protected $email="smithh@123gmial.com";
    public function getpassword(){
        return $this->password;
    }
    public function getemail(){
        return $this->email;
    }
    
}
$user1= new User();
echo "<br>";
echo $user1->name1;
echo "<br>";
echo $user1->getpassword();
echo "<br>";
echo $user1->getemail();
//static method
//1.static method belong to class instead of object
// No need to create an object to access static properties/methods.
//  Use self:: inside the class instead of $this->
class math{
    public static $pi=3.14;

    public static function square($x){
        return $x*$x;
    }
}
echo "<br>";
echo math::$pi;
echo "<br>";
echo  math::square(3);

//Inheritance:
class animal{
    public $name="up";
    public function getNameanimal(){
           return "xcvgrf";
    }
}

class dog extends animal{
    public function getName(){
        return "dog";
 }
}

$dog1=new dog();
echo "<br>";
echo $dog1->getNameanimal();
echo "<br>";
echo $dog1->name;

//Abstract Classes & Interfaces
abstract class Car1{
    public $name;
    public function __construct($name){
          $this->name=$name;
    }
    abstract public function intro():string;
}

class honda extends Car1{
    public function intro():string{
       return "$this->name";
    }
}
echo "<br>";
$honda1=new honda("xyz");
echo $honda1->intro();
?>