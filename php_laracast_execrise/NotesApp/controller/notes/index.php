<?php
$heading="Notes";
$config=require("config.php");
$db=new Database($config['database']);
$notes=[];

$notes=$db->query("select * from notes")->get();

require "view/notes/index.view.php";