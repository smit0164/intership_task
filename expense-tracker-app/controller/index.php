<?php
session_start();
use Core\Database\App;
$db=App::resolve('Core\Database\Database');

$db->query("SELECT * FROM `groups`");
$groups = $db->findAll();

$db->query("SELECT * FROM `expenses`");
$expenses = $db->findAll();

$groupedData = [];
foreach($groups as $group){
    $groupedData[$group['groupName']]=[
        'groupId'=>$group['id'],
        'expenses'=>[],
    ];
}
$groupMap = [];
foreach($groups as $group){
    $groupMap[$group['id']]=$group['groupName'];
}
foreach($expenses as $expense){
    $groupId=$expense['expenseGroup'];
    if(isset($groupMap[$groupId])){
        $groupName=$groupMap[$groupId];
        $groupedData[$groupName]['expenses'][]=$expense;
    }
}
$totalSum=$db->query("SELECT SUM(expenseAmount) AS total_expense FROM expenses")->find();
$maxExpense=$db->query("SELECT MAX(expenseAmount) AS max_expense FROM expenses")->find();
$thisMonth=$db->query("SELECT SUM(expenseAmount) AS total_this_month 
FROM expenses 
WHERE MONTH(expenseDate) = MONTH(CURRENT_DATE()) 
AND YEAR(expenseDate) = YEAR(CURRENT_DATE());")->find();



require basePath('view/index.view.php');