<?php
//Indexed Arrays:Indexed arrays are arrays in which each element has a numeric index, starting from 0 by default.

$array = array(1, 6, 5, 4, 5);
echo $array[1].'<br>';
$array[5]=6;
echo count($array) .'<br>';//count of array

array_push($array,8);

echo '<pre>';
print_r($array);  // Use print_r or var_dump to view the array structure
echo '</pre>';

array_pop($array);

echo '<pre>';
print_r($array);  // Use print_r or var_dump to view the array structure
echo '</pre>';

//Associative Arrays:Associative arrays use named keys (strings) instead of numeric indexes.
$array_associate=array(
    "name" => "John",
    "age" => 30,
    "city" => "New York"
);
echo $array_associate["name"].'<br>';
$array_associate["email"]="smithpatel@gmial.com";
$array_associate["age"] = 31;
// array_keys($array): Returns all the keys from an associative array.
// array_values($array): Returns all the values from an associative array.
// in_array($value, $array): Checks if a value exists in the array.
// array_key_exists($key, $array): Checks if a key exists in the array.
echo '<pre>';
print_r($array_associate);
echo '</pre>'; 

unset($array_associate["age"]);//for  deleteing the element

echo '<pre>';
print_r($array_associate);
echo '</pre>';

//Multidimensional Arrays:A multidimensional array is an array of arrays. This type of array is useful when you want to store more complex data structures.
$array_multi= array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 9)
);
echo '<pre>';
print_r($array_multi);
echo '</pre>';

$array_new = array(
    "first" => array("name" => "John", "age" => 25),
    "second" =>array("name"=>"smit","age"=>50),
);
echo '<pre>';
print_r($array_new);
echo '</pre>';

//useful array function
// 1.sort the array
sort($array);
print_r($array);
echo ".<br>";
asort($array_associate);
print_r($array_associate);
echo ".<br>";
//2.mergr a array
$array1 = [1, 2, 3];
$array2 = [4, 5, 6];
$merged = array_merge($array1, $array2);
print_r($merged);
//3.array searching
$serach=array_search(5,$array);
echo ".<br>";
print_r($serach);
//4.array reverse
$array_p=[6,7,8];
$array_p=array_reverse($array_p);
echo ".<br>";
print_r($array_p);
$arr = [1, 2, 3, 4, 5];
$filtered = array_filter($arr, function($value) {
    return $value > 3;
}); 
$arr = [1, 2, 3];
$mapped = array_map(function($value) { return $value * 2; }, $arr);
// Output: [2, 4, 6]

echo ".<br>";
$arr_i = [18, 29, 30];
foreach($arr_i as $x){
    echo "$x <br>";
}
echo ".<br>";
$car=array("brand"=>"ford","model"=>"xyz","year"=>2005);
foreach($car as $x=>$y){
     echo "$x:$y <br>";
}
echo ".<br>";
foreach($car as &$y){
        $y="ford";
}
var_dump($car);
echo ".<br>";
$cars = array("Volvo", "BMW", "Toyota");
array_splice($cars, 1, 1);
print_r($cars)
?>