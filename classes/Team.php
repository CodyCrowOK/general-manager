<?php
class Team implements JsonSerializable
{
	private $id;
	private $user;
	private $name;
	private $db;

	//Array of players on a team.
	public $players = [];

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$this->_load_team($id);
		//$this->_load_players();
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'name' => $this->name
		];
	}

	public static function add_team($name, $user_id)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$query = "INSERT INTO `team` (`user`, `name`) VALUES (:user, :name);";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':name', $name);
		$stmt->execute();

	}

	private function _load_team($id)
	{
		$query = "SELECT * FROM `team` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->id = $id;
		$this->user = new User($row["user"]);
		$this->name = $row["name"];
	}

	private function _load_players()
	{
		$query = "SELECT * FROM `player` WHERE `team` = :team";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':team', $this->id(), PDO::PARAM_INT);
		$stmt->execute();
		foreach ($stmt->fetchAll() as $row) {
			$player = new Player($row["id"]);
			$this->players[] = $player;
		}
	}

	public function pythagorean_expectation()
	{
		$earned_runs = 0;
		//This should allow us to approximate runs allowed from ER
		$runs_allowed_coefficient = exp(.087);
		$query = "SELECT `er` FROM `pitching` WHERE `team` = :team";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':team', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach ($result as $row) {
			$earned_runs += $row["er"];
		}

		$runs_allowed = $earned_runs * $runs_allowed_coefficient;

		$runs_scored = 0;
		$query_batting = "SELECT `r` FROM `batting` WHERE `team` = :team";
		$stmt_batting = $this->db->prepare($query_batting);
		$stmt_batting->bindParam(':team', $this->id, PDO::PARAM_INT);
		$stmt_batting->execute();
		$rows = $stmt_batting->fetchAll();
		foreach ($rows as $row) {
			$runs_scored += $row["r"];
		}

		$pythag = pow($runs_scored, 1.83) / (pow($runs_scored, 1.83) + pow($runs_allowed, 1.83));

		return $pythag;
	}

	public function id()
	{
		return $this->id;
	}

	public function name()
	{
		return $this->name;
	}

	public function players()
	{
		$this->_load_players();
		return $this->players;
	}

	public function user()
	{
		return $this->user;
	}
}
