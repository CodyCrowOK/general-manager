<?php
require "manager.php";

if ($_POST["name"] && $_POST["email"] && $_POST["password"] && $_POST["teamname"]) {
	$message = User::create_user($_POST["name"], $_POST["email"], $_POST["password"], $_POST["teamname"]);
	if (!$message) {
		header('Location: login.php');
	}
}

if ($user) {
	$template->set_view("index");
} else {
	if ($message) {
		$template->set("message", $message);
	} else {
		$template->set("message", "");
	}
	$template->set_view("register");
}

$template->render();
?>
