<?php
//iterator:An iterator is an object that provides methods and functionality to iterate over a collection (like an array, multidimensional array, database results, or custom objects). Instead of using foreach directly, an iterator controls how the iteration happens using built-in methods.
//Key Features of an Iterator:
// It is an object, not just a variable.
// It follows the Iterator interface in PHP.
// It provides methods like:
// current() → Get the current item.
// next() → Move to the next item.
// key() → Get the current key/index.
// valid() → Check if the current position is valid.
// rewind() → Reset the iterator to the beginning.

//example 1
$data1=["apple","orange","cherry"];
$iterator=new ArrayIterator($data1);

while($iterator->valid()){
     echo $iterator->current() . "<br>";
     $iterator->next();
}
echo "<br>";
//2. Problem: Traversing a Multidimensional Array
$data = [
    ["id" => 1, "firstname" => "Smit", "lastname" => "Patel"],
    ["id" => 2, "firstname" => "Raj", "lastname" => "Shah"]
];

foreach ($data as $row) {
    foreach ($row as $key => $value) {
        echo "$key: $value <br>";
    }
}
//. Solution: Recursive Iterators
$arrayIterator = new RecursiveArrayIterator($data);
foreach ($arrayIterator as $key => $value) {
    print_r($value);
}

echo "<br>";

$arrayIterator = new RecursiveArrayIterator($data);
$recursiveIterator = new RecursiveIteratorIterator($arrayIterator);

foreach ($recursiveIterator as $key => $value) {
    echo "$key: $value <br>";
}
?>