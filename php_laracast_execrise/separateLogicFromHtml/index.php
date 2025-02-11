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
