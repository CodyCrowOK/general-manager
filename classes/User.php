<?php
class User
{
	private $id;
	private $name;
	private $email;
	//Not necessarily the only team, just the user's current active one:
	private $team_id;
	public $team;
	private $db;
	public $settings;

	public function __construct($id)
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		$row = $this->_fetch_user_row($id);
		$this->id = $row["id"];
		$this->name = $row["name"];
		$this->email = $row["email"];
		$this->team_id = $row["active_team"];
		$this->settings = new UserSettings($id);
	}

	public static function create_user($name, $email, $password, $teamname)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		//Ensure the email is return unique
		$estmt = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
		$estmt->bindValue(1, $email, PDO::PARAM_STR);
		$estmt->execute();
		if ($estmt->rowCount() != 0) return "Email address already in use.";


		// Do all the fun password stuff...which isn't much.
		$hash = password_hash($password, PASSWORD_BCRYPT);

		$query = "INSERT INTO `user` (`name`, `email`, `password`)
						VALUES (:name, :email, :password);";
		$stmt = $db->prepare($query);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':password', $hash, PDO::PARAM_STR);
		$stmt->execute();

		$user_query = "SELECT * FROM `user` WHERE `email` = :email";
		$user_stmt = $db->prepare($user_query);
		$user_stmt->bindParam(':email', $email);
		$user_stmt->execute();
		$user_row = $user_stmt->fetch();
		$user_id = $user_row["id"];

		$team_query = "INSERT INTO `team` (`name`, `user`) VALUES (:name, :user);";
		$team_stmt = $db->prepare($team_query);
		$team_stmt->bindParam(':name', $teamname);
		$team_stmt->bindParam(':user', $user_id);
		$team_stmt->execute();

		$team_id_query = "SELECT * FROM `team` WHERE `user` = :user";
		$team_id_stmt = $db->prepare($team_id_query);
		$team_id_stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
		$team_id_stmt->execute();
		$team_id_row = $team_id_stmt->fetch();
		$team_id = $team_id_row["id"];

		UserSettings::switch_team($user_id, $team_id);
	}

	public static function log_in($email, $password)
	{
		$db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		if ($_SESSION["is_logged"]) session_destroy();

		$query = "SELECT * FROM `user` WHERE `email` = :email";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		if ($stmt->rowCount() === 0) return false;
		$row = $stmt->fetch();

		if (password_verify($password, $row["password"])) {
			$_SESSION["uid"] = $row["id"];
			$_SESSION["is_logged"] = true;
			return true;
		} else {
			return false;
		}
	}

	private function _fetch_user_row($id)
	{
		$query = "SELECT * FROM `user` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function team()
	{
		$team = new Team($this->team_id);
		return $team;
	}

	public function id()
	{
		trigger_error("User::id(): Do not use this function. Do not use this function. Don't do it. You don't want to. Really. Using it means you are almost certainly structuring the code incorrectly. Use caution", E_USER_WARNING);
		return $this->id;
	}
}
?>
