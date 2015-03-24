<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require "/var/www/html/manager/manager.php";

$user = new User(15);

echo $user->team()->id();

?>
