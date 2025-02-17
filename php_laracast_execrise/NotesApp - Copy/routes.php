<?php


// return [
//     '/'=>"/index.php",
//     '/about'=>"/about.php",
//     '/contact'=>"/contact.php",
//     '/notes'=>"/notes/index.php",
//     '/notes/create'=>'/notes/create.php',
//     '/note'=>"/notes/show.php",
// ];

$router->get('/','index.php');
$router->get('/about','about.php');
$router->get('/contact','contact.php');

$router->get('/notes','notes/index.php')->only('auth');

$router->get('/notes/create','notes/create.php');
$router->post('/notes/create','notes/store.php');

$router->get('/note','notes/show.php');
$router->patch('/notes','notes/update.php');
$router->delete('/note','notes/destroy.php');

$router->get('/note/edit','notes/edit.php');

$router->get('/register','registration/create.php')->only('guest');
$router->post('/register','registration/store.php');
$router->get('/login','session/create.php')->only('guest');
$router->post('/session','session/store.php');
$router->delete('/session','session/destroy.php')->only("auth");