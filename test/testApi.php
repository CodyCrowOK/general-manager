<?php
require_once "/var/www/html/manager/manager.php";

$user = new User(2);
Player::create_player($user->team()->id(), "James", 45, 1);

?>
