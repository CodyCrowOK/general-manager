<?php
require "manager.php";

if ($user) {
	$template->set_view("index");
	$template->set("NAV_ACTIVE_ID", "overview");

	$position_player_html = "<tr>
							<th>#</th>
							<th>Name</th>
							<th>Batting Average</th>
						</tr>";
	foreach ($user->team()->players() as $player) {
		$position_player_html .= "<tr>
			<td>" . $player->number . "</td>
			<td>" . $player->name . "</td>
			<td>.000</td>
		</tr>";
	}
	$template->set("position_player", $position_player_html);
	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>