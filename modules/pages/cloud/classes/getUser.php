<?php
/**
PinCloud - Author faridyusof727@gmail.com
*/
class getUser
{
	private $aid;
    private $fname;
    private $lname;
	private $aidc;
	private $host;
	private $name;
	private $username;
	private $password;
   	
	
	function __construct() {
		
		
    }
	
    function __destruct() {
		
    }
	
	public function qUser($user) // must run first
	{	
	
		$this->aidc = $user;
		$db = new dbcon($this->host, $this->username, $this->password, $this->name);
		$db->setStatus(0);
		$q = "SELECT * FROM accounts where aid = ".$this->aidc."";

		$r = $db->query($q);
		if ($db->num_rows($r) > 0) {
		  while ($a = $db->fetch_array_assoc($r)) {
			$this->aid = $a["aid"];  
			$this->fname = $a["afname"];  
			$this->lname = $a["alname"];  
			
		  }
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function getAid()
	{
		return $this->aid;
	}
	public function getfname()
	{
		return $this->fname;
	}
	public function getlname()
	{
		return $this->lname;
	}
	
	public function getCloudList($start, $limit)
	{
		$db = new dbcon($this->host, $this->username, $this->passwod, $this->name);
		$q = "SELECT * FROM cloud WHERE owner = ".$this->aid." LIMIT ".$start.",".$limit."";
		$data = $db->fetch_all_array($q,true);
		return $data;
	}
	public function getCloudListPic($start, $limit)
	{
		$db = new dbcon($this->host, $this->username, $this->passwod, $this->name);
		$q = "SELECT * FROM cloud WHERE owner = ".$this->aid." AND (type = \"jpg\" OR type = \"png\" OR type = \"gif\")  LIMIT ".$start.",".$limit."";
		$data = $db->fetch_all_array($q,true);
		return $data;
	}
	
	public function explode_file_dir($loc_dir) // for easy fetch in list
	{
		return explode("_", $loc_dir);
	}
	
	
	
	
	
}



?>