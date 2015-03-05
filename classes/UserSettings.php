<?php
class UserSettings extends Settings
{

	public $name;
	public $email;
	public $password;


	public function __construct($id)
	{
		parent::__construct();
		$this->_populate($id);
	}

	private function _populate($id)
	{
		$query = "SELECT * FROM `user` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$this->name = $row["name"];
		$this->email = $row["email"];
		$this->password = "";
	}

	public static function switch_team($user_id, $team_id)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		//Make sure the team belongs to the user.
		$check_query = "SELECT * FROM `team` WHERE `user` = :user";
		$check_stmt = $db->prepare($check_query);
		$check_stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
		$check_stmt->execute();
		if (!$check_stmt->rowCount()) return;

		$query = "UPDATE `user` SET `active_team` = :team WHERE `id` = :user";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':team', $team_id, PDO::PARAM_INT);
		$stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function update_name($user_id, $value)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));

		$query = "UPDATE `user` SET `name` = :name WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':name', $value);
		$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function update_email($user_id, $value)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));

		$query = "UPDATE `user` SET `email` = :email WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':email', $value);
		$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function update_password($user_id, $value)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));

		$query = "UPDATE `user` SET `password` = :password WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$hash = password_hash($value, PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $hash);
		$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}




}