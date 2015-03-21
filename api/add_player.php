<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$player = json_decode(file_get_contents("php://input"));

        Player::create_player($user->team()->id(), $player->name, $player->number, $player->is_pitcher);

	http_response_code(200);
}
?>
