<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../metro/js/player/mediaelementplayer.css" rel="stylesheet" type="text/css"/>

<title>Untitled Document</title>

<script type="text/javascript">
function closex()
{
	window.close();
}
</script>
</head>
 
<body class="metrouicss" >
<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------


$aid = $_POST['aid'];
$ptext = $_POST['ptext'];

$xuser = accdb($aid);

if(isset($_POST['shareloc']))
{
	?>
    	<p></p>
    	<button onclick="closex();">close</button>
    <?php
	//for post table
	$postText = $ptext;
	if (strlen($_POST['ptext']) >= 4)
	{
		$temptext = "";
		$temptext = $postText;
		$temptext = str_replace(chr(10), "", $temptext);
		$temptext = str_replace(chr(13), "", $temptext);
		$temptext = str_replace("\r", "", $temptext);
		$detail[pid]	 = "1500".time();
		$detail[ptext]	 = $postText;
		$detail[lat]	 = $xuser['alat'];
		$detail[lon]	 = $xuser['alon'];
		$detail[locname] = "";
		$detail[pcat]	 = 0;
		$detail[pdate]	 = date('Y-m-d G:i:s', time());
		$detail[pdate2]	 = time();
		$detail[ptype]	 = 0;
		$detail[proot]	 = $chkid;
		$detail[aid]	 = $chkid;
		if (mysql_query(gendata("posts", $detail, "INSERT")))
		{
			$temptext = $detail[ptext];
			foreach ($accDB as $value)
			{
				if (strpos($temptext,"@".$value[auname]) !== false)
				{
					//NOTIFICATION
					$temptext = str_replace("@".$value[auname], "", $temptext);
					$ntid	 = $detail[pid]; //Post ID
					$naid	 = $value[aid]; //Post's Owner ID
					if ($naid != $chkid)
					{
						$notification[aid]	 = $naid;
						$notification[nmsg]	 = ":AID:$chkid has tagged your name in his/her NOTIFICATION:$chkid:1:$ntid:post";
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
		

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
else
{
	?>
    	<p></p>
    	<button onclick="closex();">close</button>
    <?php
	//for post table
	$postText = $ptext;
	if (strlen($_POST['ptext']) >= 4)
	{
		$temptext = "";
		$temptext = $postText;
		$temptext = str_replace(chr(10), "", $temptext);
		$temptext = str_replace(chr(13), "", $temptext);
		$temptext = str_replace("\r", "", $temptext);
		$detail[pid]	 = "1500".time();
		$detail[ptext]	 = $postText;
		$detail[lat]	 = "";
		$detail[lon]	 = "";
		$detail[locname] = "";
		$detail[pcat]	 = 0;
		$detail[pdate]	 = date('Y-m-d G:i:s', time());
		$detail[pdate2]	 = time();
		$detail[ptype]	 = 0;
		$detail[proot]	 = $chkid;
		$detail[aid]	 = $chkid;
		if (mysql_query(gendata("posts", $detail, "INSERT")))
		{
			$temptext = $detail[ptext];
			foreach ($accDB as $value)
			{
				if (strpos($temptext,"@".$value[auname]) !== false)
				{
					//NOTIFICATION
					$temptext = str_replace("@".$value[auname], "", $temptext);
					$ntid	 = $detail[pid]; //Post ID
					$naid	 = $value[aid]; //Post's Owner ID
					if ($naid != $chkid)
					{
						$notification[aid]	 = $naid;
						$notification[nmsg]	 = ":AID:$chkid has tagged your name in his/her NOTIFICATION:$chkid:1:$ntid:post";
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
		

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
	
//echo "<br>".$ptext;
//echo "<br>".$xuser['alat']." ".$xuser['alon'];
?>

</body>
</html>