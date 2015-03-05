<?php
class TeamSettings extends Settings
{
	public $teams;

	public function __construct($user_id, $team_id)
	{
		$this->teams = [];
		parent::__construct();
		$this->_populate_teams($user_id);
	}

	private function _populate_teams($user_id)
	{
		$query = "SELECT * FROM `team` WHERE `user` = :user";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll();

		foreach ($rows as $row) {
			$team = new Team($row["id"]);
			$this->teams[] = $team;
		}
	}
}