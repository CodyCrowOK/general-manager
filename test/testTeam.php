<?php
require "../manager.php";
$team = new Team(1);
//var_dump($team);
//var_dump($team->players());

User::log_in("james@gmail.com", "password");
$user = new User($_SESSION["uid"]);

var_dump($user);
var_dump($user->team());

?>