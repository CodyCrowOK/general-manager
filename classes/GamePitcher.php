<?php
class GamePitcher extends Player
{
	//booleans
	public $start;
	public $win;
	public $loss;
	
	public $ip;
	public $h;
	public $bb;
	public $hbp;
	public $er;
	public $k;
	public $hold;
	public $s;
	public $bs;
	public $bf;
	public $hr;


	public function __construct($id, $game)
	{
		parent::__construct($id);
		$query = "SELECT * FROM `pitching` LEFT JOIN `player` ON `player`.`id` = `pitching`.`player` WHERE `id` = :player AND `game` = :game";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':player', $id, PDO::PARAM_INT);
		$stmt->bindParam(':game', $game, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->start = $row["start"];
		$this->win = $row["win"];
		$this->loss = $row["loss"];
		$this->ip = $row["ip"];
		$this->h = $row["h"];
		$this->bb = $row["bb"];
		$this->hbp = $row["hbp"];
		$this->er = $row["er"];
		$this->k = $row["k"];
		$this->hold = $row["hold"];
		$this->s = $row["s"];
		$this->bs = $row["bs"];
		$this->bf = $row["bf"];
		$this->hr = $row["hr"];
	}	
}