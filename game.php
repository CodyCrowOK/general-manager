<?php
require "manager.php";

if ($user) {
	$template->set_view("game");
	$template->set("NAV_ACTIVE_ID", "recent-games");
	if (is_numeric($_GET["id"]) && isset($_GET["id"])) {
		$game = new Game($_GET["id"]);
		
		$date_formatted = DateTime::createFromFormat('Y-m-d', $game->date());
		$template->set("date", $date_formatted->format('F j, Y'));

		$template->set("result", $game->result() . " vs " . $game->opponent());

		$offense_rows = '<tr>
							<th>Player</th>
							<th>Runs Created</th>
							<th><abbr title="Plate Appearances">PA</abbr></th>
							<th><abbr title="Hits">H</abbr></th>
							<th><abbr title="Walks">BB</abbr></th>
							<th><abbr title="Strikeouts">SO</abbr></th>
							<th><abbr title="Hit by Pitch">HBP</abbr></th>
							<th><abbr title="Doubles">2B</abbr></th>
							<th><abbr title="Triples">3B</abbr></th>
							<th><abbr title="Homeruns">HR</abbr></th>
							<th><abbr title="Runs Batted In">RBI</abbr></th>
							<th><abbr title="Sacrifice Bunts">SH</abbr></th>
							<th><abbr title="Sacrifice Flies">SF</abbr></th>
							<th><abbr title="Runs">R</abbr></th>
							<th><abbr title="Stolen Bases">SB</abbr></th>
							<th><abbr title="Caught Stealing">CS</abbr></th>
							<th><abbr title="Ground into Double Play">GDP</abbr></th>
							<th>Times on Base</th>
						</tr>';
		$or_copy = $offense_rows;

		foreach ($user->team()->players() as $player) {
			if (!$player->played_in_game($game->id())) continue;
			$batter = new GameBatter($player->id(), $game->id());

			$ab = $batter->pa - ($batter->bb + $batter->hbp + $batter->sf + $batter->sh);
			$rca = $batter->h + $batter->bb - $batter->cs + $batter->hbp;
			$rcb = (1.125 * ($batter->h - ($batter->doubles + $batter->triples + $batter->hr))) + (1.69 * $batter->doubles) + (3.02 * $batter->triples) + (3.73 * $batter->hr) + (.29 * ($batter->bb + $batter->hbp)) + (.492 * (($batter->sh + $batter->sf) + $batter->sb)) - (.04 * $batter->so);
			$rcc = $ab + $batter->bb + $batter->hbp + $batter->sf + $batter->sh;
			$rc = (((2.4 * $rcc + $rca) * (3 * $rcc + $rcb)) / (9 * $rcc)) - (.9 * $rcc);

			$offense_rows .= "<tr>
						<td>" . $batter->name() . "</td>
						<td>" . $rc . "</td>
						<td>" . $batter->pa . "</td>
						<td>" . $batter->h . "</td>
						<td>" . $batter->bb . "</td>
						<td>" . $batter->so . "</td>
						<td>" . $batter->hbp . "</td>
						<td>" . $batter->doubles . "</td>
						<td>" . $batter->triples . "</td>
						<td>" . $batter->hr . "</td>
						<td>" . $batter->rbi . "</td>
						<td>" . $batter->sh . "</td>
						<td>" . $batter->sf . "</td>
						<td>" . $batter->r . "</td>
						<td>" . $batter->sb . "</td>
						<td>" . $batter->cs . "</td>
						<td>" . $batter->gdp . "</td>
						<td>" . $batter->tob . "</td>
					</tr>
					";
		}
		if ($or_copy == $offense_rows) $offense_rows = "<em>Sorry, no offensive data was entered for this game.</em>";
		$template->set("offense_rows", $offense_rows);

	} else {
		header('Location: recent_games.php');
	}

	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>