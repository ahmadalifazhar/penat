<?php
	if (!$member)
		die("You need to log in");
	$inputs = array();
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
	$web->loadpage("modules/pages/account", "msg.html", $inputs);
?>