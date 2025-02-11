<?php
require "index.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>function</title>
</head>
<body>

  <ul>
  
  <?php  foreach(filterByAuthor($books) as $book):?>
       <li>
        <a href="<?=$book['url']?>">
             <?=$book['name']."-"?><?= "By"."(".$book['author'].")" ?> 
        </a>
      </li>
  <?php endforeach;?>
  </ul>
</body>
</html>