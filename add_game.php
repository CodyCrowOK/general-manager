<?php
require "manager.php";

if ($user) {
	$template->set_view("add_game");
	$template->set("NAV_ACTIVE_ID", "add-game");

	$select_options_players = "<option value=\"0\"></option>";
	foreach ($user->team()->players() as $player) {
		if ($player->is_pitcher()) $pit = " (Pitcher)";
		$select_options_players .= "<option value=\"" . $player->id() . "\">#" . $player->number() . " " . $player->name() . $pit . "</option>
		";
	}

	$template->set("select_options_players", $select_options_players);

	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>