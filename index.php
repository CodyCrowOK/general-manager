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
	$pitchers_html = "<tr>
							<th>#</th>
							<th>Name</th>
							<th>Earned Run Average</th>
						</tr>";
	foreach ($user->team()->players() as $player) {
		$stats = new BatterStats($player->id());
		$position_player_html .= "<tr>
			<td>" . $player->number . "</td>
			<td>" . $player->name . "</td>
			<td>" . sprintf("%.3f", $stats->avg()) . "</td>
		</tr>";
		if (!$player->is_pitcher()) continue;
		$pstats = new PitcherStats($player->id());
		$pitchers_html .= "<tr>
					<td>" . $player->number() . "</td>
					<td>" . $player->name() . "</td>
					<td>" . sprintf("%.3f", $pstats->era()) . "</td>
				</tr>";
	}

	$pythagorean = $user->team()->pythagorean_expectation();

	$template->set("pythag", sprintf("%.3f", $pythagorean));
	$template->set("position_player", $position_player_html);
	$template->set("pitchers", $pitchers_html);


	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>
