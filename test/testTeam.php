<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require "/var/www/html/manager/manager.php";
		$game_id = 7;
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

		$game = new Game($game_id);
		$team_id = $game->team()->id();
		$_ip = floatval($args[4]);
		if (fmod($_ip, 1.0) > .2) {
			$innings_pitched = floor($_ip);
		} else {
			$innings_pitched = $_ip;
		}

		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$query = "INSERT INTO `pitching` (`team`, `game`, `player`, `start`, `win`, `loss`, `ip`, `h`, `bb`, `hbp`, `er`, `k`, `hold`, `s`, `bs`, `bf`) VALUES (:team, :game, :player, :start, :win, :loss, :ip, :h, :bb, :hbp, :er, :k, :hold, :s, :bs, :bf);";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':team', $team_id, PDO::PARAM_INT);
		$stmt->bindParam(':game', $game_id, PDO::PARAM_INT);
		$stmt->bindParam(':player', $args[0], PDO::PARAM_INT);
		$stmt->bindParam(':start', $args[1], PDO::PARAM_INT);
		$stmt->bindParam(':win', $args[2], PDO::PARAM_INT);
		$stmt->bindParam(':loss', $args[3], PDO::PARAM_INT);
		$stmt->bindParam(':ip', $innings_pitched);
		$stmt->bindParam(':h', $args[5], PDO::PARAM_INT);
		$stmt->bindParam(':bb', $args[6], PDO::PARAM_INT);
		$stmt->bindParam(':hbp', $args[7], PDO::PARAM_INT);
		$stmt->bindParam(':er', $args[8], PDO::PARAM_INT);
		$stmt->bindParam(':k', $args[9], PDO::PARAM_INT);
		$stmt->bindParam(':hold', $args[10], PDO::PARAM_INT);
		$stmt->bindParam(':s', $args[11], PDO::PARAM_INT);
		$stmt->bindParam(':bs', $args[12], PDO::PARAM_INT);
		$stmt->bindParam(':bf', $args[13], PDO::PARAM_INT);
		$stmt->execute();

?>