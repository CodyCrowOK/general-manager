<?php
require "manager.php";

if ($user) {
	$template->set_view("settings");
	$template->set("NAV_ACTIVE_ID", "settings-top");

	$user_settings = new UserSettings($user->id());
	$team_settings = new TeamSettings($user->id());

	$template->set("js_user_settings", json_encode($user_settings));
	$template->set("js_team_settings", json_encode($team_settings));


} else {
	$template->set_view("splash");
}

$template->render();
?>