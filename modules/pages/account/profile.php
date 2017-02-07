<?php
	if (!$member)
		die("You need to relogin");
	///// fully coded by Marhazli
	$input		= array();
	$boxshow	= "none";
	ob_start();
	include "modules/pages/home/profile.posts.php";
	$posts = ob_get_clean();
	ob_start();
	include "modules/pages/home/profile.comments.php";
	$comments = ob_get_clean();
	
	///////////////////////////////
	// PROFILING SYSTEM
	if ($_REQUEST[profile] >= 1)
	{
		$profileid = $_REQUEST[profile];
		$profileacc = accdb($profileid);
	}
	else
	{
		$profileid = $chkid;
		$profileacc = $account;
	}
	$input = $profileacc;
	$input["USERID"]	= $profileid;
	
	if ($_REQUEST[nid] >= 1)
		$_REQUEST[ppid] = $_REQUEST[nid];
	if ($_REQUEST[ppid] >= 1)
		$boxshow = "block";

	if ($opchk == "PinReply!")
	{
		if (strlen($_POST[msg]) >= 1)
		{
			$detail[pid]		= "5000".time();
			$detail[proot]		= $_POST[pid];
			$detail[ptext]		= $_POST[msg];
			$detail[ptype]		= 1;
			$detail[pdate]		= date('Y-m-d G:i:s', time());
			$detail[pdate2]		= time();
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				//NOTIFICATION
				$q = mysql_query("SELECT * FROM accounts, posts WHERE posts.proot=".$_POST[pid]." AND accounts.aid=posts.aid GROUP BY accounts.aid");
				while ($r = mysql_fetch_array($q3))
				{
					if ($r[aid] == $chkid)
						continue;
					$ntid					= $_POST[pid]; //Post ID
					$naid					= $_POST[aid]; //Post's Owner ID
					if ($naid != $chkid)
					{
						$notification[aid]		= $r[aid];
						$notification[nmsg]		= ":AID:$chkid has reply a NOTIFICATION:$naid:1:$ntid:comment in :AID:".$naid." post";
						$notification[ndate]	= date('Y-m-d G:i:s', time());
						$notification[ndate2]	= time();
						mysql_query(gendata("notifications", $notification, "INSERT"));
					}
				}
				$temptext = $detail[ptext];
				foreach ($accDB as $value)
				{
					if (strpos($temptext,"@".$value[auname]) !== false)
					{
						//NOTIFICATION
						$temptext = str_replace("@".$value[auname], "", $temptext);
						$ntid					= $_POST[pid]; //Post ID
						$naid					= $value[aid]; //Post's Owner ID
						if ($naid != $chkid)
						{
							$notification[aid]		= $naid;
							$notification[nmsg]		= ":AID:$chkid has tagged your name in :AID:".$_POST[aid]." NOTIFICATION:".$_POST[aid].":0:$ntid:comment";
							$notification[ndate]	= date('Y-m-d G:i:s', time());
							$notification[ndate2]	= time();
							mysql_query(gendata("notifications", $notification, "INSERT"));
							send_notification($value[aid], $chkid, "Tagged", "?op=profile&profile=".$chkid."&ppid=".$detail[pid]);
						}
					}
				}
				$qall = mysql_query("SELECT * FROM accounts, posts WHERE posts.proot=".$_POST[pid]." AND accounts.aid=posts.aid GROUP BY accounts.aid");
				while ($rall = mysql_fetch_array($qall))
				{
					//NOTIFICATION
					$ntid					= $_POST[pid]; //Post ID
					$naid					= $rall[aid]; //Post's Owner ID
					if ($naid != $chkid)
					{
						$notification[aid]		= $naid;
						$notification[nmsg]		= ":AID:$chkid has reply your comment in :AID:".$_POST[aid]." NOTIFICATION:".$_POST[aid].":0:$ntid:post";
						$notification[ndate]	= date('Y-m-d G:i:s', time());
						$notification[ndate2]	= time();
						mysql_query(gendata("notifications", $notification, "INSERT"));
					}
				}
				send_notification($naid, $chkid, "Comment reply", "?op=profile&profile=".$naid."&ppid=".$ntid, $ntid);
				$web->msg("You have replied that post");
			}
			else
				$web->msg("Reply failed");
		}
		else
			$web->msg("Reply failed. No text found.");
	}
	else
	{
		if ($_REQUEST[like] >= 1)
		{
			$detail[lid]		= "2000".time();
			$detail[target]		= $_REQUEST[like];
			$detail[ldate]		= date('Y-m-d G:i:s', time());
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("likes", $detail, "INSERT")))
			{
				//NOTIFICATION
				$ntid					= $_REQUEST[like];; //Post ID
				$naid					= $_REQUEST[aid]; //Post's Owner ID
				if ($naid != $chkid)
				{
					$notification[aid]		= $naid;
					$notification[nmsg]		= ":AID:$chkid has like your NOTIFICATION:$naid:1:$ntid:post";
					$notification[ndate]	= date('Y-m-d G:i:s', time());
					$notification[ndate2]	= time();
					mysql_query(gendata("notifications", $notification, "INSERT"));
				}
				send_notification($naid, $chkid, "Comment like", "?op=view/comment&aid=".$naid."&ppid=".$ntid);
				$web->msg("You have like that post");
			}
			else
				$web->msg("Like failed");
		}
		if ($_REQUEST[hate] >= 1)
		{
			$detail[lid]		= "2000".time();
			$detail[target]		= $_REQUEST[hate];
			$detail[ldate]		= date('Y-m-d G:i:s', time());
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("dislikes", $detail, "INSERT")))
			{
				//NOTIFICATION
				$ntid					= $_REQUEST[hate]; //Post ID
				$naid					= $_REQUEST[aid]; //Post's Owner ID
				if ($naid != $chkid)
				{
					$notification[aid]		= $naid;
					$notification[nmsg]		= ":AID:$chkid has hate your NOTIFICATION:$naid:1:$ntid:post";
					$notification[ndate]	= date('Y-m-d G:i:s', time());
					$notification[ndate2]	= time();
					mysql_query(gendata("notifications", $notification, "INSERT"));
				}
				send_notification($_REQUEST[aid], $chkid, "Comment hate", "?op=view/comment&aid=".$naid."&ppid=".$ntid);
				$web->msg("You have hate that post");
			}
			else
				msg("ERROR", "Hate failed");
		}
		if ($_REQUEST[unlike] >= 1)
		{
			if (mysql_query("DELETE FROM likes WHERE aid=$chkid AND target=".$_REQUEST[unlike]))
			{
				//NOTIFICATION
				$ntid					= $_REQUEST[unlike]; //Post ID
				$naid					= $_REQUEST[aid]; //Post's Owner ID
				if ($naid != $chkid)
				{
					$notification[aid]		= $naid;
					$notification[nmsg]		= ":AID:$chkid has dislike your NOTIFICATION:$naid:1:$ntid:post";
					$notification[ndate]	= date('Y-m-d G:i:s', time());
					$notification[ndate2]	= time();
					mysql_query(gendata("notifications", $notification, "INSERT"));
				}
				send_notification($naid, $chkid, "Dislike", "?op=profile&profile=".$naid."&ppid=".$ntid);
				$web->msg("You have remove your like that post");
			}
			else
				$web->msg("Unlike failed");
		}
		if ($_REQUEST[unhate] >= 1)
		{
			if (mysql_query("DELETE FROM dislikes WHERE aid=$chkid AND target=".$_REQUEST[unhate]))
			{
				//NOTIFICATION
				$ntid					= $_REQUEST[unhate]; //Post ID
				$naid					= $_REQUEST[aid]; //Post's Owner ID
				if ($naid != $chkid)
				{
					$notification[aid]		= $naid;
					$notification[nmsg]		= ":AID:$chkid has dishate your NOTIFICATION:$naid:1:$ntid:post";
					$notification[ndate]	= date('Y-m-d G:i:s', time());
					$notification[ndate2]	= time();
					mysql_query(gendata("notifications", $notification, "INSERT"));
				}
				send_notification($naid, $chkid, "Dishate", "?op=profile&profile=".$naid."&ppid=".$ntid);
				$web->msg("You have remove your hate that post");
			}
			else
				$web->msg("Unhate failed");
		}
		if ($_REQUEST[repin] >= 1)
		{
			$repinq = mysql_query("SELECT * FROM posts WHERE pid=".$_REQUEST[repin]." LIMIT 0,1");
			if ($repinq)
			{
				$detailrow = mysql_fetch_array($repinq);
				$detail[pid]		= "1500".time();
				$detail[lat]		= $detailrow[lat];
				$detail[lon]		= $detailrow[lon];
				$detail[ptext]		= $detailrow[ptext];
				$detail[pdate]		= date('Y-m-d G:i:s', time());
				$detail[ptype]		= 0;
				$detail[proot]		= $chkid;
				$detail[aid]		= $chkid;
				$detail[repin]		= $detailrow[aid];
				if (mysql_query(gendata("posts", $detail, "INSERT")))
				{
					
					//NOTIFICATION
					$ntid					= $detail[pid]; //Post ID
					$naid					= $detailrow[aid]; //Post's Owner ID
					if ($naid != $chkid)
					{
						$notification[aid]		= $naid;
						$notification[nmsg]		= ":AID:$chkid has repinned your NOTIFICATION:$naid:1:$ntid:post";
						$notification[ndate]	= date('Y-m-d G:i:s', time());
						$notification[ndate2]	= time();
						mysql_query(gendata("notifications", $notification, "INSERT"));
					}
					send_notification($naid, $chkid, "Repin", "?op=profile&profile=".$naid."&ppid=".$ntid);
					$web->msg("Message has been Repinned");
				}
				else
					$web->msg("Repin failed. ");
			}
			else
				$web->msg("Repin failed. No text found.");
		}
	}
	//////////////////////////////////////////////////////
	//functions
	//PINTEXT
	function pinptext($text, $accDB)
	{
		return pintext($text, $accDB, true);
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
	//// __MYPIC__
	if (file_exists("./images/uploaded_images/resized/".$profileacc[apic].".jpg"))
		$mypic = "./images/uploaded_images/resized/".$profileacc[apic].".jpg";
	else
		$mypic = "./images/nopic.jpg";
	$input["MYPIC"] = $mypic;
	
	///////////////////////////////
	// _PIN_, __DIVPOSTSCMT__ and _POSTS_
	$q = mysql_query("SELECT * FROM posts, accounts WHERE (posts.aid=$profileid OR posts.ptext LIKE \"%@".$profileacc[auname]."%\") AND posts.ptype=0 AND accounts.aid=posts.aid ORDER BY posts.pid DESC LIMIT 0,100");	
	$pinnum = 0;
	while ($r = mysql_fetch_array($q))
	{
		$r["tagged"] = "";
		$r["repinrow"] = 0;
		$r["likes"] = 0;
		$r["hates"] = 0;
		$r["commentsnum"] = 0;
		$r["comments"] = "";
		$r["likebtn"] = 0;
		$r["hatebtn"] = 0;
		$r[afname] = pinname($r[afname]);
  		$r[alname] = pinname($r[alname]);
  		$r[pintime] = pintime($r);
		$q1 = mysql_query("SELECT * FROM posts, accounts WHERE posts.proot=".$r[pid]." AND accounts.aid=posts.aid ORDER BY posts.pid DESC");
		$q2 = mysql_query("SELECT * FROM likes WHERE target=".$r[pid]);
		$q3 = mysql_query("SELECT * FROM dislikes WHERE target=".$r[pid]);
		$q4 = mysql_query("SELECT * FROM accounts WHERE aid=".$r[repin]);
		while ($r1 = mysql_fetch_array($q1))
		{
			$r["commentsnum"]++;
			$r1[afname] = pinname($r1[afname]);
	  		$r1[alname] = pinname($r1[alname]);
	  		$r1[pintime] = pintime($r1);
			if (file_exists("./images/uploaded_images/resized/".$r1[apic].".jpg"))
				$r1["apic"] = "./images/uploaded_images/resized/".$r1[apic].".jpg";
			else
				$r1["apic"] = "./images/nopic.jpg";
			$r1[ptext] = pinptext($r1[ptext], $accDB);
			$r["comments"] .= ob_replace($comments, $r1);
		}
		while ($r2 = mysql_fetch_array($q2))
		{
			$r["likes"]++;
			if ($r2[aid] == $chkid)
				$r["likebtn"] = $chkid;
		}
		while ($r3 = mysql_fetch_array($q3))
		{
			$r["hates"]++;
			if ($r3[aid] == $chkid)
				$r["hatebtn"] = $chkid;
		}
		while ($r4 = mysql_fetch_array($q4))
		{
			$r["repinrow"] = $r4;
		}
		if ($r["repinrow"] == 0)
			$r["repin"] = "";
		else
			$r["repin"] = 'Repinned via <a href="?op=profile&profile='.$r["repinrow"][aid].'">'.$r["repinrow"][afname].' '.$r["repinrow"][alname].'</a>';
		if ($r["likes"] == 0)
			$r["likes"] = "";
		else
			$r["likes"] = '<A class="pinlikes" href="?op=account/whois&target=likes&dtarget=like&pid='.$r["pid"].'">'.$r["likes"].' likes</a>';
		if ($r["hates"] == 0)
			$r["hates"] = "";
		else
			$r["hates"] = '<A class="pinhates" href="?op=account/whois&target=dislikes&dtarget=hate&pid='.$r["pid"].'">'.$r["hates"].' hates</a>';
		if ($r["commentsnum"] == 0)
		{
			$r["comments"] = "";
			$r["commentsnum"] = "";
		}
		else
			$r["commentsnum"] = '<A class="pincomments" href="javascript:hideshow(document.getElementById(\'comment'.$r[pid].'\'));">'.$r["commentsnum"].' comments</a>';
		if ($r["likebtn"] == $chkid)
			$r["likebtn"] = '<a href="?op=profile&profile='.$r[aid].'&unlike='.$r[pid].'&aid='.$r[aid].'">Remove Like</a>';
		else
			$r["likebtn"] = '<a href="?op=profile&profile='.$r[aid].'&like='.$r[pid].'&aid='.$r[aid].'">Like</a>';
		if ($r["hatebtn"] == $chkid)
			$r["hatebtn"] = '<a href="?op=profile&profile='.$r[aid].'&unhate='.$r[pid].'&aid='.$r[aid].'">Remove Hate</a>';
		else
			$r["hatebtn"] = '<a href="?op=profile&profile='.$r[aid].'&hate='.$r[pid].'&aid='.$r[aid].'">Hate</a>';
		if ($profileid != $r[aid])
			$r["tagged"] = 'Tagged by <a href="?op=profile&profile='.$r[aid].'">'.$r[afname].' '.$r[alname].'</a>';
		$r["boxshow"] = $boxshow;
		
		if (file_exists("./images/uploaded_images/resized/".$r[apic].".jpg"))
			$r["apic"] = "./images/uploaded_images/resized/".$r[apic].".jpg";
		else
			$r["apic"] = "./images/nopic.jpg";

		$r[ptext] = pinptext($r[ptext], $accDB);
		$pinnum++;
		if (($_REQUEST[ppid] >= 1) && ($_REQUEST[ppid] != $r[pid]))
			continue;
		$input["POSTS"] .= ob_replace($posts, $r);
		$input["DIVPOSTSCMT"] .= 'document.getElementById("comment'.$r[pid].'").style.display="none";'.chr(10);
	}
	
	$input["PIN"] = $profileacc[totalpost];
	if (empty($input["POSTS"]))
		$input["POSTS"] = "<tr><td>This user has not post anything yet...</td></tr>";
	
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
	$input["FRIENDS"] = $profileacc[totalfriend];
	
	
	///////////////////////////////
	// _BTNTYPE_
	if ($chkid == $profileid)
		$input["BTNTYPE"]		= "hidden";
	else
		$input["BTNTYPE"]		= "submit";

	///////////////////////////////
	// _BTNNAME_
	if ($profileacc[isfriend])
		$input["BTNNAME"]		= "Remove friend";
	else
		$input["BTNNAME"]		= "Add As Friend";


	///////////////////////////////
	///////////////////////////////
	///////////////////////////////
	// LOADPAGE
	$web->loadpage("modules/pages/home", "profile.html", $input);
	///////////////////////////////
	///////////////////////////////
	///////////////////////////////
	////////// Marhazli ///////////
?>