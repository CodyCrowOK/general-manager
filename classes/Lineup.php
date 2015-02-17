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

	public static function save_lineup($id, $name, $order, $user_id, $team_id)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));

		if (!is_numeric($id)) return http_response_code(400);
		//First, make sure the user is authorized for this.
	
		file_put_contents("log2.txt", var_export($id, true) . "\n", FILE_APPEND);
		
		if ($id > 0) {
			$authq = "SELECT `user` FROM `workspace_lineup` WHERE `id` = :id";
			$authstmt = $db->prepare($authq);
			$authstmt->bindParam(':id', $id, PDO::PARAM_INT);
			$authstmt->execute();
			$row = $authstmt->fetch();
			if ($row["user"] != $user_id) return http_response_code(401);

			$query = "UPDATE `workspace_lineup` SET `name` = :name, `json` = :json WHERE `id` = :id";
			$json_order = json_encode($order);
			$stmt = $db->prepare($query);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':json', $json_order);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		} else {
			$query = "INSERT INTO `workspace_lineup` (`name`, `user`, `team`, `json`) VALUES (:name, :user, :team, :json)";
			$json_order = json_encode($order);
			$stmt = $db->prepare($query);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':team', $team_id, PDO::PARAM_INT);
			$stmt->bindParam(':json', $json_order);
			$stmt->execute();
		}

	}
}
?>
