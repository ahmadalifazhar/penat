<?php
	if (!$member)
		die("You need to relogin");
	session_start();
	$inputs = array();
	$inputs = $account;
	if(isset($_GET['logout'])){	
		
		//Simple exit message
		//$fp = fopen("log.html", 'a');
		//fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['pinitchatname'] ." has left the chat session.</i><br></div>");
		//fclose($fp);
		
		session_destroy();
	}
	if($member){
		$_SESSION['pinitchatname'] = stripslashes(htmlspecialchars($account[afname]." ".$acount[alname]));
	}
	
	//CHATS
	//if(file_exists("/home/marhazk/domains/pin-it.tk/public_html/new/log.html") && filesize("/home/marhazk/domains/pin-it.tk/public_html/new/log.html") > 0){
	//	$handle = fopen("/home/marhazk/domains/pin-it.tk/public_html/new/log.html", "r");
	//	$contents = fread($handle, filesize("/home/marhazk/domains/pin-it.tk/public_html/new/log.html"));
	//	fclose($handle);
	//	$inputs["CHATS"] = $contents;
	//}
	$q = mysql_query("SELECT * FROM chats ORDER BY cid DESC LIMIT 0,100");
	while ($r = mysql_fetch_array($q))
	{
		foreach ($accDB as $acc)
		{
			if ($acc[aid] == $r[aid])
			{
				$r[acc] = array();
				$r[acc] = $acc;
			}
		}
		$inputs["CHATS"] = "<div class='msgln'>(".date('g:i:s A', $r[cdate2]).") <b><a href=\"?op=profile&profile=".$r[acc][aid]."\">".$r[acc][afname]." ".$r[acc][alname]."</a></b> (<a href=\"#\" onclick=\"document.getElementById('usermsg').value+='@".$r[acc][auname]." ';\">TAG</a>): ".smiley($r[cmsg])."<br></div>".$inputs["CHATS"];
	}
	
	mysql_query("UPDATE accounts SET achatunread=0 WHERE aid=$chkid");

	$web->loadpage("modules/pages/account", "chat.html", $inputs);
?>