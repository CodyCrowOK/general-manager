<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$innings = json_decode(file_get_contents("php://input"));

	UserSettings::update_innings($user->id(), $innings);

	http_response_code(200);
}
?>
