<?php


// return [
//     '/'=>"controller/index.php",
//     '/about'=>"controller/about.php",
//     '/contact'=>"controller/contact.php",
//     '/notes'=>"controller/notes/index.php",
//     '/notes/create'=>'controller/notes/create.php',
//     '/note'=>"controller/notes/show.php",
// ];

$router->get('/','controller/index.php');
$router->get('/about','controller/about.php');
$router->get('/contact','controller/contact.php');
$router->get('/notes','controller/notes/index.php');
$router->get('/notes/create','controller/notes/create.php');
$router->get('/note','controller/notes/show.php');
$router->delete('/note','controller/notes/destroy.php');
$router->post('/notes/create','controller/notes/store.php');
$router->get('/note/edit','controller/notes/edit.php');
$router->patch('/notes','controller/notes/update.php');
$router->get('/register','controller/registration/create.php');
$router->post('/register','controller/registration/store.php');