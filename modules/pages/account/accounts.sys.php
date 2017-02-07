<?php

	//////////////////////// Accounts Module -Marhazli (pinit/01/04/003.a = Root)
	$accDBq = mysql_query("SELECT * FROM accounts, privacies WHERE privacies.aid=accounts.aid ORDER BY accounts.aid ASC");
	while ($accDBr = mysql_fetch_array($accDBq))
	{
		
		$pin = mysql_fetch_array(mysql_query("SELECT COUNT(pid) as totalpost FROM posts WHERE proot=".$accDBr[aid]));
		$fri = mysql_fetch_array(mysql_query("SELECT COUNT(aid) as totalfriend FROM friends WHERE faid=".$accDBr[aid]));
		$isf = mysql_fetch_array(mysql_query("SELECT COUNT(aid) as isfriend FROM friends WHERE aid=".$accDBr[aid]." AND faid=".$chkid));
		
		if (file_exists("./images/uploaded_images/resized/".$accDBr[apic].".jpg"))
			$accDBr[arealpic] = "./images/uploaded_images/resized/".$accDBr[apic].".jpg";
		else
			$accDBr[arealpic] = "./images/nopic.jpg";
		$accDBr[isfriend]		= $isf[isfriend];
		$accDBr[totalfriend]	= $fri[totalfriend];
		$accDBr[totalpost]		= $pin[totalpost];
		$accDBr[afname] = pinname($accDBr[afname]);
		$accDBr[alname] = pinname($accDBr[alname]);

		//$accDB[$accDBr[auname]] = $accDBr;
		$accDB["aid".$accDBr[aid]] = $accDBr;
		//echo $accDBr[isfriend]."<BR>";
	}
	function switchdb($row)
	{
		global $accDB;
		return $accDB["aid".$row[aid]];
	}
	function accDB($aid)
	{
		global $accDB;
		return $accDB["aid".$aid];
	}
	$account = switchdb($account);
?>