<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssociativArrays</title>
</head>
<body>
    <?php
       $books=[
           [
              "name"=>"math magic",
              "author"=>"xyz",
              "url"=>"https://www.w3school.com",
           ],
           [
             "name"=>"3.59AM",
              "author"=>"j.cole1",
              "url"=>"https://www.w3school.com",
           ],
           [
            "name"=>"1011",
              "author"=>"50",
              "url"=>"https://www.w3school.com",
           ],
       ];
    ?>

    <?php
      foreach($books as $book){
          echo "<a href='{$book['url']}'>{$book['name']}<br></a>";
      }
    ?>

    <?php  foreach($books as $book): ?>
        <a href="<?php echo $book['url'] ?>"> 
            <?=  $book['name'] ."<br>"?>
        </a>
    <?php  endforeach;?>
    
</body>
</html>