<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
              "author"=>"xyz",
              "url"=>"https://www.w3school.com",
           ],
           [
            "name"=>"1011",
              "author"=>"50",
              "url"=>"https://www.w3school.com",
           ],
       ];
       //anonymous_function below
       $filterByAuthor=function($books){
            $filterBooks=[];
            foreach($books as $book){
                if($book['author']==="xyz"){
                    $filterBooks[]=$book;
                }
            }
            return $filterBooks;
       }

    
?>
   <?php  foreach($filterByAuthor($books) as $book): ?>
        <li>
         <a href="<?=$book['url']?>">
              <?=$book['name']."-"?><?= "By"."(".$book['author'].")" ?> 
         </a>
       </li>
   <?php endforeach;?>

   <?php
   //inbiuid filter array from php
   $filter_array=array_filter($books,function($book){
         return $book['author']==="xyz";
   })
  
   ?>
   <?php foreach($filter_array as $book):?>
        <li><?=$book['name']?></li>
   <?php endforeach;?>
   
</body>
</html>