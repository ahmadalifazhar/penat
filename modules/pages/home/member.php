<?php
	// Marhazli (ref: pinit/01/04/002.b)
	include "modules/pages/account/profile.sys.php";
	ob_start();
	include "modules/pages/home/js/mapfix.alif.20130426.js";
	$otherscript = ob_get_clean();
	
	/////////////////////////////////////// SEMUA POST disini yoo!! -Marhazli (ref: pinit/01/04/002.a)
	//if (strpos($_REQUEST[by],"#") !== false)
	$sqlmapFC = array();
	$mapqFC = array();
	$mapFCDB = array();
	$sqldb = array();

	if (strlen($_REQUEST[by]) >= 1)
	{
		$sql =	"SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.ptext LIKE '%#".$_REQUEST[by]."%' GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,10";
		$sqlmap = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.ptext LIKE '%#".$_REQUEST[by]."%' GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
	}
	else
	{
		//$sql =	"SELECT * FROM posts, friends, accounts WHERE (friends.aid=$chkid AND accounts.aid=friends.aid AND accounts.aid=posts.aid AND friends.faid>=1 AND posts.ptype=0 AND posts.aid=friends.aid) GROUP BY posts.pid ORDER BY posts.pid DESC";


		//For global post only
		$sql =	"SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50";
		$sqldb[0] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1100' AND posts.pcat<='1199') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");
		$sqldb[1] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1200' AND posts.pcat<='1299') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");
		$sqldb[2] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1300' AND posts.pcat<='1399') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");
		$sqldb[3] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1400' AND posts.pcat<='1499') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");
		$sqldb[4] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1700' AND posts.pcat<='1799') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");
		$sqldb[5] =	mysql_query("SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.pcat>='1600' AND posts.pcat<='1699') AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,50");

		//$sqlmap = "SELECT * FROM posts, friends, accounts WHERE friends.faid>=0 AND (posts.aid=friends.faid) AND accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 GROUP BY posts.pid, friends.aid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		
		$sqlmap = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.pcat=0 AND posts.lat>=1 AND posts.lon>=1 GROUP BY posts.pid, accounts.aid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";

		//For friends post only
		//$sql =	"SELECT * FROM posts, friends, accounts WHERE (friends.aid=$chkid AND friends.faid>=1) AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 GROUP BY posts.pid ORDER BY posts.pid DESC LIMIT 0,10";
		//$sqlmap = "SELECT * FROM posts, friends, accounts WHERE (friends.aid=$chkid AND friends.faid>=0) AND (posts.aid=friends.faid OR posts.aid=friends.aid) AND accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 GROUP BY posts.pid, friends.aid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		
		//Subsystems
		$sqlmapFC[0] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1300 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[1] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1301 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[2] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1302 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[3] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1303 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[4] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1304 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[5] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1305 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[6] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1306 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[7] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1307 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[8] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1700 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[9] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1701 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[10] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1702 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[11] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1703 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[12] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1704 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[13] = "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1705 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[14] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1706 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[15] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1707 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[16] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1100 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[17] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1200 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
		$sqlmapFC[18] =  "SELECT * FROM posts, accounts WHERE accounts.aid=posts.aid AND posts.ptype=0 AND posts.lat>=1 AND posts.lon>=1 AND posts.pcat = 1600 GROUP BY posts.pid, posts.ptype, posts.lat, posts.lon ORDER BY accounts.aid, posts.pid DESC";
	}
	$newsfeedq = mysql_query($sql);
	$mapq = mysql_query($sqlmap);
	
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
	$newsfeedrDB = array();
	$sqlcatDB = array();
	$mapdb = array();
	$num = 0;
	
	//include "modules/pintext.php";
	//////////////////////// User Tagging for Posts, intergrated with ref pinit/01/04/003.a -Marhazli (pinit/01/04/002.c)
	$sqldbnum = 0;
	foreach ($sqldb as $query)
	{
		$sqlcatDB[$sqldbnum] = array();
		$rnum = 0;
		while ($_row = mysql_fetch_array($query))
		{
			$_row[ptext] = pintext($_row[ptext], $accDB);
			$sqlcatDB[$sqldbnum][$rnum] = $_row;
			$rnum++;
		}
		$sqldbnum++;
	}
	while ($newsfeedrx = mysql_fetch_array($newsfeedq))
	{
		$newsfeedrx[ptext] = pintext($newsfeedrx[ptext], $accDB);
		$newsfeedrDB[$num] = $newsfeedrx;
		$num++;
	}
	$num = 0;
	$chkAID = 0;
	while ($mapx = mysql_fetch_array($mapq))
	{
		if ($chkAID != $mapx[aid])
		{
			$chkAID = $mapx[aid];
			$mapx[tid]		= $num;
			$mapdb[$num]	= $mapx;
			$num++;
		}
	}

	//////////////////////// LoadPage Function under Class::PinIT() -Marhazli (pinit/01/04/002.a)
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//STR to replace
	//// __DIVPOSTS__
	$input = array();
	foreach($newsfeedrDB as $newsfeedr)
	{
		$input["DIVPOSTS"] .= 'document.getElementById("adiv'.$newsfeedr[pid].'").style.display="block";'.
					'document.getElementById("bdiv'.$newsfeedr[pid].'").style.display="none";'.chr(10);
	}
	
	////////////////////////////////////////
	//// __OTHERSCRIPTS__
	$input["OTHERSCRIPTS"] = "";
	//$input["OTHERSCRIPTS"] = $otherscript;
	
	$input["OTHERSCRIPTS"] .= 'var accDBun = new Array;';
	$input["OTHERSCRIPTS"] .= 'var accDBid = new Array;';
	$input["OTHERSCRIPTS"] .= 'var accDBfl = new Array;';
	$accDBnum = 0;
	$qf = mysql_query("SELECT * FROM friends, accounts WHERE friends.faid=$chkid AND accounts.aid=friends.aid ORDER BY accounts.aid ASC");
	while ($value = mysql_fetch_array($qf))
	{
		$input["OTHERSCRIPTS"] .= 'accDBun['.$accDBnum.'] = "'.$value[auname].'";';
		$input["OTHERSCRIPTS"] .= 'accDBid['.$accDBnum.'] = "'.$value[aid].'";';
		$input["OTHERSCRIPTS"] .= 'accDBfl['.$accDBnum.'] = "'.$value[afname].' '.$value[alname].'";';
		$accDBnum++;
	}
	
	////////////////////////////////////////
	//// __PUSHPIN__
	$tempCount = 0;
	
	foreach ($mapdb as $map)
	{
		if (file_exists("./images/uploaded_images/resized/".$map[apic].".jpg"))
			$mpic = "./images/uploaded_images/resized/".$map[apic].".jpg";
		else
			$mpic = "./images/nopic.jpg";
	  
		$tid[$tempCount] = $map['tid'];
		$title[$tempCount] = $map['afname']." ".$map['alname'];
		$descript[$tempCount] = htmlspecialchars($map['ptext']);
		$latitude[$tempCount] = $map['lat'];
		$longitude[$tempCount] = $map['lon'];
		
		$temptext = "";
		$temptext = str_replace(chr(10), "", $descript[$tempCount]);
		$temptext = str_replace(chr(13), "", $temptext);
		$temptext = str_replace("\r", "", $temptext);
		$descript[$tempCount] = str_replace("\n", "", $temptext);
			
		$input["PUSHPIN"] .= 'tid['.$tempCount.'] = '.$tid[$tempCount].';';	
		$input["PUSHPIN"] .= 'title['.$tempCount.'] = "'.$title[$tempCount].'";';
		$input["PUSHPIN"] .= 'descript['.$tempCount.'] = "'.$descript[$tempCount].'";';
		$input["PUSHPIN"] .= 'latitude['.$tempCount.'] = '.$latitude[$tempCount].';';
		$input["PUSHPIN"] .= 'longitude['.$tempCount.'] = '.$longitude[$tempCount].';'.chr(10);
		$tempCount++;
	}
	//$input["PUSHPIN"] .= 'alert("2:'.$tid[2].'");';
	//$input["PUSHPIN"] .= 'alert("2:'.$title[2].'");';
	//$input["PUSHPIN"] .= 'alert("2:'.$latitude[2].'");';
	//$input["PUSHPIN"] .= 'alert("2:'.$longitude[2].'");';
	
	//$input["PUSHPIN"] .= 'alert("1:'.$descript[1].'");';
	//$input["PUSHPIN"] .= 'alert("2:'.$descript[2].'");';
	//$input["PUSHPIN"] .= 'alert("3:'.$descript[3].'");';
	//$input["PUSHPIN"] .= 'alert("4:'.$descript[4].'");';

	$input["PUSHPIN"] .= 'i = '.$tempCount.';';
	
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
	
			$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][1]['.$tempCount.'] = '.$tid[$tempCount].';';	
			$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][2]['.$tempCount.'] = "'.$title[$tempCount].'";';
			$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][3]['.$tempCount.'] = "'.$descript[$tempCount].'";';
			$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][4]['.$tempCount.'] = '.$latitude[$tempCount].';';
			$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][5]['.$tempCount.'] = '.$longitude[$tempCount].';'.chr(10);
			$tempCount++;
		}
		$input["PUSHPIN"] .= 'ppFC['.$mapFCDBnum.'][0] = '.$tempCount.';'.chr(10);
	}

	////////////////////////////////////////
	//// __MYPIC__
	if (strlen($_REQUEST[by]) >= 1)	
		$input["HASHTAG"] = "&by=".$_REQUEST[by];
	else
		$input["HASHTAG"] = "";
	////////////////////////////////////////
	//// __MYPIC__
	if (file_exists("./images/uploaded_images/resized/".$account[apic].".jpg"))
		$mypic = "./images/uploaded_images/resized/".$account[apic].".jpg";
	else
		$mypic = "./images/nopic.jpg";
	$input["MYPIC"] = $mypic;
		

	////////////////////////////////////////
	//// __LEFTSIDE__
	if ($_REQUEST[ajax] == "1")
	{
		if ($_REQUEST[cat] == 1)
			$newDB = $sqlcatDB[0];
		else if ($_REQUEST[cat] == 2)
			$newDB = $sqlcatDB[1];
		else if ($_REQUEST[cat] == 3)
			$newDB = $sqlcatDB[2];
		else if ($_REQUEST[cat] == 4)
			$newDB = $sqlcatDB[3];
		else if ($_REQUEST[cat] == 5)
			$newDB = $sqlcatDB[4];
		else if ($_REQUEST[cat] == 6)
			$newDB = $sqlcatDB[5];
		else
			$newDB = $newsfeedrDB;
		include "modules/pages/home/member.newsfeeds.php";
		$input["LEFTSIDE"] = $newf;
	}
	else if ($_REQUEST[ppid] >= 1)
	{
		$newDB = $newsfeedrDB;
		include "modules/pages/home/member.newsfeeds.php";
		$input["LEFTSIDE"] = $newf;
	}
	else
	{
		include "modules/pages/home/member.left.php";
		$input["LEFTSIDE"] = $leftside;
	}
	////////////////////////////////////////
	//// CONTENTS (optional)
	include "modules/pages/home/member.contents.php";
	
	
	////////////////////////////////////////
	//// Accounts
	foreach ($account as $akey => $aval)
	{
		if (!is_numeric($akey))
			$input[strtoupper($akey)] = $aval;
	}
	
	////////////////////////////////////////
	//// Other functions
	if ($_REQUEST[updatelatlon] == 1)
	{
		if ((!empty($_REQUEST[lat])) && (!empty($_REQUEST[lon])))
		{
			$latlon[alat]			= $_REQUEST[lat];
			$latlon[alon]			= $_REQUEST[lon];
			$latlon[alocname]		= $_REQUEST[locname];
			$latlon[alastupdated]	= time();
			$latlonwhr[aid]			= $chkid;
			mysql_query(gendata("accounts", $latlon, $latlonwhr));
		}
	}
	
	////Removing caches (MarHazK)
	$input["CACHE"]		= time();
	
	// LOAD PAGE
	if ($_REQUEST[ajax] == "1")
		$web->loadpage("modules/pages/home", "newsfeeds.html", $input);
	else if ($_REQUEST[ajax] == "2")
		die("TADA");
	else if ($_REQUEST[ajax] == "3")
		$web->loadpage("modules/pages/home", "template.html", $input);
	else if ($_REQUEST[ppid] >= 1)
		$web->loadpage("modules/pages/home", "Comments.html", $input);
	else
		$web->loadpage("modules/pages/home", "Home.html", $input);
?>
