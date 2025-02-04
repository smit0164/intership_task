<?php
// 1️⃣ User-defined functions (Custom functions)
// 2️⃣ Built-in functions (Predefined in PHP)
// 3️⃣ Anonymous (Lambda) functions
// 4️⃣ Arrow functions
// 5️⃣ Recursive functions
// 6️⃣ Variable functions


//user-defined function
function greet(){
    echo "hello,World!";
}
greet();
echo "<br>";
//function with parameters
function add($a,$b){
    echo $a+$b;
}
add(4,5);
echo "<br>";
//function with default parameters
function welcome($name="Guest"){
    echo "welcome,$name";
}
welcome();
echo "<br>";
welcome("smit1");
//function with return
function add1($a,$b){
    return $a+$b;
}
echo "<br>";
$answer=add1(3,6);
echo "this is a answer:$answer";

echo "<br>";
echo date('d-m-Y');

//Anonymous(Lambda) function
$answer1=function($name){
    return "Hello,$name";
};
echo "<br>";
echo $answer1("smit");
//Arrow function 
echo "<br>";
$newanswer=fn($a1,$b1)=>$a1+$b1;
echo $newanswer(4,6);
//differnces between arrow and lambada function
//for accesing outer varible we use this thing:use($factor)
//lambda function
$factor=2;
$result=function($num)use($factor){
    return $num*$factor;
};
echo "<br>";
echo $result(5);
echo "<br>";
//arow function example
$arrow_result=fn($num)=>$num*$factor;

echo $arrow_result(5);

?>