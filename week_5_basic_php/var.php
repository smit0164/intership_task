<?php
/* null */
$variabel=null;
if(is_null($variabel)){
    echo "variable is null";
}

if($variabel===null){
    echo "variable check is null using three equal sign";
}

/*boolean*/
var_dump((bool) "1");        // bool(false)
var_dump((bool) "0");       // bool(false)
var_dump((bool) 1);         // bool(true)
var_dump((bool) -2);        // bool(true)
var_dump((bool) "foo");     // bool(true)
var_dump((bool) 2.3e5);     // bool(true)
var_dump((bool) array(12)); // bool(true)
var_dump((bool) array());   // bool(false)
var_dump((bool) "false");   // bool(true)

/*interger*/
// integer     : decimal
//             | hexadecimal
//             | octal
//             | binary

$a = 1234; // decimal number
$a = 0123; // octal number (equivalent to 83 decimal)
$a = 0o123; // octal number (as of PHP 8.1.0)
$a = 0x1A; // hexadecimal number (equivalent to 26 decimal)
$a = 0b11111111; // binary number (equivalent to 255 decimal)
$a = 1_234_567; // decimal number (as of PHP 7.4.0)

var_dump(PHP_INT_MAX + 1);  //this is exmaple interger overflow it will return type as a float
//interger division
var_dump(25/7);// float(3.5714285714286)
var_dump((int) (25/7)); // int(3)
var_dump(round(25/7));  // float(4)
var_dump((int) "56");
var_dump((int) null);//0
$str="0";
$val = (int)$str;;
var_dump($val);


//convert integer only give result:from floatiom number,string,null,bool

//for other daya type it will shoe undefined

//Floating Point Numbers in PHP
$a = 1.234;      // Standard float
$b = 1.2e3;      // Exponential notation (1.2 * 10^3 = 1200)
$c = 7E-10;      // Exponential notation with a negative exponent (7 * 10^-10)
$d = 1_234.567;  // With underscores for readability (from PHP 7.4)

//conversion
//1.string
$str="123.456";
$float=(float)$str;
var_dump($float);
//2.interger
$int1 = 5;
$int_float = (float)$int1;  // Typecasting to float
var_dump($int_float); 

 //string in php

//1.singl Quotes:no variable parsing
$str ='hello,my name is smit';
echo $str."<br>";
//2.Double Quotes:allow varible parsing & escape sequences
$name="Smit";
$str="\n hello,$name";
echo $str."<br>";
//3.heredoc(<<<)-->Multi-line string with variable parsing
$name="Smit";
$str=<<<TEXT
hello,$name!
this is a today
TEXT;
echo nl2br($str)."<br>";
//Nowdoc (<<<'TEXT') → Multi-line string without variable parsingn
$name="Smit";
$str=<<<'TEXT'
hello,$name!
this is a today
TEXT;
echo $str."<br>";
//string build-in function
echo strlen($str) ."<br>";
echo strtoupper($str)."<br>";
echo strtolower($str)."<br>";
echo str_replace("hello","hi",$str)."<br>";

echo substr($str,3,7)."<br>";

//Concatenation(.)
$first="hello";
$second="smit";

echo $first ." ".$second."smit"."<br>";

//string interpolation
$name="smit";
echo "hello,$name"."<br>";//hello,smit for double qutoes
echo 'hello,$name'."<br>";//hello,name
//checking if a variabl eis a string 
$var="smit";
if(is_string($var)){
    echo "Yes,this is smit".'<br>';
}

//numeric string:A string is numeric if it contains only numbers (with optional + or - signs) and can be converted into an integer or float.

var_dump(is_numeric("123"));    // true (integer string)
var_dump(is_numeric("+123.45"));// true (float string)
var_dump(is_numeric("1.2e3"));  // true (scientific notation)
var_dump(is_numeric("abc123")); // false (not a numeric string)

//How to Safely Handle Numeric Strings
$str="10.5 pigs";
if(is_numeric($str)){
    echo "valid number";
}

//extract number from the string:it only  applid when interger appear stating of the string
$val=intval("10 pigs");
echo $val ."<br>";//it will give us to  10


$foo = 5 + "10.5";    // Returns 15.5 (as a float)
$bar = 5 + intval("10abc");   // Returns 15 (ignores "abc", considers 10 as valid)
//$baz = 5 + "bob3";    // Results in 5 (cannot parse "bob3", so it's treated as 0)
echo $bar;




?>