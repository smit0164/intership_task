<?php
namespace Core;
use Core\Database\App;
class Validator
{
    public static function string($value,$min=1,$max=INF){
       $value=trim($value);
       return strlen($value)>=$min && strlen($value)<=$max;    
    }
    public static function groupExists($groupName){
        $groupName=trim($groupName);
        $db=App::resolve('Core\Database\Database');
        $result=$db->query("select COUNT(*) from `groups` where groupName=:groupName",[
             'groupName'=>$groupName,
        ])->find();
        return $result['COUNT(*)'];
    }

    public static function expenseExists($expenseName,$expenseAmount){
        $expenseName=trim($expenseName);
        $expenseAmount=trim($expenseAmount);
        $db=App::resolve('Core\Database\Database');
        $result=$db->query("select COUNT(*) from `expenses` where expenseName=:expenseName and expenseAmount=:expenseAmount ",[
             'expenseName'=>$expenseName,
             'expenseAmount'=>$expenseAmount
        ])->find();
        return $result['COUNT(*)'];
    }
}