<?php
class BatterStats extends Player
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

	private $ab;
	private $tb;
	private $g;



	public function __construct($id)
	{
		parent::__construct($id);
		$this->pa = $this->g = $this->h = $this->bb = $this->so = $this->hbp = $this->doubles = $this->triples = $this->hr = $this->rbi = $this->sh = $this->sf = $this->r = $this->sb = $this->sb = $this->cs = $this->gdp = $this->tob = 0;
		$this->_populate($id);
	}

	public static function highest_ops($players)
	{
		$high = $id = 0;
		foreach ($players as $player) {
			$stats = new self($player->id());
			if ($stats->ops() > $high) {
				$high = $stats->ops();
				$id = $stats->id();
			}
		}

		return new self($id);
	}

	public static function best_remaining_slg($players, $used)
	{
		$high = $id = 0;
		//We don't want to count the player if they've been used already.
		foreach ($players as $player) {
			if (in_array($player->id(), $used)) continue;
			$stats = new self($player->id());
			if ($stats->slg() > $high) {
				$high = $stats->slg();
				$id = $stats->id();
			}
		}

		return new self($id);
	}

	public static function best_remaining_obp($players, $used)
	{
		$high = $id = 0;
		//We don't want to count the player if they've been used already.
		foreach ($players as $player) {
			if (in_array($player->id(), $used)) continue;
			$stats = new self($player->id());
			if ($stats->obp() > $high) {
				$high = $stats->obp();
				$id = $stats->id();
			}
		}

		return new self($id);
	}

	public static function best_remaining_woba($players, $used)
	{
		$high = $id = 0;
		//We don't want to count the player if they've been used already.
		foreach ($players as $player) {
			if (in_array($player->id(), $used)) continue;
			$stats = new self($player->id());
			if ($stats->woba() > $high) {
				$high = $stats->woba();
				$id = $stats->id();
			}
		}

		return new self($id);
	}


	private function _populate($id)
	{
		$query = "SELECT * FROM `batting` WHERE `player` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		foreach ($stmt->fetchAll() as $row) {
			$this->pa += $row["pa"];
			$this->h += $row["h"];
			$this->bb += $row["bb"];
			$this->so += $row["so"];
			$this->hbp += $row["hbp"];
			$this->doubles += $row["2b"];
			$this->triples += $row["3b"];
			$this->hr += $row["hr"];
			$this->rbi += $row["rbi"];
			$this->sh += $row["sh"];
			$this->sf += $row["sf"];
			$this->r += $row["r"];
			$this->sb += $row["sb"];
			$this->cs += $row["cs"];
			$this->gdp += $row["gdp"];
			$this->tob += $row["tob"];
			$this->g += 1;
		}
		
		$this->ab = $this->pa - ($this->bb + $this->hbp + $this->sf + $this->sh);
		$this->tb = ($this->h - ($this->doubles + $this->triples + $this->hr)) + (2 * ($this->doubles) + (3 * ($this->triples)) + (4 * ($this->hr)));

	}

	public function singles()
	{
		return $this->h - ($this->doubles + $this->triples + $this->hr);
	}

	public function tb()
	{
		return $this->tb;
	}

	public function g()
	{
		return $this->g;
	}

	public function avg()
	{
		return $this->h / $this->ab;
	}

	public function ab() 
	{
		return $this->ab;
	}

	public function obp()
	{
		return $this->tob / $this->pa;
	}

	public function slg()
	{
		return $this->tb / $this->ab;
	}

	public function ops()
	{
		return $this->obp() + $this->slg();
	}

	public function rc()
	{
		$rca = $this->h + $this->bb - $this->cs + $this->hbp - $this->gdp;
		$rcb = (1.125 * ($this->h - ($this->doubles + $this->triples + $this->hr))) + (1.69 * $this->doubles) + (3.02 * $this->triples) + (3.73 * $this->hr) + (.29 * ($this->bb + $this->hbp)) + (.492 * (($this->sh + $this->sf) + $this->sb)) - (.04 * $this->so);
		$rcc = $this->ab() + $this->bb + $this->hbp + $this->sf + $this->sh;
		$rc = (((2.4 * $rcc + $rca) * (3 * $rcc + $rcb)) / (9 * $rcc)) - (.9 * $rcc);
		return $rc;
	}

	//This is actually RC/G. Oops.
	public function rc27()
	{
		return $this->rc() / $this->g();
	}

	public function base_runs()
	{
		$a = $this->h + $this->bb + $this->hbp - $this->hr;
		$b = ((1.4 * $this->tb()) - (.6 * $this->h) - (3 * $this->hr) + (.1 * ($this->bb + $this->hbp)) + (.9 * ($this->sb - $this->cs - $this->gdp))) * 1.1;
		$c = $this->ab() - $this->h;
		$d = $this->hr;
		return (($a * $b) / ($b + c)) + $d;
	}

	public function isolated_power()
	{
		return $this->slg() - $this->avg();
	}

	public function secondary_average()
	{
		return ($this->bb + ($this->tb() - $this->h) + ($this->sb - $this->cs)) / $this->ab();
	}

	public function bb_per_k()
	{
		return $this->bb / $this->so;
	}

	public function reached_base_on_error()
	{
		return $this->tob - ($this->h + $this->hbp + $this->bb);
	}

	public function woba()
	{
		return (.72 * $this->bb + .75 * $this->hbp + .9 * $this->singles() + .92 * $this->reached_base_on_error() + 1.24 * $this->doubles + 1.56 * $this->triples + 1.95 * $this->hr) / $this->pa;
	}

}
