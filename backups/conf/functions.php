<?php
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
			
			$page = str_replace("href=\"SpryAssets", "href=\"".$file."/SpryAssets", $page);
			$page = str_replace("src=\"SpryAssets", "src=\"".$file."/SpryAssets", $page);
			$page = str_replace("href=\"stylesheet", "href=\"".$file."/stylesheet", $page);
			$page = str_replace("src=\"images", "src=\"".$file."/images", $page);
			$page2 = str_get_html($page); 
			$f = $page2->find("head",0);
			$f->innertext = $f->innertext. "<link href=\"/MetroCss/"."css/modern.css\" rel=\"stylesheet\">"
." <link href=\"/MetroCss/"."boilerplate.css\" rel=\"stylesheet\">"
." <link href=\"/MetroCss/"."fluid.css\" rel=\"stylesheet\">"
." <link href=\"/MetroCss/"."css/modern-responsive.css\" rel=\"stylesheet\">"
." <link href=\"/MetroCss/"."css/site.css\" rel=\"stylesheet\" type=\"text/css\">"
." <link href=\"/MetroCss/"."js/google-code-prettify/prettify.css\" rel=\"stylesheet\" type=\"text/css\">"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/assets/jquery-1.9.0.min.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/assets/jquery.mousewheel.min.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/dropdown.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/accordion.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/buttonset.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/carousel.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/input-control.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/pagecontrol.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/rating.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/slider.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/tile-slider.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/tile-drag.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."js/modern/calendar.js\"></script>"
." <script type=\"text/javascript\" src=\"/MetroCss/"."respond.min.js\"></script>"
."<link rel=\"shortcut icon\" type=\"image/png\" href=\"favicon.png\" />";

			if (is_array($replacestr))
			{
				foreach ($replacestr as $rkey => $rval)
				{
					$page2 = str_replace("_".strtoupper($rkey)."_", $rval, $page2);
				}
			}
			echo $page2;
		}
               
	}
	function encodetmp($array)
	{
		$temp = "";
		foreach ($array as $key=>$val)
		{
			$temp .= $key.";;;";
		}
		foreach ($array as $key=>$val)
		{
			$temp .= $val.";;;";
		}
		$temp = base64_encode($temp);
		return $temp;
	}
	function decodetmp($val)
	{
		$val = base64_decode($val);
		$array = explode(";;;", $val);
		$total = count($array)-1;
		$mid = $total/2;
		$num = 0;
		while ($num < $mid)
		{
			$attr[$num] = $array[$num]; 
			$num++;
		}
		$numattr = 0;
		while ($num < $total)
		{
			$newarray[$attr[$numattr]] = $array[$num]; 
			$num++;
			$numattr++;
		}
		return $newarray;
	}
	function gentemp($array)
	{
		$temp = encodetmp($array);
		//$sql = "INSERT into temp (rid, rauth, rvalue) VALUES (?, ?, ?);";
		$sql = "INSERT into temp (rid, rauth, rvalue) VALUES ('".time()."', '".md5(time())."', '".$temp."');";
		return array($sql, array(time(), md5(time()), $temp));
	}
	function querydata($gdata)
	{
		return sql($gdata);
	}
	function query($table, $array, $update = NULL)
	{
		return querydata(gdata($table, $array, $update));
	}
	function gendata($table, $array, $update = NULL, $update2 = NULL)
	{
		$sql = "";
		$value = "";
		if (!is_array($update))
		{
			foreach ($array as $val)
			{
				if ($update == NULL)
					$value .= "?, ";
				else
					$value .= "'$val', ";
			}
			$value = substr($value, 0, (strlen($value)-2));
			foreach ($array as $key => $val)
			{
				$sql .= "$key, ";
			}
			$sql = substr($sql, 0, (strlen($sql)-2));
			$sql = "INSERT INTO ".$table." (".$sql.") VALUES (".$value.");"; 
		}
		else
		{
			foreach ($array as $key => $val)
			{
				if ($update2 == NULL)
					$sql .= "$key='$val', ";
				else
					$sql .= "$key=?, ";
			}
			$sql = substr($sql, 0, (strlen($sql)-1));
			$sql = "UPDATE ".$table." SET ".$sql." WHERE '".$update[0]."'='".$update[1]."';"; 
		}
		if (!is_array($update))
		{
			if ($update == NULL)
				return array($sql, $array);
			else
				return $sql;
		}
		else
		{
			if ($update2 == NULL)
				return array($sql, $array);
			else
				return $sql;
		}
	}

	function sql($data)
	{ 
		mysql_query($Link, $data[0], $data[1]);
	}
	function data($table, $arrattr, $arrval, $update = NULL)
	{
		$sql = "";
		$value = "";
		if (!is_array($update))
		{
			foreach ($arrattr as $val)
			{
				$sql .= "'$val', ";
			}
			$sql = substr($sql, 0, (strlen($sql)-1));
			foreach ($arrval as $val)
			{
				$value .= "'$val', ";
			}
			$value = substr($value, 0, (strlen($value)-1));
			$sql = "INSERT INTO $table ($sql) VALUES ($value);"; 
		}
		else
		{
			$num = 0;
			foreach ($arrattr as $val)
			{
				$sql .= "'$val'='".$arrval[$num]."', ";
				$num++;
			}
			$sql = substr($sql, 0, (strlen($sql)-1));
			$sql = "UPDATE $table SET $sql WHERE '".$update[0]."'='".$update[1]."';"; 
		}
		return sql($sql);
	}

?>