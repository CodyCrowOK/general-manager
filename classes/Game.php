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