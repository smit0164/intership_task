<?php
$router->get('/','controller/index.php');

$router->post('/add','controller/store.php');

$router->delete('/delete','controller/destroy.php');

$router->get('/todo/edit','controller/edit.php');

$router->put('/todo/edit','controller/update.php');