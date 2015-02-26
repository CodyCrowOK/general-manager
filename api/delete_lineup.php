<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$id = json_decode(file_get_contents("php://input"));

	if (is_numeric($id)) {
		Lineup::delete_lineup($id, $user->team()->id());
	}

	http_response_code(200);
}
?>
