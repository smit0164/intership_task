<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- method one to write if and else -->
<?php
//     $book="xyz";
//     $read=true;
//     if($read){
//         $msg="you read the book called $book";
//     }

?>
<?php //echo $msg; ?>
<!-- second method  to write if and else -->
<?php $read=true;
$book ="xyz"
?>
<?php if($read): ?>
    <h1>if you have read the book called <?php echo $book ?> </h2>
<?php else:?>
    <h1>if you have not read the book called <?php echo $book ?> </h2>
<?php endif; ?>    
</body>
</html>