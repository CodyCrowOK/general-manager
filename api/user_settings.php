<?php
require_once "/var/www/html/manager/manager.php";

if ($user = new User(2)) {

	$js_object = json_decode(file_get_contents("php://input"));

	if ($js_object->key == "name") {
		UserSettings::update_name($user->id(), $js_object->value);
	}
	if ($js_object->key == "email") {
		UserSettings::update_email($user->id(), $js_object->value);
	}
	if ($js_object->key == "password") {
		UserSettings::update_password($user->id(), (string) $js_object->value);
	}
	/*
	if ($js_object->key == "email") {
		UserSettings::update_email($user->id(), $js_object->value);
	}
	if ($js_object->key == "password") {
		UserSettings::update_password($user->id(), $js_object->value);
	}
*/

	http_response_code(200);
}
?>
