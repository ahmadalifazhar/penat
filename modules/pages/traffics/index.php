<?php
	//This guide is originally written by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v1 by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v2 by Farid Yusof
	//Integrated designs by Marhazli (marhazk@yahoo.com) on 12:01am 13/may/2013

	//Please set your template below
	$designpath				= "modules/pages/traffics";
	$designfile				= "Design.html";
	$account["SYSNAME"]		= "Traffic";	//Will find the word __SYSNAME__ from $designfile
	$account["SYSTITLE"]	= "Traffic";	//Will find the word __SYSTITLE__ from $designfile
	$account["SYSLINK"]		= "traffics";	//Will find the word __SYSLINK__ from $designfile
	$account["REQVALUE"] 	= "";
	$account["FORMURL"]		= "?op=traffics";
	
	if ($member)
	{
		if ($_REQUEST[delete] >= 1)
		{
			$del = $_REQUEST[delete];
			mysql_query("DELETE FROM posts WHERE pid=$del");
			mysql_query("DELETE FROM likes WHERE target=$del");
			mysql_query("DELETE FROM dislikes WHERE target=$del");
			mysql_query("UPDATE trafficstats SET ttotal=ttotal-1 WHERE tmonth='".date('m-Y', substr($del,4))."'");
			$web->msg("Your post has been removed..");
		}
		if ($opchk == "PinIt!")
		{
			$detail[pid]		= "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
			$detail[ptext]		= $_POST[msg]; //Retrieve textfield value from Design.hmtl
			$detail[lat]		= $_POST[plat]; //Current account's Latitude
			$detail[lon]		= $_POST[plon]; //Current account's Longtitude
			$detail[locname]	= ""; //Problems since IFRAME, use 0 instead of $_POST[locname]
			//Your subsystem/module category ID, refer to http://www.pin-it.tk/new/?op=files..
			// default must be XXYY (Example 1301)
			// XX = Reference ID, only 11-17
			// YY = sub-reference, its up to you
			// Example are Below:
			//ref format : [sys name]/[sys ver]/[sys devel month]/[class]/[ref no].[no ver: a-z]
			//ref: pinit/01/04/00/xxx.x (Root System)
			//ref: pinit/01/04/01/xxx.x (Account System)
			//ref: pinit/01/04/02/xxx.x (Profile System)
			//ref: pinit/01/04/03/xxx.x (Geo-map System)
			//ref: pinit/01/04/04/xxx.x (Setting System)
			//ref: pinit/01/04/05/xxx.x (Chat/MSG System)
			//ref: pinit/01/04/06/xxx.x (Geo-map System)
			//ref: pinit/01/04/07/xxx.x (- System) *Reserved*
			//ref: pinit/01/04/08/xxx.x (- System) *Reserved*
			//ref: pinit/01/04/09/xxx.x (- System) *Reserved*
			//ref: pinit/01/04/10/xxx.x (- System) *Reserved*
			//ref: pinit/01/04/11/xxx.x (Jobs SubSystem)
			//ref: pinit/01/04/12/xxx.x (Entertainment SubSystem)
			//ref: pinit/01/04/13/xxx.x (Transportation SubSystem)
			//ref: pinit/01/04/14/xxx.x (Cloud SubSystem)
			//ref: pinit/01/04/15/xxx.x (Education SubSystem)
			//ref: pinit/01/04/16/xxx.x (Trades SubSystem)
			//ref: pinit/01/04/17/xxx.x (Shopping Tracker SubSystem)
			$detail[pcat]		= $_POST["pcat"];
			$detail[pdate]		= date('Y-m-d G:i:s', time()); //Date of Post
			$detail[ptype]		= 0; //(0 = Post Status, 1=Status comment)
			$detail[proot]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
			$detail[aid]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				mysql_query("UPDATE trafficstats SET ttotal=(ttotal+1) WHERE tmonth='".date('m-Y', time())."'");
				mysql_query("INSERT INTO trafficstats (tmonth, ttotal) VALUES ('".date('m-Y', time())."', 1)");
				$web->msg("Your message has been posted");
			}
			else
				$web->msg("Failed to posted");
		}
	}
	else if ($_REQUEST[sys] == md5("MarHazK-JAIS13"))
	{
		$account["FORMURL"]		= "http://www.jais.tk/?option=".$_REQUEST[option]."&op=searchmap";
		$designfile				= "Design.LOCAL.html";
		$account["reqvalue"]	= $_REQUEST[reqval];
		$account["afname"]		= base64_decode(str_replace("_","=", $_REQUEST[uia]));
		$account["alname"]		= base64_decode(str_replace("_","=", $_REQUEST[uil]));
		$account["auname"]		= "JAIS-Admin";
	}
	else
	{
		die("Please login first...");
	}
	
	//// Introduction of Loadpage and arrays
	$inputs = array();	//This variable must be declared as ARRAY()
	$inputs = $account;
	$inputs["CACHE"] = time();
	
	$sqlmapFC = array();
		$sqlmapFC[0] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1300 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[1] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1301 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[2] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1302 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[3] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1303 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[4] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1304 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[5] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1305 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[6] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1306 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[7] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1307 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
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
			
			if (file_exists("./images/uploaded_images/resized/".$map[apic].".jpg"))
				$mappic = "./images/uploaded_images/resized/".$map[apic].".jpg";
			else
				$mappic = "./images/nopic.jpg";
				
			$title[$tempCount] = "<img src=".$mappic." style='height: auto;  width: auto;  max-width: 100%;'/>".$map['afname']." ".$map['alname'];
			//$title[$tempCount] = "<img src=".$mappic."> ".$map['afname']." ".$map['alname'];
			$templink[like] = "<P><a href=/?op=profile&profile=".$map[aid]."&like=".$map[pid]."&aid=".$map[aid]."><img src=/images/like.png alt='Like It'> Like It</a><BR></P>";
			$templink[hate] = "<P><a href=/?op=profile&profile=".$map[aid]."&hate=".$map[pid]."&aid=".$map[aid]."><img src=/images/hate.png alt='Hate It'> Hate It</a><BR></P>";
			$templink[post] = "<P><a href=/?op=account/profile&ppid=".$map[pid]."&profile=".$map[aid]."><img src=/images/post.png alt='View Post'> View Post</a><BR></P>";
			$descript[$tempCount] = $templink[like].$templink[hate].$templink[post].$temptext;
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
		$designfile			= "Design.MAP.html";
		$inputs["PLAT"]		= $_REQUEST[lat];
		$inputs["PLON"]		= $_REQUEST[lon];
	}

	////////////////////////////////////////
	//// __OTHERSCRIPTS__
	$inputs["OTHERSCRIPTS"] = "";
	$inputs["OTHERSCRIPTS"] .= 'privacyID = '.$account[c13].';';
	$inputs["OTHERSCRIPTS"] .= 'notificationID = '.$account[n13].';';
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
		$designfile = "Design.AJAX.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat>=1300 AND p.pcat<=1399 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row = pinacc($row);
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design.ALLTRAFFICS.html", $row);
		}
	}
		
	if ($_REQUEST[ajax] == 2)
	{
		$designfile = "Design.AJAX.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.aid=$chkid AND p.pcat>=1300 AND p.pcat<=1399 AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row = pinacc($row);
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design.MYTRAFFICS.html", $row);
		}
	}
		
	if (($_REQUEST[ajax] >= 3) && ($_REQUEST[ajax] <= 9))
	{
		$designfile = "Design.AJAX.html";
		$inputs["CONTENTS"] = "";
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pcat=".($_REQUEST[ajax]+1298)." AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC LIMIT 0,15");
		while ($row = mysql_fetch_array($q))
		{
			$row = pinacc($row);
			$row[ptext] = pintext($row[ptext], $accDB);
			$row[pdate] = pintime($row);
			$inputs["CONTENTS"] .= ob_file($designpath."/Design.ALLTRAFFICS.html", $row);
		}
	}
	
	//PRIVACIES TABLES
	if ($_REQUEST[ajax] == 10)
	{
		die(mysql_query("UPDATE privacies SET c13='".$_REQUEST[val]."' WHERE aid='$chkid'"));
	}
	if ($_REQUEST[ajax] == 11)
	{
		die(mysql_query("UPDATE privacies SET n13='".$_REQUEST[val]."' WHERE aid='$chkid'"));
	}
	
	
	//Count and compare the percentange within one month
	$inputs["STATSPCT"] = "0";
	$inputs["STATS"] = "0";
	$inputs["OLDSTATS"] = "0";
	$q = mysql_query("SELECT * FROM trafficstats ORDER BY tid DESC LIMIT 0,2");
	if ($q)
	{
		//tmonth='".date('m-Y', time())."'
		$ttotal = NULL;
		$tpct = NULL;
		while ($r = mysql_fetch_array($q))
		{
			if ($ttotal >= 1)
			{
				$inputs["STATS"] = $ttotal;
				$tpct = ($ttotal/$r[ttotal])*100;
			}
			$ttotal = $r[ttotal];
		}
		if ($tpct >= 100)
			$tpct = 100;
		$inputs["STATSPCT"] = substr($tpct,0,5);
		$inputs["OLDSTATS"] = $ttotal;
	}
	for ($num = 1300; $num <= 1307; $num++)
	{
		$inputs["STATS".$num] = 0;
		$q = mysql_query("SELECT * FROM posts p, accounts a WHERE p.pdate>='".date('Y-m-01', time())."' AND p.pcat=".$num." AND p.ptype=0 AND a.aid=p.aid ORDER BY p.pid DESC");
		while ($row = mysql_fetch_array($q))
		{
			$inputs["STATS".$num]++;
		}
	}

	//Will find the word __TEST1__ from $designfile
	$inputs["TEST1"] = "Hello world...";

	//Will find the word __TEST2__ from $designfile
	$inputs["TEST2"] = "Hello again world...";
	
	//Will find the word __LOGINSTATUS__ from $designfile
	if ($member)
		$inputs["LOGINSTATUS"] = "Hello ".$account[auname]." (User ID: ".$chkid.")";
	else
		$inputs["LOGINSTATUS"] = "Please login first";
	
	//Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
	$web->loadpage($designpath, $designfile, $inputs);
?>