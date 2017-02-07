<?php
//DEFAULT web Mosque ID:
$defaultmID = 100;
//
	$uWeb_chardb[uid] = 0;
	
	$cookienameID = "pinbDBuseru";
	$cookienameName = "pinbDBusern";
	$cookieAuthID = $_COOKIE[$cookienameID];
	$cookieAuthName = $_COOKIE[$cookienameName];
	$serverUp = 0;

	//$DB_HOST = "perfectworld.sytes.net";
	//$DB_NAME = "bengkel2";
	//$DB_USER = "bengkel2";
	//$DB_PASS = "ftmk";
	$DB_HOST = "localhost";
	$DB_NAME = "marhazk_pinnew";
	$DB_USER = "root";
	$DB_PASS = "";
	$Link = @mysql_connect($DB_HOST, $DB_USER, $DB_PASS);
	if ($Link)
	{
		$dbsel = @mysql_select_db($DB_NAME, $Link) or die ("Database do not exists.");	
		$serverUp = 1;
	}
//	die("TEST $serverUp");
	// Account Settings
	//setcookie($cookienameID, "", time()-3600);
	//setcookie($cookienameAuth,"", time()-3600);
	$chkiplong = abs(ip2long($_SERVER[REMOTE_ADDR]));
	$chkip = $_SERVER[REMOTE_ADDR];
	$chk_host = $_SERVER[HTTP_HOST];
	$conf["login"] = 5;
	$conf["logout"] = 0;
	$conf["logingout"] = 0;
	
	$op2 = $_REQUEST['type'];
	$opchk = $_POST[opchk];
	$cookievalue = "";
	$userWebID = 0;
	//////////////////
	$op = $_REQUEST["op"];
	
	function addZero($text)
	{
		if (strlen($text) == 1)
			$new = "0".$text;
		else
			$new = $text;
		return $new;
	}
	function space($text, $total)
	{
		$len = $total-strlen($text);
		$w = "";
		for ($num = 0; $num < $len; $num++)
		{
			$w .= chr(32);
		}
		$text .= $w;
		return $text;
	}
	function hspace($total)
	{
		$w = "";
		for ($num = 0; $num < $total; $num++)
		{
			$w .= '&nbsp;';
		}
		return $w;
	}
	function strline($text)
	{
		$len = strlen($text);
		$text = "";
		$w = "";
		for ($num = 0; $num < $len; $num++)
		{
			$w .= "-";
		}
		$text .= $w;
		return $text;
	}
	function strName($text)
	{
		$name = "";
		$num = 0;
		$arr = explode(" ", $text);
		$count = count($arr);
		foreach ($arr as $val)
		{
			$len = strlen($val);
			$name .= strtoupper(substr($val,0,1));
			$name .= strtolower(substr($val,1,($len-1)));
			if ($num < $count)
				$name .= chr(32);
		}
		return $name;
	}
	function parseWord($userDoc) 
	{
		$fileHandle = fopen($userDoc, "r");
		$line = @fread($fileHandle, filesize($userDoc));   
		$lines = explode(chr(0x0D),$line);
		$outtext = "";
		foreach($lines as $thisline)
		  {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE)||(strlen($thisline)==0))
			  {
			  } else {
				$outtext .= $thisline." ";
			  }
		  }
		 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
		return $outtext;
	} 
	function parseWord2($userDoc) 
	{
		$fileHandle = fopen($userDoc, "r");
		$word_text = @fread($fileHandle, filesize($userDoc));
		$line = "";
		$tam = filesize($userDoc);
		$nulos = 0;
		$caracteres = 0;
		for($i=1536; $i<$tam; $i++)
		{
			$line .= $word_text[$i];
	
			if( $word_text[$i] == 0)
			{
				$nulos++;
			}
			else
			{
				$nulos=0;
				$caracteres++;
			}
	
			if( $nulos>1996)
			{   
				break;  
			}
		}
	
		//echo $caracteres;
	
		$lines = explode(chr(0x0D),$line);
		//$outtext = "<pre>";
	
		$outtext = "";
		foreach($lines as $thisline)
		{
			$tam = strlen($thisline);
			if( !$tam )
			{
				continue;
			}
	
			$new_line = ""; 
			for($i=0; $i<$tam; $i++)
			{
				$onechar = $thisline[$i];
				if( $onechar > chr(240) )
				{
					continue;
				}
	
				if( $onechar >= chr(0x20) )
				{
					$caracteres++;
					$new_line .= $onechar;
				}
	
				if( $onechar == chr(0x14) )
				{
					$new_line .= "</a>";
				}
	
				if( $onechar == chr(0x07) )
				{
					$new_line .= "\t";
					if( isset($thisline[$i+1]) )
					{
						if( $thisline[$i+1] == chr(0x07) )
						{
							$new_line .= "\n";
						}
					}
				}
			}
			//troca por hiperlink
			$new_line = str_replace("HYPERLINK" ,"<a href=",$new_line); 
			$new_line = str_replace("\o" ,">",$new_line); 
			$new_line .= "\n";
	
			//link de imagens
			$new_line = str_replace("INCLUDEPICTURE" ,"<br><img src=",$new_line); 
			$new_line = str_replace("\*" ,"><br>",$new_line); 
			$new_line = str_replace("MERGEFORMATINET" ,"",$new_line); 
	
	
			$outtext .= nl2br($new_line);
		}
	
	 return $outtext;
	} 
	
?>