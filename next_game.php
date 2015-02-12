<?php
require "manager.php";

if ($user) {
	$template->set_view("next_game");
	$template->set("NAV_ACTIVE_ID", "next-game");

	$used_players = [];
	$lineup = [];
	$simple_lineup_html = "";

	$lineup[3] = BatterStats::highest_ops($user->team()->players());
	$used_players[] = $lineup[3]->id();

	$lineup[4] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[4]->id();

	$lineup[1] = BatterStats::best_remaining_obp($user->team()->players(), $used_players);
	$used_players[] = $lineup[1]->id();
	
	$lineup[2] = BatterStats::best_remaining_obp($user->team()->players(), $used_players);
	$used_players[] = $lineup[2]->id();

	$lineup[5] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[5]->id();

	$lineup[6] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[6]->id();

	$lineup[7] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[7]->id();

	$lineup[8] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[8]->id();

	$lineup[9] = BatterStats::best_remaining_slg($user->team()->players(), $used_players);
	$used_players[] = $lineup[9]->id();

	$simple_lineup_slg = 0;
	$simple_lineup_obp = 0;
	//$rc_total = 0;
	for ($i = 1; $i < 10; $i++) {
		$batter = $lineup[$i];
		$simple_lineup_html .= "<li class=\"list-group-item\"><strong>{$i}. </strong>" . $batter->name() . "<span class=\"badge\">" . sprintf("%.3f", $batter->avg()) . "</span>" . "</li>";
		//$rc_total += $batter->rc27();
		$simple_lineup_obp += $batter->obp();
		$simple_lineup_slg += $batter->slg();
	}

	$simple_lineup_obp /= 9;
	$simple_lineup_slg /= 9;
	$rc_total = 17.11 * $simple_lineup_obp + 11.13 * $simple_lineup_slg - 5.66;

	$simple_lineup_html .= "<li class=\"list-group-item\"><strong>Runs Created per Game:</strong><span class=\"badge\">" . sprintf("%.3f", $rc_total) . "</span></li>
";

	unset($used_players);
	$used_players = [];
	$tango_lineup = [];

	$tango_lineup[4] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[4]->id();

	$tango_lineup[1] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[1]->id();


	$tango_lineup[2] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[2]->id();


	$tango_lineup[5] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[5]->id();


	$tango_lineup[3] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[3]->id();


	$tango_lineup[6] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[6]->id();

	$tango_lineup[7] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[7]->id();

	$tango_lineup[8] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[8]->id();

	$tango_lineup[9] = BatterStats::best_remaining_woba($user->team()->players(), $used_players);
	$used_players[] = $tango_lineup[9]->id();

	
	$tango_lineup_slg = 0;
	$tango_lineup_obp = 0;


	$rc_total = 0;
	$tango_lineup_html = "";
	for ($i = 1; $i < 10; $i++) {
		$tango_lineup_html .= "<li class=\"list-group-item\"><strong>{$i}. </strong>" . $tango_lineup[$i]->name() . "<span class=\"badge\">" . sprintf("%.3f", $tango_lineup[$i]->avg()) . "</span></li>
		";
		$rc_total += $tango_lineup[$i]->rc27();
		$tango_lineup_obp += $batter->obp();
		$tango_lineup_slg += $batter->slg();

	}
	$tango_lineup_obp /= 9;
	$tango_lineup_slg /= 9;
	$rc_total = 17.11 * $tango_lineup_obp + 11.13 * $tango_lineup_slg - 5.66;


	$tango_lineup_html .= "<li class=\"list-group-item\"><strong>Runs Created per Game:</strong><span class=\"badge\">" . sprintf("%.3f", $rc_total) . "</span></li>
	";

	//So much for encapsulation...

	$whip_rotation = [];
	$used_pitchers = [];
	for ($i = 0; $i < 5; $i++) {
		$whip_rotation[] = PitcherStats::best_remaining_whip($user->team()->players(), $used_pitchers);
		$used_pitchers[] = $whip_rotation[$i]->id();
	}

	$whip_rotation_html = "";
	for ($i = 0; $i < 5; $i++) {
		$pos = $i + 1;
		$whip_rotation_html .= "<li class=\"list-group-item\"><strong>{$pos}. </strong>" . $whip_rotation[$i]->name() . "<span class=\"badge\">" . sprintf("%.3f", $whip_rotation[$i]->era()) . "</span></li>
";			
	}

	$fip_rotation = [];
	$used_pitchers = [];
	for ($i = 0; $i < 5; $i++) {
		$fip_rotation[] = PitcherStats::best_remaining_fip($user->team()->players(), $used_pitchers);
		$used_pitchers[] = $fip_rotation[$i]->id();
	}

	$fip_rotation_html = "";
	for ($i = 0; $i < 5; $i++) {
		$pos = $i + 1;
		$fip_rotation_html .= "<li class=\"list-group-item\"><strong>{$pos}. </strong>" . $fip_rotation[$i]->name() . "<span class=\"badge\">" . sprintf("%.3f", $fip_rotation[$i]->era()) . "</span></li>
";			
	}


	$template->set("simple_lineup", $simple_lineup_html);
	$template->set("tango_lineup", $tango_lineup_html);
	$template->set("whip_rotation", $whip_rotation_html);
	$template->set("fip_rotation", $fip_rotation_html);
	$template->set("team_name", $user->team()->name());
} else {
	$template->set_view("splash");
}

$template->render();
?>
