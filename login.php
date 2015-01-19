<?php
require "manager.php";


if ($user) {
	header('Location: index.php');
} else {
	if ($_POST["email"] && $_POST["password"]) {
		$email = $_POST["email"];
		$password = $_POST["password"];
		if (User::log_in($email, $password)) {
			header('Location: index.php');
		} else {
			$message = "Sign in attempt was unsuccessful.";
			$template->set("message", $message);
		}
	}
	if (!$message) $template->set("message", "");

	$template->set_view("login");
}

$template->render();
?>