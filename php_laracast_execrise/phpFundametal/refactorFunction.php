<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refactor</title>
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

    function filter($items,$fn){
          $filterArray=[];
          foreach($items as $item){
            if($fn($item)){
                $filterArray[]=$item;
            }
          } 
          return $filterArray;
    }
    $filterBook=filter($books,function($book){
           return $book['author']==='50';
    });


    ?>
    <ul>
    <?php foreach($filterBook as $book):?>
        <li><?php echo $book['name'] ." by  ". $book['author'] ?></li>
    <?php endforeach;?>
    </ul>
</body>
</html>