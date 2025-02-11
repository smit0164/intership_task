<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>
    <?php echo "method:1" ?>
    <?php
     $books=[
        "xyz",
        "abc",
        "123"
     ];
    ?>
    <?php 
      foreach($books as $book){
         //echo "<li>" . $book ."</li>";
          echo "<li>{$book}</li>";
      }
    ?>

    
    <?php echo "method:2" ?>
    <?php foreach($books as $book):?>
        <li><?= $book?> </li>
    <?php endforeach; ?>
    
</body>
</html>