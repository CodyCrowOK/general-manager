<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$lineups = json_decode(file_get_contents("php://input"));

	foreach ($lineups as $lineup) {
		function player_order_id($player)
		{
			return $player->id;
		}
		$order = array_map("player_order_id", $lineup->order);
		Lineup::save_lineup($lineup->id, $lineup->name, $order, $user->id(), $user->team()->id());
	}
	
	http_response_code(200);
}
?>
