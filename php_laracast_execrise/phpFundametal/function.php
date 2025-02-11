<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>function</title>
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
       function filterByAuthor($books){
            $filterBooks=[];
            foreach($books as $book){
                if($book['author']==="xyz"){
                    $filterBooks[]=$book;
                }
            }
            return $filterBooks;
       }
?>
  <ul>
  <?php
    // foreach (filterByAuthor($books) as $book){
    //     echo "<li>
    //     <h1>{$book['name']}</h1>by
    //     <h3>{$book['author']}</h3>
    //     </li>";
    // }
  ?>
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