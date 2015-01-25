<?php
require "manager.php";

if ($user) {
	$template->set_view("offense");
	$template->set("NAV_ACTIVE_ID", "offense");

	$standard_rows = "";
	$advanced_rows = "";
	foreach ($user->team()->players() as $player) {
		$stats = new BatterStats($player->id());
		$standard_rows .= "<tr>
					<td>" . $stats->name() . "</td>
					<td>" . sprintf("%.3f", $stats->avg()) . "</td>
					<td>" . sprintf("%.3f", $stats->obp()) . "</td>
					<td>" . sprintf("%.3f", $stats->slg()) . "</td>
					<td>" . $stats->h . "</td>
					<td>" . $stats->ab() . "</td>
					<td>" . $stats->rbi . "</td>
					<td>" . $stats->doubles . "</td>
					<td>" . $stats->triples . "</td>
					<td>" . $stats->hr . "</td>
					<td>" . $stats->so . "</td>
					<td>" . $stats->g() . "</td>
				</tr>
				";
		$advanced_rows .= "<tr>
					<td>" . $stats->name() . "</td>
					<td>" . sprintf("%.3f", $stats->avg()) . "</td>
					<td>" . sprintf("%.3f", $stats->ops()) . "</td>
					<td>" . sprintf("%.3f", $stats->rc()) . "</td>
					<td>" . sprintf("%.3f", $stats->rc27()) . "</td>
					<td>" . sprintf("%.3f", $stats->base_runs()) . "</td>
					<td>" . sprintf("%.3f", $stats->isolated_power()) . "</td>
					<td>" . sprintf("%.3f", $stats->secondary_average()) . "</td>
					<td>" . sprintf("%.3f", $stats->bb_per_k()) . "</td>
					<td>" . sprintf("%.3f", $stats->woba()) . "</td>
					<td>" . $stats->tob . "</td>
				</tr>
				";
	}
	$template->set("standard_rows", $standard_rows);
	$template->set("advanced_rows", $advanced_rows);


	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>