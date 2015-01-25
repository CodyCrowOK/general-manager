<?php
require "manager.php";

if ($user) {
	if ($_POST) {
		//First, create the game.
		if (Site::validate_date($_POST["date"])) {
			$date = $_POST["date"];
		} else {
			$date = "";
		}

		if ($_POST["result"] == "on") {
			$game_result = 1;
		} else {
			$game_result = 0;
		}
		$opponent = htmlentities($_POST["opponent"]);

		$game_id = Game::create_game($user->team()->id(), $date, $game_result, $opponent);
		
		process_offensive_form_data($game_id);
		process_defensive_form_data($game_id);

	}
	$template->set_view("add_game");
	$template->set("NAV_ACTIVE_ID", "add-game");

	$select_options_players = "<option value=\"0\"></option>";
	foreach ($user->team()->players() as $player) {
		if ($player->is_pitcher()) $pit = " (Pitcher)";
		$select_options_players .= "<option value=\"" . $player->id() . "\">#" . $player->number() . " " . $player->name() . $pit . "</option>
		";
		unset($pit);
	}

	$template->set("select_options_players", $select_options_players);

	$select_options_pitchers = "<option value=\"0\"></option>";
	foreach ($user->team()->players() as $player) {
		if ($player->is_pitcher()) {
			$select_options_pitchers .= "<option value=\"" . $player->id() . "\">#" . $player->number() . " " . $player->name() . "</option>
			";
		}
	}
	$template->set("select_options_pitchers", $select_options_pitchers);

	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();

function process_offensive_form_data($game_id)
{
	for ($i = 0; $i < count($_POST["player"]); $i++) {
		if ($_POST["player"][$i] == 0) continue;
		if (Player::id_is_on_team($_POST["player"][$i])) continue;

		$args = [];
		$args[] = $_POST["player"][$i];
		$args[] = $_POST["opa"][$i];
		$args[] = $_POST["oh"][$i];
		$args[] = $_POST["obb"][$i];
		$args[] = $_POST["oso"][$i];
		$args[] = $_POST["ohbp"][$i];
		$args[] = $_POST["o2b"][$i];
		$args[] = $_POST["o3b"][$i];
		$args[] = $_POST["ohr"][$i];
		$args[] = $_POST["orbi"][$i];
		$args[] = $_POST["osh"][$i];
		$args[] = $_POST["osf"][$i];
		$args[] = $_POST["or"][$i];
		$args[] = $_POST["osb"][$i];
		$args[] = $_POST["ocs"][$i];
		$args[] = $_POST["ogdp"][$i];
		$args[] = $_POST["otob"][$i];

		Game::create_game_offense($game_id, $args);
	}
	return;
}

function process_defensive_form_data($game_id)
{
	for ($i = 0; $i < count($_POST["pitcher"]); $i++) {
		if ($_POST["pitcher"][$i] == 0) continue;
		if (Player::id_is_on_team($_POST["pitcher"][$i])) continue;

		$args = [];
		$args[] = $_POST["pitcher"][$i];
		$args[] = $_POST["pstart"][$i];
		$args[] = $_POST["pw"][$i];
		$args[] = $_POST["pl"][$i];
		$args[] = $_POST["phold"][$i];
		$args[] = $_POST["psave"][$i];
		$args[] = $_POST["pbs"][$i];
		$args[] = $_POST["pip"][$i];
		$args[] = $_POST["ph"][$i];
		$args[] = $_POST["pbb"][$i];
		$args[] = $_POST["phb"][$i];
		$args[] = $_POST["per"][$i];
		$args[] = $_POST["pk"][$i];
		$args[] = $_POST["pbf"][$i];
		$args[] = $_POST["phr"][$i];

		Game::create_game_defense($game_id, $args);
	}
	return;
}
?>