<?php
class Game
{
	private $id;
	private $team;
	private $date;
	private $win; //bool
	private $oppenent;

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$this->_load_game($id);
	}

	public static function last_five($team_id)
	{
		$result = [];
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$query = "SELECT `id` FROM `game` WHERE `team` = :team ORDER BY `date` DESC LIMIT 5";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':team', $team_id, PDO::PARAM_INT);
		$stmt->execute();
		foreach ($stmt->fetchAll() as $row) {
			$game = new self($row["id"]);
			$result[] = $game;
		}
		return $result;
	}

	//Returns the new game id.
	public static function create_game($team, $date, $win, $opponent)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$query = "INSERT INTO `game` (`team`, `date`, `win`, `opponent`) VALUES (:team, :date, :win, :opponent);";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':team', $team, PDO::PARAM_INT);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':win', $win, PDO::PARAM_INT);
		$stmt->bindParam(':opponent', $opponent);
		$stmt->execute();

		$selectquery = "SELECT `id` FROM `game` ORDER BY `id` DESC";
		$select = $db->prepare($selectquery);
		$select->execute();
		return $select->fetch()[0];
	}

	public static function create_game_offense($game_id, $args)
	{
		$game = new self($game_id);
		$team_id = $game->team()->id();
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$query = "INSERT INTO `batting` (`team`, `game`, `player`, `pa`, `h`, `bb`, `so`, `hbp`, `2b`, `3b`, `hr`, `rbi`, `sh`, `sf`, `r`, `sb`, `cs`, `gdp`, `tob`) VALUES (:team, :game, :player, :pa, :h, :bb, :so, :hbp, :2b, :3b, :hr, :rbi, :sh, :sf, :r, :sb, :cs, :gdp, :tob);";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':team', $team_id, PDO::PARAM_INT);
		$stmt->bindParam(':game', $game_id, PDO::PARAM_INT);
		$stmt->bindParam(':player', $args[0], PDO::PARAM_INT);
		$stmt->bindParam(':pa', $args[1], PDO::PARAM_INT);
		$stmt->bindParam(':h', $args[2], PDO::PARAM_INT);
		$stmt->bindParam(':bb', $args[3], PDO::PARAM_INT);
		$stmt->bindParam(':so', $args[4], PDO::PARAM_INT);
		$stmt->bindParam(':hbp', $args[5], PDO::PARAM_INT);
		$stmt->bindParam(':2b', $args[6], PDO::PARAM_INT);
		$stmt->bindParam(':3b', $args[7], PDO::PARAM_INT);
		$stmt->bindParam(':hr', $args[8], PDO::PARAM_INT);
		$stmt->bindParam(':rbi', $args[9], PDO::PARAM_INT);
		$stmt->bindParam(':sh', $args[10], PDO::PARAM_INT);
		$stmt->bindParam(':sf', $args[11], PDO::PARAM_INT);
		$stmt->bindParam(':r', $args[12], PDO::PARAM_INT);
		$stmt->bindParam(':sb', $args[13], PDO::PARAM_INT);
		$stmt->bindParam(':cs', $args[14], PDO::PARAM_INT);
		$stmt->bindParam(':gdp', $args[15], PDO::PARAM_INT);
		$stmt->bindParam(':tob', $args[16], PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function create_game_defense($game_id, $args)
	{
		$game = new self($game_id);
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

	}

	public function id()
	{
		return $this->id;
	}
	
	public function team()
	{
		return $this->team;
	}
	
	public function date()
	{
		return $this->date;
	}
	
	public function win()
	{
		return $this->win;
	}

	public function result()
	{
		if ($this->win) return "Win";
		else return "Loss";
	}
	
	public function opponent()
	{
		return $this->oppenent;
	}

	private function _load_game($id)
	{
		$query = "SELECT * FROM `game` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$this->id = $row["id"];
		$this->team = new Team($row["team"]);
		$this->date = $row["date"];
		$this->win = $row["win"];
		$this->oppenent = $row["opponent"];
	}

}