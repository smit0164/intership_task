<?php
//sanitize a string:remove the unnessary things
// $str="<h1>hello world!</h1>";
// $newstr=filter_var($str,FILTER_SANITIZE_STRING);
// echo $newstr. "<br>";

$a=10;

if(!filter_var($a, FILTER_VALIDATE_INT)==false){
    echo"Integer is valid";
}else{
    echo"inter is not valid";
}
//if we set $a=0 then it show invalid so for this proble chek below code
$int=0;
if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false) {
    echo("Integer is valid");
  }else {
    echo("Integer is not valid");
  }

 //check valid ip
  $ip = "127.0.0.1";
  
  if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
    echo("$ip is a valid IP address");
  } else {
    echo("$ip is not a valid IP address");
  }
  //check email
  $email="smithpatel895@gmail.com<>";

  $email=filter_var($email,FILTER_SANITIZE_EMAIL);
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)===false){
     echo "$email is valid";
  }else{
      echo "$email is not valid";
  }
?>