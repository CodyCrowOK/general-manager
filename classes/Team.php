<?php
class Team
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

	public function id()
	{
		return $this->id;
	}

	public function players()
	{
		$this->_load_players();
		return $this->players;
	}
}