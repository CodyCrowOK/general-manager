<?php
require "manager.php";

if ($user) {
	$template->set_view("recent_games");
	$template->set("NAV_ACTIVE_ID", "recent-games");

	$last_five_html = "<tr>
							<th>Date</th>
							<th>Oppenent</th>
							<th>Result</th>
						</tr>";
	$games = Game::last_five($user->team()->id());
	foreach ($games as $game) {
		$game_result = $game->win() == 1 ? "Win" : "Loss";
		$last_five_html .= "<tr>
							<td><a href=\"" . WWW_SITE . "game.php?id=" . $game->id() . "\">" . $game->date() . "</a></td>
							<td>" . $game->opponent() . "</td>
							<td>" . $game_result . "</td>
		</tr>";
	}
	$template->set("last_five", $last_five_html);

	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>