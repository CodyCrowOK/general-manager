<?php
require_once "/var/www/html/manager/manager.php";

if ($user) {

	$object = json_decode(file_get_contents("php://input"));

	Team::add_team($object->name, $user->id());

	http_response_code(200);
}
?>
