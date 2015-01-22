<?php
/*
 This represents the results of a single game for a player.
 PODS
 */
class GameBatter extends Player
{
	public $pa;
	public $h;
	public $bb;
	public $so;
	public $hbp;
	public $doubles;
	public $triples;
	public $hr;
	public $rbi;
	public $sh;
	public $sf;
	public $r;
	public $sb;
	public $cs;
	public $gdp;
	public $tob;

	public function __construct($id, $game)
	{
		parent::__construct($id);
		$query = "SELECT * FROM `batting` WHERE `player` = :id AND `game` = :game";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':game', $game, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$this->pa = $row["pa"];
		$this->h = $row["h"];
		$this->bb = $row["bb"];
		$this->so = $row["so"];
		$this->hbp = $row["hbp"];
		$this->doubles = $row["2b"];
		$this->triples = $row["3b"];
		$this->hr = $row["hr"];
		$this->rbi = $row["rbi"];
		$this->sh = $row["sh"];
		$this->sf = $row["sf"];
		$this->r = $row["r"];
		$this->sb = $row["sb"];
		$this->cs = $row["cs"];
		$this->gdp = $row["gdp"];
		$this->tob = $row["tob"];

	}

	public function pa()
	{
		return $this->pa;
	}

}
?>