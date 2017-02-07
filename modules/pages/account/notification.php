<?php
	if ((!$member) && (empty($_REQUEST[ajax])))
		die("You need to relogin");
	///// fully coded by Marhazli
	$input		= array();
	$boxshow	= "none";
	ob_start();
	include "modules/pages/home/profile.notifications.php";
	$posts = ob_get_clean();
	
	///////////////////////////////
	// PROFILING SYSTEM
	if ($_REQUEST[profile] >= 1)
	{
		$profileid = $_REQUEST[profile];
		$profileacc = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE aid='$profileid' LIMIT 0,1"));
	}
	else
	{
		$profileid = $chkid;
		$profileacc = $account;
	}
	if ($_REQUEST[ppid] >= 1)
		$boxshow = "block";

	//////////////////////////////////////////////////////
	//functions
	//PINTEXT
	function pinntext($text, $accDB)
	{
		return pintext($text, $accDB, true, true);
	}
	
	///////////////////////////////
	// _ACCOUNTS_ array
	foreach ($profileacc as $akey => $aval)
	{
		if (!is_numeric($akey))
			$input[strtoupper($akey)] = $aval;
	}
	
	////////////////////////////////////////
	//// __MYPIC__
	if (file_exists("./images/uploaded_images/resized/".$profileacc[apic].".jpg"))
		$mypic = "./images/uploaded_images/resized/".$profileacc[apic].".jpg";
	else
		$mypic = "./images/nopic.jpg";
	$input["MYPIC"] = $mypic;
	
	///////////////////////////////
	// _PIN_, __DIVPOSTSCMT__, NOTIFICATIONS and _POSTS_
	$input["NOTIFICATIONS"] = 0;
	$q = mysql_query("SELECT * FROM posts, accounts WHERE (posts.aid=$profileid OR posts.ptext LIKE \"%@".$profileacc[auname]."%\") AND posts.ptype=0 AND accounts.aid=posts.aid ORDER BY posts.pid DESC LIMIT 0,100");	
	$input["PIN"] = 0;
	while ($r = mysql_fetch_array($q))
	{
		$input["PIN"]++;
	}
	$q = mysql_query("SELECT * FROM notifications, accounts WHERE (notifications.aid=$profileid) AND accounts.aid=notifications.aid ORDER BY notifications.nid DESC LIMIT 0,100");	
	while ($r = mysql_fetch_array($q))
	{
		$r["PTEXT"] = "[".date('G:i:s', $r["ndate2"])."] ".pinntext($r[nmsg], $accDB);
		if (($_REQUEST[ppid] >= 1) && ($_REQUEST[ppid] != $r[pid]))
			continue;
		$input["POSTS"] .= ob_replace($posts, $r);
		if ($r[nread] == 0)
			$input["NOTIFICATIONS"]++;
	}
	$input["DIVPOSTSCMT"] = "";
	if ($input["NOTIFICATIONS"] == 0)
		$input["NOTIFICATIONS"] = "";
	else
		$input["NOTIFICATIONS"] = $input["NOTIFICATIONS"]." new updates";
	$notifytext = "<script language=\"text/javascript\">TINY.box.show({html:'<center>__CHAT____MSG__</center>',animate:true,close:false,autohide:15,mask:false,boxid:'success',bottom:-40,right:-40,width:300,height:30});</script>";
	//$notifytext = "<script language=\"text/javascript\">TINY.box.show({html:'__CHAT____MSG__',animate:true,close:false,autohide:15,mask:false,boxid:'success',bottom:-14,right:-17});

	///////////////////////////////
	// _DAYSOUT_
	$q = mysql_query("SELECT * FROM posts WHERE aid=$profileid GROUP BY lat, lon ORDER BY pid DESC");	
	$input["DAYSOUT"] = 0;
	while ($r = mysql_fetch_array($q))
	{
		$input["DAYSOUT"]++;
	}
	
	///////////////////////////////
	// _FRIENDS_
	$q = mysql_query("SELECT * FROM friends WHERE faid=$profileid");
	$input["FRIENDS"] = 0;
	while ($r = mysql_fetch_array($q))
	{
		$input["FRIENDS"]++;
	}


    ///////////////////////////////
    // _BTNNAME_
    $input["BTNNAME"] = "Hello!";


    ///////////////////////////////
    // _CHATS_
    $input["CHATS"] = $account["achatunread"];
	if ($input["CHATS"] == 0)
		$input["CHATS"] = "";
	else
		$input["CHATS"] = $input["CHATS"]." incoming messages";
		
	if (!(empty($input["NOTIFICATIONS"])) && (!(empty($input["CHATS"]))))
		$input["NOTIFICATIONS"] = ", ".$input["NOTIFICATIONS"];
	$notifytext = str_replace("__MSG__", $input["NOTIFICATIONS"], $notifytext);
	
	if ((empty($input["NOTIFICATIONS"])) && ((empty($input["CHATS"]))))
		$input["NOTIFICATIONS"] = "";
	else
		$input["NOTIFICATIONS"] = str_replace("__CHAT__", $input["CHATS"], $notifytext);

	///////////////////////////////
	///////////////////////////////
	///////////////////////////////
	// LOADPAGE
	if ($_REQUEST[ajax] == 1)
		$web->loadpage("modules/pages/home", "profile.notifications.ajax.html", $input);
	else
	{
		if ($chkid == $profileid)
		{
			$update["nread"]		= 1;
			$updatewhere["aid"]		= $chkid;
			mysql_query(gendata("notifications", $update, $updatewhere));
		}
		$web->loadpage("modules/pages/home", "profile.html", $input);
	}
	///////////////////////////////
	///////////////////////////////
	///////////////////////////////
	////////// Marhazli ///////////
?>