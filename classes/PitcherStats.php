<?php
class PitcherStats extends Player
{
	public $starts;
	public $w;
	public $l;
	public $ip;
	public $h;
	public $bb;
	public $hbp;
	public $er;
	public $k;
	public $holds;
	public $s;
	public $bs;
	public $bf;
	public $hr;

	private $g;
	private $qs;
	private $innings;

	public function __construct($id, $innings)
	{
		parent::__construct($id);
		$this->starts = $this->w = $this->l = $this->ip = $this->h = $this->bb = $this->bb = $this->hbp = $this->er = $this->k = $this->holds = $this->s = $this->bs = $this->bf = $this->hr = 0;
		$this->_populate($id);
		$this->innings = $innings;
	}

	public static function best_remaining_whip($players, $used)
	{
		$id = 0;
		$high = INF;
		//We don't want to count the player if they've been used already.
		foreach ($players as $player) {
			if (in_array($player->id(), $used) || !$player->is_pitcher) continue;
			$stats = new self($player->id());
			if ($stats->whip() < $high) {
				$high = $stats->whip();
				$id = $stats->id();
			}
		}

		return new self($id);
	}

	public static function best_remaining_fip($players, $used)
	{
		$id = 0;
		$high = INF;
		//We don't want to count the player if they've been used already.
		foreach ($players as $player) {
			if (in_array($player->id(), $used) || !$player->is_pitcher) continue;
			$stats = new self($player->id());
			if ($stats->fip() < $high) {
				$high = $stats->fip();
				$id = $stats->id();
			}
		}

		return new self($id);
	}


	private function _populate($id)
	{
		$query = "SELECT * FROM `pitching` WHERE `player` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		foreach ($stmt->fetchAll() as $row) {
			$this->g++;
			if ($row["start"]) $this->starts++;
			if ($row["win"]) $this->w++;
			if ($row["loss"]) $this->l++;

			//Handle IP
			$current_remainder = fmod($this->ip, 1.0);
			$current_whole = $this->ip - $current_remainder;
			$new_remainder = fmod($row["ip"], 1.0);
			$new_whole = $row["ip"] - $new_remainder;
			$total_whole  = $current_whole + $new_whole;
			$extra_whole = (int) (($new_remainder + $current_remainder) / .3);
			$extra_remainder = fmod(($new_remainder + $current_remainder), .3);
			$this->ip = $total_whole + $extra_whole + $extra_remainder;

			$this->h += $row["h"];
			$this->bb += $row["bb"];
			$this->hbp += $row["hbp"];
			$this->er += $row["er"];
			$this->k += $row["k"];
			if ($row["hold"]) $this->holds++;
			if ($row["s"]) $this->s++;
			if ($row["bs"]) $this->bs++;
			$this->bf += $row["bf"];
			$this->hr += $row["hr"];

			if ($row["start"] && $row["ip"] >= floor((6 / 9) * $this->innings) && $row["er"] <= 3) $this->qs++;
		}
	}

	public function g()
	{
		return $this->g;
	}

	public function era()
	{
		return ($this->er / $this->ip) * $this->innings;
	}

	public function whip()
	{
		return ($this->bb + $this->h) / $this->ip;
	}

	public function h9()
	{
		return ($this->h / $this->ip) * $this->innings;
	}

	public function k9()
	{
		return ($this->k / $this->ip) * $this->innings;
	}

	public function bb9()
	{
		return ($this->bb / $this->ip) * $this->innings;
	}

	public function k_per_bb()
	{
		return $this->k / $this->bb;
	}

	public function fip()
	{
		return (((13 * $this->hr) + (3 * ($this->bb + $this->hbp)) - (2 * $this->k)) / $this->ip) + 3.1;
	}

	public function qs()
	{
		return $this->qs;
	}

	public function lob()
	{
		return ($this->h + $this->bb + $this->hbp - $this->er) / ($this->h + $this->bb + $this->hbp - (1.4 * $this->hr));
	}

	public function oba()
	{
		return $this->h / ($this->bf - $this->bb - $this->hbp - $this->sh - $this->sf);
	}




}
