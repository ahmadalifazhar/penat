<?php
class pagination
{
	private $userid;
	private $total_pages;
	//private $target_page;
	private $start;
	private $limit = 10;
	private $page;
	//private $adjacents = 3;
	
	function __construct($userid = "", $where = "") {
		if (!empty($userid))
		{
			$this->userid = $userid;
			$this->process($where);
		}
		else die();
		
    }
	
    function __destruct() {
        @mysql_close($this->link);
    }
	
	
	public function process($x)
	{
		$dbx = new dbcon("localhost","root","", "blur");
		$dbx->setStatus(0);				
		$q = "SELECT COUNT(*) as num FROM cloud WHERE owner = '".$this->userid."' ".$x."  ";
		$r = $dbx->query($q);
		$pages = $dbx->fetch_array($r);
		$this->total_pages = $pages[num];
		
		
	}
	public function page($page = "") //must set
	{
		if (!empty($page)) $this -> page = $page;       
		if ((!empty($this->page)))
		{
			$this->start = ($this->page - 1) * $this->limit;
		}
		else
		{
			$this->start = 0;
		}
	}
	
	public function getStart()
	{
		return $this->start;
	}
	public function getLimit()
	{
		return $this->limit;
	}
	public function getPage()
	{
		return $this->page;
	}
	public function totalPage()
	{
		return $this->total_pages;
	}
	
	
}

	
		
		
	?>
