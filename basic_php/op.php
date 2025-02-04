<?php
//comparison operators
$a=5;
$b=5;

var_dump(($a==$b));
echo "<br>";
var_dump( ($a===$b));

var_dump(($a!==$b));

var_dump(($a<=>$b));


//Logical Operators
//&&(higher precedence) and and(lower precedesnc)
$a=true && false;
var_dump($a);
echo "<br>";
$b=true and false;
var_dump($b);

//||(higher precedence) and OR(lower precedesnc)
$a1=true || false;
var_dump($a1);
echo "<br>";
$b1=false or true;
var_dump($b1);

//string operator
$str="Hello";
$str.="World!";
echo $str;
echo "<br>";
$str1=$str."jo";
echo $str1;

//Array Operators
$a=["x"=>1,"y"=>2,"z"=>3];
$b=["y"=>2,"z"=>3,"x"=>1];
$c=["x"=>4,"m"=>7];

//1.union:keep first array value then key check in second array
$uni=$a+$b;
echo "<br>";
print_r($uni);

//2.Equality(==) :same key -value pair (order does not match)
var_dump($a==$b);

//3.Identity (===) - Same key-value pairs and order
var_dump($a===$b);
//4.Not Equal (!=) - Different key-value pairs
var_dump($a!=$b);//give us false

// 6️⃣ Not Identical (!==) - Different key-value pairs OR order
var_dump($a !== $b);
?>
