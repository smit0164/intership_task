<?php
//switch statment
$a="monday";
switch ($a){
    case "monday":
          echo "This is a monday";
          
    case  "friday":
          echo "this is a friday";
          
    default:
         echo "this is your best day";


}

//for loop
for($i=0;$i<=10;$i++){
    echo "iteration $i <br>";
}

//while loop
$i=0;
while($i<=10){
    echo "iteration $i <br>";
    $i++;
}
//foreach loop
$fruits=["Apple","orange","tomato"];
foreach($fruits as $fruit){
    echo "$fruit <br>";
}

foreach($fruits as &$f){
    $f="frod";
}
unset($f);
print_r($fruits);

echo "<br>";
$person=["name"=>"smit","Age"=>"20","xyz"=>"xyz"];
foreach($person as $key=>$value){
       echo "$key:$value<br>";
}

//Jump Statements
//exit():stop  the execuion and show the message
echo "Before exit.";
echo "<br>";
exit("excution stop  at 49 line");
echo "this is not print";

?>