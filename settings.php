<?php
require "manager.php";

if ($user) {
	$template->set_view("settings");
	$template->set("NAV_ACTIVE_ID", "settings-top");

	$user_settings = new UserSettings($user->id());

	$template->set("js_user_settings", json_encode($user_settings));


} else {
	$template->set_view("splash");
}

$template->render();
?>