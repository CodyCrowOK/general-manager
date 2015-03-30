<?php
require "manager.php";

if ($user) {
	$template->set_view("pitching");
	$template->set("NAV_ACTIVE_ID", "pitching");

	$standard_rows = "";
	$advanced_rows = "";
	foreach ($user->team()->players() as $player) {
		if (!$player->is_pitcher()) continue;
		$stats = new PitcherStats($player->id(), $user->settings->innings);
		$standard_rows .= "<tr>
					<td>" . $stats->name() . "</td>
					<td>" . sprintf("%.3f", $stats->era()) . "</td>
					<td>" . $stats->ip . "</td>
					<td>" . $stats->w . "</td>
					<td>" . $stats->l . "</td>
					<td>" . $stats->s . "</td>
					<td>" . $stats->bs . "</td>
					<td>" . sprintf("%.3f", $stats->w / ($stats->w + $stats->l)) . "</td>
					<td>" . $stats->h . "</td>
					<td>" . $stats->bb . "</td>
					<td>" . $stats->hbp . "</td>
					<td>" . $stats->er . "</td>
					<td>" . $stats->k . "</td>
					<td>" . $stats->g() . "</td>
				</tr>
				";
		$advanced_rows .= "<tr>
					<td>" . $stats->name() . "</td>
					<td>" . sprintf("%.3f", $stats->whip()) . "</td>
					<td>" . sprintf("%.3f", $stats->h9()) . "</td>
					<td>" . sprintf("%.3f", $stats->bb9()) . "</td>
					<td>" . sprintf("%.3f", $stats->k9()) . "</td>
					<td>" . sprintf("%.3f", $stats->k_per_bb()) . "</td>
					<td>" . sprintf("%.3f", $stats->fip()) . "</td>
					<td>" . sprintf("%d", $stats->qs()) . "</td>
					<td>" . sprintf("%.3f", $stats->lob()) . "</td>
					<td>" . sprintf("%.3f", $stats->oba()) . "</td>
					<td>" . sprintf("%d", $stats->holds) . "</td>
					<td>" . $stats->bf . "</td>
				</tr>";
	}

	$template->set("standard_rows", $standard_rows);
	$template->set("advanced_rows", $advanced_rows);
	$template->set("user_innings", $user->settings->innings);

	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>
