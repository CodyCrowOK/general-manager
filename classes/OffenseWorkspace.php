<?php
class OffenseWorkspace 
{
	public $lineups; //Array of Lineup

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$this->_populate($id);
	}

	private function _populate($id)
	{
		$this->lineups = [];
		$query = "SELECT `id` FROM `workspace_lineup` WHERE `team` = :team";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':team', $id, PDO::PARAM_INT);
		$stmt->execute();
		foreach ($stmt->fetchAll() as $row) {
			$this->lineups[] = new Lineup($row["id"]);
		}
	}

	public function get_json_representation()
	{
		return json_encode($this->lineups);	
	}
}
?>
