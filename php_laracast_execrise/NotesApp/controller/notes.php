<?php
$heading="Notes";
$config=require("config.php");
$db=new Database($config['database']);
$notes=[];

$notes=$db->query("select* from notes")->fetchAll();

require "view/notes.view.php";