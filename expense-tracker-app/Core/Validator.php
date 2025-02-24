<?php
namespace Core;
use Core\Database\App;

class Validator
{
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;    
    }

    public static function number($value) {
        return is_numeric($value);
    }

    public static function date($value) {
        return strtotime($value) !== false;
    }

    public static function groupExists($groupName) {
        $groupName = trim($groupName);
        $db = App::resolve('Core\Database\Database');

        $result = $db->query("SELECT COUNT(*) as count FROM `groups` WHERE groupName = :groupName", [
            'groupName' => $groupName,
        ])->find();

        return $result['count'] > 0;
    }

    public static function expenseExists($expenseName, $expenseAmount) {
        $expenseName = trim($expenseName);
        $expenseAmount = trim($expenseAmount);
        $db = App::resolve('Core\Database\Database');

        $result = $db->query("SELECT COUNT(*) as count FROM `expenses` WHERE expenseName = :expenseName AND expenseAmount = :expenseAmount", [
            'expenseName' => $expenseName,
            'expenseAmount' => $expenseAmount
        ])->find();

        return $result['count'] > 0;
    }
}
