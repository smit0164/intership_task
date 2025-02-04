<?php

//1.local scope 
function name(){
    $x="smit";
    echo $x;
}
name();
//echo $x;=>it will give a error undefined var

//2.golbal scope:variblr which is defined as a gobal is not accesible by function
echo '<br>';
$y=20;
function say(){
     global $y;//using global keyword
     echo $y;
}
say();
echo $y;
echo '<br>';
function show(){
    echo $GLOBALS['y'];//using $GLOBALS Array
}
show();
echo '<br>';
//3.static scope
//static variable retains its value between function call
function counter(){
    static $count=0;
    $count++;
    echo $count ." ";
}
counter();
counter();
counter();
echo '<br>';
//4.super global scope=>PHP provides superglobals, which can be accessed anywhere in the script without needing global keyword.
//Examples: $_GET, $_POST, $_SESSION, $_COOKIE, $_SERVER, $_FILES, $_REQUEST, $GLOBALS
echo $_SERVER['PHP_SELF'];
//variable variable syntax help us to assign variable value to new variable name
$a="hello";
$$a="world";//here $hello="world";
echo '<br>';
echo $hello;
echo '<br>';
echo "$a {$$a}";
echo '<br>';
echo $a.$$a;

//constant:it do not use $ sign like normal varible
//1.using define:it is a old method it work outside the class
define("SITE_NAME", "MyWebsite");
echo '<br>';
echo SITE_NAME;
//2.using const :it is a newer method it work inside a class
echo '<br>';
const pi=3.14;
echo pi;
function pi_val(){
    echo '<br>';
    echo "pi valu is ".pi;
    
}

pi_val();

//3.const inside a class
class const_val{
    const m=67890;
}
echo '<br>';
echo const_val::m;
?>