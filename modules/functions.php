<?php
//
// fully originally written by Marhazli / marhazk ... marhazk@yahoo.com
//
class PinIt
	{
		public $_errmsg = "";
		public $_msg = "";
		public $_oplink = "";
		public $_array = NULL;
		
		function errmsg($val)
		{
			$this->_errmsg = $val;
		}
		function msg($val)
		{
			$this->_msg = $val;
		}
		function oplink($val)
		{
			$this->_oplink = $val;
		}
		function page($link)
		{
			$link = strtolower($link);
			if (strtolower($this->op) == $link)
				return true;
			else
				return false;
		}
		function chk($val, $lenmin = 4, $lenmax = 10, $regrex = true)
		{
			// chk("TEST")
			// chk("TEST", 4)
			// chk("TEST", 4, 10)
			// chk("TEST", 4, 10, true)
			if (($lenmax >= 1) && ((strlen($val) < $lenmin) || (strlen($val) > $lenmax)))
				return false;
			else if (($regrex) && (!(preg_replace("((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})", $val))))
				return false;
			else
				return true;
		}
		function setarray($array)
		{
			$this->_array = $array;
		}
		function inpost()
		{
			$temp = "";
			if (is_array($this->_array))
			{
				$array = $this->_array;
				foreach ($array as $key => $val)
				{
					$temp .= '<input type=hidden name="'.$key.'" value="'.$val.'">'.chr(10).chr(13);
				}
			}
			return $temp;
		}
		function loadpage($file, $file2 = "index", $replacestr = NULL)
		{
			
			
			if ($file2 == "index")
				$name = $file;
			else
				$name = "./".$file."/".$file2;
			$page = file_get_contents($name);
			$file = str_replace("/index.html", "", $file);
			$file = str_replace("/index.php", "", $file);
			$file = str_replace("/".$file2, "", $file);
			
			$inpost = $this->inpost();
			$page = str_replace("_ERROR_", $inpost."_ERROR_", $page);
			$page = str_replace("_ERROR_", $this->_errmsg, $page);
			$page = str_replace("_MSG_", $this->_msg, $page);
			$page = str_replace("_OPLINK_", $this->_oplink, $page);
			//echo "hantu kaw";
			$page = str_replace("href=\"SpryAssets", "href=\"".$file."/SpryAssets", $page);
			$page = str_replace("src=\"SpryAssets", "src=\"".$file."/SpryAssets", $page);
			$page = str_replace("href=\"stylesheet", "href=\"".$file."/stylesheet", $page);
			$page = str_replace("src=\"images", "src=\"".$file."/images", $page);
			$page = str_replace("src=\"css", "src=\"".$file."/css", $page);
			$page = str_replace("href=\"css", "href=\"".$file."/css", $page);
			$page = str_replace("src=\"js", "src=\"".$file."/js", $page);
			$page = str_replace("value=\"images", "value=\"".$file."/images", $page);
			$page = str_replace("value=\"swf", "value=\"".$file."/swf", $page);
			$page = str_replace("src=\"swf", "src=\"".$file."/swf", $page);
			
			if (is_array($replacestr))
			{
				foreach ($replacestr as $rkey => $rval)
				{
					$page = str_replace("__".strtoupper($rkey)."__", $rval, $page);
					$page = str_replace("_".strtoupper($rkey)."_", $rval, $page);
				}
			}
			if (strlen($this->_msg) >= 10)
				$page .= "<script>alert('".$this->_msg."');</script>";
			if (strlen($this->_errmsg) >= 10)
				$page .= "<script>alert('".$this->_errmsg."');</script>";
			echo $page;
		}
	}
	// Example how:
	// Coded by Marhazli bin Kipli
	// 
	// $data = getdata("TblName", ARRAY ("attr(array)", "value(array)"));
	// $data[0] =  
	//
	function gendata($table, $array, $option = NULL)
	{ 
		$sql = "";
		$value = "";
		if (!is_array($option))
		{
			switch ($option)
			{
				case NULL:
				case '':
				case 'SELECT':
				case 'AND':
				case 'OR':
				case '&&':
				case '||':
				{
					if (is_array($array))
					{
						$sql = " WHERE ";
						foreach ($array as $key => $val)
						{
							if (strtoupper($option) == "OR")
								$value .= "$key='$val' OR  ";
							else
								$value .= "$key='$val' AND ";
						}
						$value = substr($value, 0, (strlen($value)-5));
					}
					else
					{
						$sql = "";
						$value = "";
					}
					$sql = "SELECT * FROM ".$table."".$sql."".$value;
					break;
				}
				default:
				{
					foreach ($array as $key => $val)
					{
						if (is_array($val))
						{
							$sql .= "$key, ";
							$_val = $val[0];
							$_valval = $val[1];
							$value .= $_val."(".$_valval."), ";
						}
						else
						{
							$sql .= "$key, ";
							$value .= "'$val', ";
						}
					}
					$value = substr($value, 0, (strlen($value)-2));
					$sql = substr($sql, 0, (strlen($sql)-2));
					$sql = "INSERT INTO ".$table." (".$sql.") VALUES (".$value.");"; 
					break;
				}
			}
		}
		else
		{
			foreach ($array as $key => $val)
			{
				if (is_array($val))
				{
					$_val = $val[0];
					$_valval = $val[1];
					$sql .= "$key=".$_val."(".$_valval."), ";
				}
				else
					$sql .= "$key='$val', ";
			}
			$sql = substr($sql, 0, (strlen($sql)-2));
			if (is_array($option))
			{
				$_opt = "";
				foreach ($option as $key => $val)
				{
					$_opt .= $key."='".$val."' AND ";
				}
				$_opt = substr($_opt, 0, (strlen($_opt)-5));
				$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$_opt.";"; 
			}
			else
				$sql = "UPDATE ".$table." SET ".$sql.";"; 
		}
		return $sql;
	}
	function msg($type = "ERROR", $text)
	{
		if ($type == "ERROR")
			$errormsg = "<p><font color=red>ERROR: ".$text."</font></p>";
		else if ($type == "NOTIS")
			$errormsg =  "<p><font color=green>NOTIS: ".$text."</font></p>";
		else
			$errormsg =  "<p><font color=green>".$text."</font></p>";
		echo "<script>alert('".$text."');</script>";
	}
	function gendate($time)
	{
		return date('Y-m-d G:i:s', $time);
	}
	function get_menu($x = NULL)
	{
		$account = $x;
		include "modules/pages/menu.php";
	}
	
	function ob_replace($var, $array)
	{
		if (is_array($array))
		{
			foreach ($array as $rkey => $rval)
			{
				$var = str_replace("__".strtoupper($rkey)."__", $rval, $var);
				$var = str_replace("_".strtoupper($rkey)."_", $rval, $var);
			}
		}
		return $var;
	}
	function ob_file($file, $array)
	{
		ob_start();
		include $file;
		$_file = ob_get_clean();
		return ob_replace($_file, $array);
	}
	
	function pintime($row)
	{
		$time = $row[pdate2];
		if (empty($time))
			$time = strtotime($row[pdate]);
		$_time = time()-$time;
		if ($_time < 60)
			$_time = $_time." secs ago";
		else
		{
			$_time = $_time/60;
			if ($_time < 60)
				$_time = round($_time)." minutes ago";
			else
			{
				$_time = $_time/24;
				if ($_time < 24)
					$_time = round($_time)." hours ago";
				else
				{
					$_time = $_time/31;
					if ($_time < 31)
						$_time = round($_time)." days ago";
					else
					{
						$_time = $_time/12;
						if ($_time < 12)
							$_time = round($_time)." months ago";
						else
							$_time = round($_time)." years ago";
					}
				}
			}
		}
		return $_time;
	}

	function pinname($name)
	{
		$value = explode(" ",$name);
		$name = "";
		foreach ($value as $val)
		{
			$name .= strtoupper(substr($val,0,1)) .  strtolower(substr($val,1,strlen($val))) . " ";
		}
		return trim($name);
	}
	function pinacc($row)
	{
		if (file_exists("./images/uploaded_images/resized/".$row[apic].".jpg"))
			$row[arealpic] = "./images/uploaded_images/resized/".$row[apic].".jpg";
		else
			$row[arealpic] = "./images/nopic.jpg";
		$row[isonline]	= isonline($row);
		$row[apic]		= $row[arealpic];
		$row[afname]	= pinname($row[afname]);
		$row[alname]	= pinname($row[alname]);
		return $row;
	}
	function isonline($row, $online = 1, $offline = 0)
	{
		$chk = time()-$row[alastlogupdate];
		if ($chk >= 0)
		{
			if ($chk <= 400)
			{
				return $online;
			}
			else
			{
				return $offline;
			}
			
		}
		else
		{
			return $offline;
		}
	}
?>