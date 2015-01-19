<?php
/*
Class Template from grapefruit. Simple template engine.
*/
class Template 
{
	private $view;
	private $values = [];
	
	public function render() 
	{
		try {
			if (!file_exists(SITE . "view/" . $this->view() . ".php")) 
				throw new Exception("View file doesn't exist.");
			$out = file_get_contents(SITE . "view/" . $this->view() . ".php");
			foreach ($this->values as $key => $value) {
				$replace = "[@$key]";
				$out = str_replace($replace, $value, $out);
			}
			echo $out;
		} catch (Exception $e) {
			throw $e;
		}
		
	}
	
	public function __construct() {	}
	
	public function set($key, $value)
	{
		$this->values[$key] = $value;
	}
	
	public function set_sanitize($key, $value)
	{
		$this->values[$key] = Site::sanitize($value);
	}
	
	public function set_view_from_url() 
	{
		$this->view = basename(__FILE__);
	}
	
	public function view() 
	{
		return $this->view;
	}
	
	public function set_view($name) 
	{
		$this->view = $name;
	}
}

?>
