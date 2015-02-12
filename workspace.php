<?php
require "manager.php";

if ($user) {
	$template->set_view("workspace");
	$template->set("NAV_ACTIVE_ID", "workspace");

	//Does the user have any lineups?
	$offense = new OffenseWorkspace($user->team()->id());


	if (!count($offense->lineups)) {
		$lineup_list = "<a href=\"#\" id=\"new-lineup\" class=\"list-group-item active\">New Lineup...</a>";
	} else {
		$lineup_list = "";
		foreach ($offense->lineups as $lineup) {
		$lineup_list .= "<a href=\"#\" id=\"lineup-" . $lineup->id . "\" class=\"list-group-item\">" . $lineup->name . "</a>";

		}
		$lineup_list .= "<a href=\"#\" id=\"new-lineup\" class=\"list-group-item\"><em>New Lineup...</em></a>";

		
	}

	//Get Lineups and pass them to the front end.
	$js_data = $offense->get_json_representation();

	
	$template->set("js_data", $js_data);
	$template->set("lineup_list", $lineup_list);
	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>
