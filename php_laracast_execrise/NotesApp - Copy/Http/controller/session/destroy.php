<?php
use core\Authenticator;
$auth=new Authenticator();
$auth->logout();

header("location: /");
exit();