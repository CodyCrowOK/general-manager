<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require "/var/www/html/manager/manager.php";
		$game_id = 75;
		$args = [];
		$args[] = 1;
		$args[] = 2;
		$args[] = 3;
		$args[] = 4;
		$args[] = 5;
		$args[] = 6;
		$args[] = 7;
		$args[] = 8;
		$args[] = 9;
		$args[] = 10;
		$args[] = 11;
		$args[] = 12;
		$args[] = 13;
		$args[] = 14;
		$args[] = 15;
		$args[] = 16;


		//Game::create_game_offense($game_id, $args);
		//Game::create_game_defense($game_id, $args);

		$player = new Player(9);
		$game = new Game($game_id);
		$pitcher = new GamePitcher($player->id(), $game->id());
		echo $pitcher->h;
		$paren = " (";
				$paren_copy = $paren;
				if ($pitcher->starter) $paren .= "Starter"
				if ($pitcher->win) $paren .= ", W";
				else if ($pitcher->loss) $paren .= ", L";
				if ($pitcher->hold) $paren .= ", H";
				if ($pitcher->bs) $paren .= ", BS";
				if ($pitcher->s) $paren .= ", S";
				if ($paren == $paren_copy) $paren = "";
				else $paren .= ")";
		echo $paren;

?>