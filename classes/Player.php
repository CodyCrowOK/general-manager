<?php
class Player
{
	private $id;
	public $team;
	public $name;
	public $number;
	public $is_pitcher;
	private $db;

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$this->_load_player($id);
	}

	private function _load_player($id)
	{
		$query = "SELECT * FROM `player` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->id = $id;
		$this->team = new Team($row["team"]);
		$this->name = $row["name"];
		$this->number = $row["number"];
		$this->is_pitcher = $row["is_pitcher"];
	}

	public function id()
	{
		return $this->id;
	}

	public function team()
	{
		return $this->team;
	}
	
	public function name()
	{
		return $this->name;
	}
	
	public function number()
	{
		return $this->number;
	}
	
	public function is_pitcher()
	{
		return $this->is_pitcher;
	}

}