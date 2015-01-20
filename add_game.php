<?php
require "manager.php";

if ($user) {
	$template->set_view("add_game");
	$template->set("NAV_ACTIVE_ID", "add-game");



	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>