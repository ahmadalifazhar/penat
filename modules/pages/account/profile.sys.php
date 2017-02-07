<?php
//Fully coded by MarHazK
	if ($opchk == "PinIt!")
	{
		if (strlen($_POST[msg]) >= 1)
		{
			$temptext = "";
			$temptext = $_POST[msg];
			$detail[pid]		= "1500".time();
			$detail[ptext]		= $temptext;
			$detail[lat]		= $_POST[lat];
			$detail[lon]		= $_POST[lon];
			$detail[locname]	= $_POST[locname];
			$detail[pcat]		= 0;
			$detail[pdate]		= date('Y-m-d G:i:s', time());
			$detail[pdate2]		= time();
			$detail[ptype]		= 0;
			$detail[proot]		= $chkid;
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				$temptext = $detail[ptext];
				foreach ($accDB as $value)
				{
					if (strpos($temptext,"@".$value[auname]) !== false)
					{
						//NOTIFICATION
						$temptext = str_replace("@".$value[auname], "", $temptext);
						$ntid					= $detail[pid]; //Post ID
						$naid					= $value[aid]; //Post's Owner ID
						if ($naid != $chkid)
						{
							$notification[aid]		= $naid;
							$notification[nmsg]		= ":AID:$chkid has tagged your name in his/her NOTIFICATION:$chkid:1:$ntid:post";
							$notification[ndate]	= date('Y-m-d G:i:s', time());
							$notification[ndate2]	= time();
							mysql_query(gendata("notifications", $notification, "INSERT"));
							send_notification($value[aid], $chkid, "Tagged", "?op=profile&profile=".$chkid."&ppid=".$detail[pid]);
						}
					}
				}
				$web->msg("Message has been posted");
			}
			else
				$web->msg("Message failed");
		}
		else
			$web->msg("Message failed. No text found.");
	}
	
	if ($opchk == "PinIt Here!")
	{
		if (strlen($_POST[msg]) >= 1)
		{
			$temptext = "";
			$temptext = $_POST[msg];
			$detail[pid]		= "1500".time();
			$detail[ptext]		= $temptext;
			$detail[lat]		= $_POST[latUserDefine];
			$detail[lon]		= $_POST[lonUserDefine];
			$detail[locname]	= $_POST[locnameUserDefine];
			$detail[pcat]		= $_POST[pcat];
			$detail[pdate]		= date('Y-m-d G:i:s', time());
			$detail[pdate2]		= time();
			$detail[ptype]		= 0;
			$detail[proot]		= $chkid;
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				if (($_POST[pcat] >= 1300) && ($_POST[pcat] <= 1399))
				{
					if (!(mysql_query("UPDATE trafficstats SET ttotal=ttotal+1 WHERE tmonth='".date('m-Y', time())."'")))
						mysql_query("INSERT INTO trafficstats (ttotal, tmonth) VALUES (1, '".date('m-Y', time())."');");
				}
				$temptext = $detail[ptext];
				foreach ($accDB as $value)
				{
					if (strpos($temptext,"@".$value[auname]) !== false)
					{
						
						$temptext = str_replace("@".$value[auname], "", $temptext);
						//NOTIFICATION
						$ntid					= $detail[pid]; //Post ID
						$naid					= $value[aid]; //Post's Owner ID
						if ($naid != $chkid)
						{
							$notification[aid]		= $naid;
							$notification[nmsg]		= ":AID:$chkid has tagged your name in his/her NOTIFICATION:$chkid:1:$ntid:post";
							$notification[ndate]	= date('Y-m-d G:i:s', time());
							$notification[ndate2]	= time();
							mysql_query(gendata("notifications", $notification, "INSERT"));
							send_notification($value[aid], $chkid, "Tagged", "?op=profile&profile=".$chkid."&ppid=".$detail[pid]);
						}
					}
				}
				$web->msg("Message has been posted for User Defined Location!");
			}
			else
				$web->msg("Message failed");
		}
		else
			$web->msg("Message failed. No text found.");
	}
	if (strlen($_REQUEST[shortcut]) >= 1)
	{
		$_POST[pid] = $_REQUEST[pid];
		$_POST[aid] = $_REQUEST[aid];
	}
	if (($opchk == "PinLike!") || ($_REQUEST[shortcut] == "like"))
	{
		$detail[lid]		= "2000".time();
		$detail[target]		= $_POST[pid];
		$detail[ldate]		= date('Y-m-d G:i:s', time());
		$detail[aid]		= $chkid;
		if (mysql_query(gendata("likes", $detail, "INSERT")))
		{
			//NOTIFICATION
			$ntid					= $_POST[pid]; //Post ID
			$naid					= $_POST[aid]; //Post's Owner ID
			if ($naid != $chkid)
			{
				$notification[aid]		= $naid;
				$notification[nmsg]		= ":AID:$chkid has like your NOTIFICATION:$naid:1:$ntid:post";
				$notification[ndate]	= date('Y-m-d G:i:s', time());
				$notification[ndate2]	= time();
				mysql_query(gendata("notifications", $notification, "INSERT"));
				send_notification($naid, $chkid, "Comment like", "?op=profile&profile=".$_POST[aid]."&ppid=".$_POST[pid]);
			}
		}
		else
			$web->msg("Like failed");
	}
	if (($opchk == "PinDislike!") || ($_REQUEST[shortcut] == "hate"))
	{
		$detail[lid]		= "2000".time();
		$detail[target]		= $_POST[pid];
		$detail[ldate]		= date('Y-m-d G:i:s', time());
		$detail[aid]		= $chkid;
		if (mysql_query(gendata("dislikes", $detail, 3)))
		{
			//NOTIFICATION
			$ntid					= $_POST[pid]; //Post ID
			$naid					= $_POST[aid]; //Post's Owner ID
			if ($naid != $chkid)
			{
				$notification[aid]		= $naid;
				$notification[nmsg]		= ":AID:$chkid has hate your NOTIFICATION:$naid:1:$ntid:post";
				$notification[ndate]	= date('Y-m-d G:i:s', time());
				$notification[ndate2]	= time();
				mysql_query(gendata("notifications", $notification, "INSERT"));
				send_notification($naid, $chkid, "Comment hate", "?op=profile&profile=".$_POST[aid]."&ppid=".$_POST[pid]);
			}
		}
		else
			$web->msg("Dislike failed");
	}
	if (($opchk == "UnPinLike!") || ($_REQUEST[shortcut] == "dislike"))
	{
		if (mysql_query("DELETE FROM likes WHERE aid=$chkid AND target=".$_POST[pid]))
		{
			//NOTIFICATION
			$ntid					= $_POST[pid]; //Post ID
			$naid					= $_POST[aid]; //Post's Owner ID
			if ($naid != $chkid)
			{
				$notification[aid]		= $naid;
				$notification[nmsg]		= ":AID:$chkid has dislike your NOTIFICATION:$naid:1:$ntid:post";
				$notification[ndate]	= date('Y-m-d G:i:s', time());
				$notification[ndate2]	= time();
				mysql_query(gendata("notifications", $notification, "INSERT"));
			}
		}
		else
			$web->msg("Like failed");
	}
	if (($opchk == "UnPinDislike!") || ($_REQUEST[shortcut] == "dishate"))
	{
		if (mysql_query("DELETE FROM dislikes WHERE aid=$chkid AND target=".$_POST[pid]))
		{
			//NOTIFICATION
			$ntid					= $_POST[pid]; //Post ID
			$naid					= $_POST[aid]; //Post's Owner ID
			if ($naid != $chkid)
			{
				$notification[aid]		= $naid;
				$notification[nmsg]		= ":AID:$chkid has dishate your NOTIFICATION:$naid:1:$ntid:post";
				$notification[ndate]	= date('Y-m-d G:i:s', time());
				$notification[ndate2]	= time();
				mysql_query(gendata("notifications", $notification, "INSERT"));
			}
		}
		else
			$web->msg("Dislike failed");
	}
?>