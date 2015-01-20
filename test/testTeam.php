<?php
require "../manager.php";
//var_dump($team);
//var_dump($team->players());

User::log_in("james@gmail.com", "password");
$user = new User($_SESSION["uid"]);

var_dump(Game::last_five(1));

var_dump(Game::last_five($user->team()->id()));

$games = Game::last_five($user->team()->id());

?>