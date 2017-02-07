<?php
	//
	//
	// Replace user detail to link
	// Written by Marhazli Kipli
	function pintag($text, $accDB, $profile = false, $notification = false)
	{
		$_text = array();
		$_text = explode(" ", $text);
		$_tnum = 0;
		$text = "";
		foreach ($_text as $_tvalue)
		{
			$text .= $_tvalue.' ';
			$_tnum++;
		}
		foreach ($accDB as $value)
		{
			if (strpos($text,":AID:".$value[aid]) !== false)
			{
				$text = str_replace(":AID:".$value[aid], '<a style=":STYLE:" href="?op=profile&profile='.$value[aid].'">'.$value[afname].' '.$value[alname].'</a>',$text);
			}
			else if (strpos($text,"@".$value[auname]) !== false)
			{
				if ($profile)
					$text = str_replace("@".$value[auname], '<a style=":STYLE:" href="?op=profile&profile='.$value[aid].'">@'.$value[auname].'</a>',$text);
				else
					$text = str_replace("@".$value[auname], '<a style=":STYLE:" href="#" onClick="TINY.box.show({iframe:\'?op=profile&profile='.$value[aid].'\',boxid:\'frameless\',width:750,height:450,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})">@'.$value[auname].'</a>',$text);
			}
			else if (strpos($text,"@".$value[afname].$value[alname]) !== false)
			{
				if ($profile)
					$text = str_replace("@".$value[afname].$value[alname], '<a style=":STYLE:" href="?op=profile&profile='.$value[aid].'">@'.$value[afname].$value[alname].'</a>',$text); 
				else
					$text = str_replace("@".$value[afname].$value[alname], '<a style=":STYLE:" href="#" onClick="TINY.box.show({iframe:\'?op=profile&profile='.$value[aid].'\',boxid:\'frameless\',width:750,height:450,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})">@'.$value[afname].$value[alname].'</a>',$text); 
			}
			else if (strpos($text,"@".$value[afname]) !== false)
			{
				if ($profile)
					$text = str_replace("@".$value[afname], '<a style=":STYLE:" href="?op=profile&profile='.$value[aid].'">@'.$value[afname].'</a>',$text); 
				else
					$text = str_replace("@".$value[afname], '<a style=":STYLE:"  href="#" onClick="TINY.box.show({iframe:\'?op=profile&profile='.$value[aid].'\',boxid:\'frameless\',width:750,height:450,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})">@'.$value[afname].'</a>',$text); 
			}
		}
		return trim($text);
	}
	
	//
	//
	// Replace text to custom text
	// Marhazli
	function pintext($text, $accDB, $profile = false, $notification = false)
	{
		$text = htmlspecialchars($text); // special characters code filter - sen
		$text = str_replace("\r", "<BR/>", $text);
		$text = str_replace("\n", "<BR/>", $text);
		$text = str_replace(chr(10), "<BR/>", $text);
		$text = str_replace(chr(13), "<BR/>", $text);
		
		
		$_text = array();
		$_text = explode(" ", $text);
		$_tnum = 0;
		$text = "";
		foreach ($_text as $_tvalue)
		{

			if (strpos($_tvalue,"youtube.com") !== false)
			{
				$matches = array();
				preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $_tvalue,$matches);
				// $matches[1] should contain the youtube id
				$utubeid = "";
				$utubeid = $matches[4];
				if (empty($matches[4]))
					$utubeid = $matches[3];
				if (empty($matches[3]))
					$utubeid = $matches[2];
				if (empty($matches[2]))
					$utubeid = $matches[1];
				if (empty($matches[1]))
					$utubeid = $matches[0];
				$_tvalue = '<a href="#" style=":STYLE:" onClick="TINY.box.show({iframe:\'http://www.youtube.com/embed/'.$utubeid.'\',boxid:\'frameless\',width:425,height:344,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})"><img src="images/FC/youtube.png"><BR><img width="250" height="125" src="http://i3.ytimg.com/vi/'.$utubeid.'/default.jpg"><BR></a>';

			}
			else if (strpos($_tvalue,":IMG:") !== false)
			{
				$_tvalue = str_replace(":IMG:", "", $_tvalue);
				$_fileid = explode("/",$_tvalue);
				if ($profile)
					$_tvalue = '<img style=":IMGSTYLE:" onClick="TINY.box.show({iframe:\'?op=cloud&go=item&item_id='.$_fileid[1].'\',boxid:\'frameless\',width:900,height:600,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})" src="modules/pages/cloud/files/'.$_tvalue.'"/ width=100 height=100>&nbsp;';
				else
					$_tvalue = '&nbsp<div class="tile image" style="float:none; width:250px;"><div class="tile-content"><img onClick="TINY.box.show({iframe:\'?op=cloud&go=item&item_id='.$_fileid[1].'\',boxid:\'frameless\',width:900,height:600,fixed:false,maskid:\'bluemask\',maskopacity:40,closejs:function(){closeJS()}})" src="modules/pages/cloud/files/'.$_tvalue.'"/></div></div>';
			}
			else if (strpos($_tvalue,":DOC:") !== false)
			{
				$_tvalue = str_replace(":DOC:", "", $_tvalue);
				$_tvalue = '<a style=":STYLE:" href="?op=cloud&go=item&item_id='.$_tvalue.'">[DOWNLOAD DOC]</a>';
			}
			else if (strpos($_tvalue,":CHAT:") !== false)
			{
				$_tvalue = str_replace(":DOC:", "", $_tvalue);
				$_tvalue = '<img src="images/chat.png?'.time().'">';
			}
			else if (strpos($_tvalue,"NOTIFICATION:") !== false)
			{
				// Rule of PID : PID:aid:type:target id (pid, aid):text:
				// $_array[0] = "NOTIFICATION"
				// $_array[1] = user id
				// $_array[2] = notification type [0: post/status, 1:comment, 2:uploaded file, 3: friend request]
				// $_array[3] = Post ID
				// $_array[4] = Text .ie: comment, photo, file, etc.
				$_array = explode(":", $_tvalue);
				$_tvalue = '<a style=":STYLE:" href="?op=profile&profile='.$_array[1].'&tid='.$_array[2].'&nid='.$_array[3].'">'.$_array[4].'</a>';
			}
			else if ((strpos($_tvalue,"http://") !== false) && (strpos($_tvalue,".") !== false))
			{
				$_tvalue = '<a style=":STYLE:" href="'.$_tvalue.'">'.$_tvalue.'</a>';
			}
			else if ((strpos($_tvalue,"www") !== false) && (strpos($_tvalue,".") !== false))
			{
				$_tvalue = '<a style=":STYLE:" href="http://'.$_tvalue.'">'.$_tvalue.'</a>';
			}
			else if ((strpos($_tvalue,".com") !== false) && (strpos($_tvalue,".") !== false))
			{
				$_tvalue = '<a style=":STYLE:" href="http://'.$_tvalue.'">'.$_tvalue.'</a>';
			}
			else if ((strpos($_tvalue,".net") !== false) && (strpos($_tvalue,".") !== false))
			{
				$_tvalue = '<a style=":STYLE:" href="http://'.$_tvalue.'">'.$_tvalue.'</a>';
			}
			else if (strpos($_tvalue,"#") !== false)
			{
				
				$_tvalue = '<a style=":STYLE:" href="?op=home&by='.str_replace("#","",$_tvalue).'">'.$_tvalue.'</a>'; 
			}
			$text .= $_tvalue.' ';
			$_tnum++;
		}
		$text = pintag(trim($text), $accDB, $profile, $notification);
		// Utk zeny design style
		if ($profile == false)
			$text = str_replace(":STYLE:", "font-size:12px;color:#CfCfCf;", $text);
		else
			$text = str_replace(":STYLE:", "color:#336600;", $text);
			
		if ($profile == false)
			$text = str_replace(":IMGSTYLE:", "height: auto !important;height:100%;max-width:200px;", $text);
		else
			$text = str_replace(":IMGSTYLE:", "width:100px;", $text);
			
		// END & load
		$text = smiley($text);
		return trim($text);
	}
?>