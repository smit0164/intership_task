<?php
$cookie_name = "usersmit";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("user", "", time() - 3600);


?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
  echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
}
if(count($_COOKIE)>0){
    echo '<br>';
    echo "Cookies are enabled.";
}else{
    echo "Cookies are disabled.";
}
?>

</body>
</html>