<?php
	/*This guide is originally written by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013 */

	/* Set template */
	$designpath				= "modules/pages/shopping";
	$designfile				= "Design.html";
	/* Find the word __SYSNAME__ from $designfile */
	$account["SYSNAME"]		= "Shopping";	
	/* Find the word __SYSTITLE__ from $designfile */
	$account["SYSTITLE"]	= "Shopping";	
	/* Find the word __SYSLINK__ from $designfile */
	$account["SYSLINK"]		= "shopping";	
	$account["REQVALUE"] 	= "";
	
	if ($member)
	{
		if ($_REQUEST[delete] >= 1)
		{
			$del = $_REQUEST[delete];
			mysql_query("DELETE FROM posts WHERE pid=$del");
			mysql_query("DELETE FROM likes WHERE target=$del");
			mysql_query("DELETE FROM dislikes WHERE target=$del");
			mysql_query("UPDATE shopping SET shopping_total=shopping_total-1 WHERE shopping_month='".date('m-Y', substr($del,4))."'");
			$web->msg("Your post has been removed");
		}
		if ($opchk == "Post")
		{
		$shoppingpost = array();
		$shoppingpost[a_id] = $account[aid];
		$shoppingpost[s_title] = $_POST['Title'];
		$shoppingpost[s_desc] = $_POST['Description'];
		$shoppingpost[s_address] = $_POST['Address'];
		$shoppingpost[s_name] = $_POST['name'];
		$shoppingpost[s_contact] = $_POST['contactno'];
		$shoppingpost[s_email] = $_POST['email'];
		$shoppingpost[s_country] = $_POST['Country'];
		$shoppingpost[s_deadline] = $_POST['Deadline'];
		$shoppingpost[s_startdate] = $_POST['Startdate'];
		$shoppingpost[s_lat] = $_POST['lat'];
		$shoppingpost[s_lon] = $_POST['lon'];
		$shoppingpost[pcat] = 1700;
		
		$postTextTemp = 
		"
		Title : $shoppingpost[s_title]
		Company Name: $shoppingpost[s_name]
		Description : $shoppingpost[s_desc]
		Address : $shoppingpost[s_address]
		Contact No : $shoppingpost[s_contact]
		Email : $shoppingpost[s_email]
		Start Date : $shoppingpost[s_startdate]
		Deadline : $shoppingpost[s_deadline]";
		$postText = $postTextTemp;
			if (mysql_query(gendata("shoppingpost", $shoppingpost, "INSERT")))
			{
				$temptext = "";
				$temptext = $postText;
				$temptext = str_replace(chr(10), "", $temptext);
				$temptext = str_replace(chr(13), "", $temptext);
				$temptext = str_replace("\r", "", $temptext);
				/* 1500 = Post Status, 5000 = Status Comments */
				$detail[pid]		= "1500".time(); 
				/* Retrieve textfield value from Design.hmtl */
				$detail[ptext]	 = $postText;
				/*$detail[ptext]		= "Title : ".$shoppingpost[s_title];
				$detail[ptext]		= "Company Name: ".$shoppingpost[s_name];
				$detail[ptext]		= "Description : ".$shoppingpost[s_desc];
				$detail[ptext]		= "Address : "$shoppingpost[s_address];
				$detail[ptext]		= "Contact No : ".$shoppingpost[s_contact];
				$detail[ptext]		= "Email : ".$shoppingpost[s_email];
				$detail[ptext]		= "Start Date : ".$shoppingpost[s_stardate];
				$detail[ptext]		= "Deadline :".$shoppingpost[s_deadline];*/
				/* Latitude for current account */
				$detail[lat]		= $_POST[lat]; 
				/* Longtitude for current account */
				$detail[lon]		= $_POST[lon]; 
				$detail[locname]	= ""; 
				$detail[pcat]		= 1700;
				/* Date of posting */
				$detail[pdate]		= date('Y-m-d G:i:s', time()); 
				/* Post status = 0, status comment = 1 */
				$detail[ptype]		= 0; 
				/* Current Account ID */
				$detail[proot]		= $chkid; 
				/* Current Account ID */
				$detail[aid]		= $chkid; 
				
				mysql_query(gendata("posts", $detail, "INSERT"));

				$web->msg("Latest Promotion has been posted.");
			}
			else
				$web->msg("failed to posted");
		}
		if ($opchk == "PinIt!")
		{
			/* 1500 = Post Status, 5000 = Status Comments */
			$detail[pid]		= "1500".time(); 
			/* Retrieve textfield value from Design.hmtl */
			$detail[ptext]		= $_POST[msg]; 
			/* Latitude for current account */
			$detail[lat]		= $_POST[plat]; 
			/* Longtitude for current account */
			$detail[lon]		= $_POST[plon]; 
			$detail[locname]	= ""; 
			$detail[pcat]		= $_POST["pcat"];
			/* Date of posting */
			$detail[pdate]		= date('Y-m-d G:i:s', time()); 
			/* Post status = 0, status comment = 1 */
			$detail[ptype]		= 0; 
			/* Current Account ID */
			$detail[proot]		= $chkid; 
			/* Current Account ID */
			$detail[aid]		= $chkid; 
			
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				if (($_POST[pcat] >= 1700) && ($_POST[pcat] <= 1799))
				{
					if (!(mysql_query("UPDATE shopping SET shopping_total = shopping_total+1 WHERE shopping_month='".date('m-Y', time())."'")))
						mysql_query("INSERT INTO shopping (shopping_total, shopping_month) VALUES (1, '".date('m-Y', time())."'");
				}
				/* Notification */
				/* Post other user's ID*/
				$ntid					= $_REQUEST[unlike]; 
				/* Post owner's ID*/
				$naid					= $_REQUEST[aid]; 
				
				if ($naid != $chkid)
				{
					$notification[aid]		= $naid;
					$notification[nmsg]		= ":AID:$chkid has dislike your NOTIFICATION:$naid:0:$ntid:post";
					$notification[ndate]	= date('Y-m-d G:i:s', time());
					$notification[ndate2]	= time();
					mysql_query(gendata("notifications", $notification, "INSERT"));
				}
				
				send_notification($naid, $chkid, "Post", "?op=profile&profile=".$naid."&ppid=".$ntid);
				$web->msg("Latest Promotion has been posted.");
			}
			else
				$web->msg("Failed to post your message.");
		}
	}
	else
	{
		//die("Please login first before you proceed.");
		echo '<script type="text/javascript">';
		echo 'setTimeout("window.location=\'index.php?op=account\'",5000);';
		echo '</script>';
		echo 'Please login first before you proceed. Redirecting to login page in 5 seconds...';
	}
	
	/* Load page  and array*/
	$inputs = array();	
	$inputs = $account;
	$inputs["CACHE"] = time();
	$inputs["DATENOW"] = date('Y-m-d', time());
	
	/*$sqlmapFC = array();
		$sqlmapFC[8] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1300 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[9] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1301 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[10] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1302 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[11] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1303 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[12] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1304 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[13] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1305 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[14] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1306 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[15] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1307 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
	for ($mapFCnum = 0; $mapFCnum < count($sqlmapFC); $mapFCnum++)
	{
		$mapqFC[$mapFCnum] = mysql_query($sqlmapFC[$mapFCnum]);
		$mapFCDB[$mapFCnum] = array();
		$num = 0;
		while ($_mapfc = mysql_fetch_array($mapqFC[$mapFCnum]))
		{
			$_mapfc[tid]				= $num;
			$mapFCDB[$mapFCnum][$num]	= $_mapfc;
			$num++;
		}
	}
	for ($mapFCDBnum = 0; $mapFCDBnum < count($sqlmapFC); $mapFCDBnum++)
	{
		$tempCount = 0;
		foreach ($mapFCDB[$mapFCDBnum] as $map)
		{
			$temptext = "";
			$temptext = htmlspecialchars($map['ptext']);
			$temptext = str_replace(chr(10), "", $temptext);
			$temptext = str_replace(chr(13), "", $temptext);
			$temptext = str_replace("\r", "", $temptext);
			$temptext = str_replace("\n", "", $temptext);
			$tid[$tempCount] = $map['tid'];
			$title[$tempCount] = $map['afname']." ".$map['alname'];
			$descript[$tempCount] = $temptext;
			$latitude[$tempCount] = $map['lat'];
			$longitude[$tempCount] = $map['lon'];
	
			$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][1]['.$tempCount.'] = '.$tid[$tempCount].';';	
			$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][2]['.$tempCount.'] = "'.$title[$tempCount].'";';
			$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][3]['.$tempCount.'] = "'.$descript[$tempCount].'";';
			$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][4]['.$tempCount.'] = '.$latitude[$tempCount].';';
			$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][5]['.$tempCount.'] = '.$longitude[$tempCount].';'.chr(10);
			$tempCount++;
		}
		$inputs["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][0] = '.$tempCount.';'.chr(10);
	}
	
	if (isset($_REQUEST[lat]))
	{
		$designfile			= "Design_Map.html";
		$inputs["PLAT"]		= $_REQUEST[lat];
		$inputs["PLON"]		= $_REQUEST[lon];
	}*/
	
	/* OtherScripts*/
	$inputs["OTHERSCRIPTS"] = "";
	$inputs["OTHERSCRIPTS"] .= 'privacyID = '.$account[c17].';';
	$inputs["OTHERSCRIPTS"] .= 'notificationID = '.$account[n17].';';
	$inputs["OTHERSCRIPTS"] .= 'var accDBun = new Array;';
	$inputs["OTHERSCRIPTS"] .= 'var accDBid = new Array;';
	$inputs["OTHERSCRIPTS"] .= 'var accDBfl = new Array;';
	
	$accDBnum = 0;
	$qf = mysql_query("SELECT * FROM friends, accounts WHERE friends.faid=$chkid AND accounts.aid=friends.aid ORDER BY accounts.aid ASC");
	
	while ($value = mysql_fetch_array($qf))
	{
		$inputs["OTHERSCRIPTS"] .= 'accDBun['.$accDBnum.'] = "'.$value[auname].'";';
		$inputs["OTHERSCRIPTS"] .= 'accDBid['.$accDBnum.'] = "'.$value[aid].'";';
		$inputs["OTHERSCRIPTS"] .= 'accDBfl['.$accDBnum.'] = "'.$value[afname].' '.$value[alname].'";';
		$accDBnum++;
	}
	
	if ($_REQUEST[ajax] == 1)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat>=1700 AND p.pcat<=1799 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
		
	if ($_REQUEST[ajax] == 2)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.aid=$chkid AND p.pcat>=1700 AND p.pcat<=1799 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_MyPost.html", $row);
		}
	}
		
	if ($_REQUEST[ajax] == 3)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat=1701 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
	
	if ($_REQUEST[ajax] == 4)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat=1702 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
	
	if ($_REQUEST[ajax] == 5)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat=1703 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
	
	if ($_REQUEST[ajax] == 6)
	{
		$designfile = "Design_ajax.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat=1704 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
	
	if ($_REQUEST[ajax] == 7)
	{
		$designfile = "post.php";
		$inputs["CONTENTS"] = "postProcess.php";
		$query1= mysql_query("INSERT INTO shoppingpostoutdated(a_id, s_desc, s_country, s_deadline, s_address, s_title, s_name, s_contact, s_email, s_startdate, s_lat, s_lon, pcat) VALUES
		('$aid','$desc', '$country','$deadline','$address','$title','$name','$contactno','$email','$startdate','$lat','$lon','$postCat')") 
		or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  

		while ($row = mysql_fetch_array($q))
		{
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design_AllPost.html", $row);
		}
	}
	
	//PRIVACIES TABLES
	if ($_REQUEST[ajax] == 8)
	{
		die(mysql_query("UPDATE privacies SET c17='".$_REQUEST[val]."' WHERE aid='$chkid'"));
	}
	if ($_REQUEST[ajax] == 9)
	{
		die(mysql_query("UPDATE privacies SET n17='".$_REQUEST[val]."' WHERE aid='$chkid'"));
	}
	
	/* Count and compare the percentange within one month */
	$inputs["STATISTICPERCENTAGE"] = "0";
	$inputs["STATISTIC"] = "0";
	$inputs["OLDSTATISTIC"] = "0";
	//$q = mysql_query("UPDATE shopping SET shopping_id='"$_REQUEST[val]."' WHERE shopping_total='" ORDER BY shopping_id DESC);
	
    $query_selectCountry = "SELECT * FROM country GROUP BY country_name ORDER BY country_name ASC ";
	$array_selectCountry=mysql_query($query_selectCountry) or die(mysql_error());
    while($rowCountry=mysql_fetch_array($array_selectCountry))
    {
		$inputs["COUNTRYLIST"] .= '<option value='.$rowCountry[country_name].'">'.$rowCountry[country_name].'</option>';
	}

	$q = mysql_query("SELECT * FROM shoppingpost WHERE s_deadline>='".date('Y-m-1', time())."' ORDER BY s_ID DESC");
	
	$inputs["MAXSTATISTIC"] = 300;
	//$q = mysql_query("SELECT * FROM shopping WHERE shopping_total='".$_REQUEST[val]."' ORDER BY shopping_id DESC);
	if ($q)
	{
		$shopping_total = NULL;
		$shopping_percentage = NULL;
		while ($r = mysql_fetch_array($q))
		{
			if ($shopping_total >= 1)
			{
				$inputs["STATISTIC"] = $shopping_total;
				$shopping_percentage = ($shopping_total/$inputs["MAXSTATISTIC"])*100;
			}
			$shopping_total++;
		}
		if ($shopping_percentage >= 100)
			$shopping_percentage = 100;
		$inputs["STATISTICPERCENTAGE"] = substr($shopping_percentage,0,4);
	}

	/* TESTING */
	$inputs["TEST1"] = "Hello world...";
	$inputs["TEST2"] = "Hello again world...";
	
	/* Load the page of $designfile from $designpath, with inserting the array of $inputs */
	$web->loadpage($designpath, $designfile, $inputs);
	
?>