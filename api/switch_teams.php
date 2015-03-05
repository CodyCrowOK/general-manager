<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$team_id = json_decode(file_get_contents("php://input"));

	UserSettings::switch_team($user->id(), $team_id);
	
	http_response_code(200);
}
?>
