<?php
require "manager.php";

if ($user) {
	$template->set_view("workspace");
	$template->set("NAV_ACTIVE_ID", "workspace");

	//Does the user have any lineups?
	$offense = new OffenseWorkspace($user->team()->id());

	//Get Lineups and pass them to the front end.
	$js_data = $offense->get_json_representation();

	$js_player_data = json_encode($user->team()->players());

	
	$template->set("js_data", $js_data);
	$template->set("js_player_data", $js_player_data);
	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>
