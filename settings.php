<?php
require "manager.php";

if ($user) {
	$template->set_view("settings");
	$template->set("NAV_ACTIVE_ID", "settings-top");
} else {
	$template->set_view("splash");
}

$template->render();
?>