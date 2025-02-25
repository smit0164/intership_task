<?php
$router->get('/','controller/index.php');
//add group and add expense route
$router->post('/groups','controller/groups/store.php');
$router->post('/expenses','controller/expenses/store.php');
//delete  group and delete expense
$router->delete('/deleteGroup','controller/groups/destroy.php');
$router->delete('/deleteExpense','controller/expenses/destroy.php');
//edit group and edit expense
$router->patch('/editGroup','controller/groups/update.php');
$router->patch('/editExpense','controller/expenses/update.php');


$router->post('/validate-group', 'controller/fetch/validate-group.php');
$router->post('/checkGroupName', 'controller/fetch/checkGroupName.php');

$router->get('/fetchGroups','controller/fetch/fetchGroups.php');
$router->get('/fetchData','controller/fetch/fetch_data.php');

$router->get('/fetchDashboard','controller/fetch/fetchDashboard.php');

