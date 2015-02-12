<?php
class Lineup {
	public $id;
	public $name;
	private $user_id;
	public $order; //Array of player IDs

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$this->_populate($id);
	}

	private function _populate($id)
	{
		$this->id = $id;
		$query = "SELECT * FROM `workspace_lineup` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$this->name = $row["name"];
		$this->user_id = $row["user"];
		//$this->order = json_decode($row["json"], true);
		foreach (json_decode($row["json"], true) as $id) {
			$this->order[] = new Player($id);
		}
	}
}
?>
