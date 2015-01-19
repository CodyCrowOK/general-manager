<?php
class Session implements SessionHandlerInterface
{
	protected $db;
	
	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
	}
	
	public function open($save_path, $session_name)
	{
		if (!isset($this->db)) {
			$this->db = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true));
		}
		return true;
	}
	
	public function close()
	{
		return true;
	}
	
	public function read($session_id)
	{
		$query = "SELECT `data` FROM `session` WHERE `id` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $session_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		return (string) $row[0];
	}
	
	public function write($session_id, $data)
	{
		//$this->db->beginTransaction();
		
		//If there is already a session with the given id, we should
		//just update it. If there isn't then we can write it.
		
		$selectquery = "SELECT * FROM `session` WHERE `id` = :id";
		$selectstmt = $this->db->prepare($selectquery);
		$selectstmt->bindParam(':id', $session_id, PDO::PARAM_STR);
		$selectstmt->execute();
		
		if ($selectstmt->rowCount() === 0) {
			$ip = $this->generalized_ip();
			
			//No rows exist yet, create a new one.
			try {
				$insertquery = "INSERT INTO `session` (id, ip, data)
						VALUES (:id, :ip, :data)";
				$insertstmt = $this->db->prepare($insertquery);
				$insertstmt->bindParam(':id', $session_id, PDO::PARAM_STR);
				$insertstmt->bindParam(':ip', $ip, PDO::PARAM_STR);
				$insertstmt->bindParam(':data', $data, PDO::PARAM_STR);
				$insertstmt->execute();
			} catch (PDOException $e) {
				throw $e;
			}
		} else {
			//There's already an entry for the id, just update that.
			$ip = $this->generalized_ip();
			try {
				$updatequery = "UPDATE `session` SET `id` = :id,
						`timestamp` = now(), `ip` = :ip, `data` = :data;";
				$updatestmt = $this->db->prepare($updatequery);
				$updatestmt->bindParam(':id', $session_id, PDO::PARAM_STR);
				$updatestmt->bindParam(':ip', $ip, PDO::PARAM_STR);
				$updatestmt->bindParam(':data', $data, PDO::PARAM_STR);
				$updatestmt->execute();
			} catch (PDOException $e) {
				throw $e;
			}
		}
		return true;
	}
	
	public function destroy($session_id) {
		try {
			$query = "DELETE FROM `session` WHERE `id` = :id";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':id', $session_id, PDO::PARAM_STR);
			$stmt->execute();
		} catch (PDOException $e) {
			throw $e;
		}
		return true;
	}
	
	public function gc($maxlifetime) {
		$timecalc = time() - $maxlifetime;
		try {
			$query = "DELETE FROM `session` WHERE `timestamp` < :time";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':time', $timecalc, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
			throw $e;
		}
		return true;
	}
	
	//Private helper functions
	
	private function generalized_ip() {
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$str = $_SERVER['REMOTE_ADDR'];
			$sub = strrpos($str, ".");
			$gen_ip = substr($str, 0, $sub);
			return $gen_ip;
		} else {
			return "127.0.0";
		}
	}
}
?>