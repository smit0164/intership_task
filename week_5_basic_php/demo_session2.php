<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_unset();
    echo "favorite color is" .$_SESSION["favcolor"]. "<br>";
    $_SESSION["favcolor"]="yellow";
    print_r($_SESSION);
    session_destroy();
    ?>
</body>
</html>