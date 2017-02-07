

<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'trades')
{
	
	$dir_dest = $designpath."/files"; // tukar kat sini mana nak letak
	$handle = new Upload($_FILES['file']);
	$handle->Process($dir_dest);
	if ($handle->processed)
	{	
		$taid = $_POST['aid'];
		$tlat = $_POST['tlat'];
		$tlon = $_POST['tlon'];
		$ttype = $_POST['ttype'];
		$ttitle = $_POST['ttitle'];
		$tdescription = $_POST['tdescription'];
		$tquantity = $_POST['tquantity'];
		$tprice = $_POST['tprice'];
		$taddress = $_POST['taddress'];
		$tpic = $handle->file_dst_name;
		
		$queryinsert = mysql_query("INSERT INTO trades (status, aid, tlat, tlon, ttype, ttitle, tdescription, tprice, tpic, tquantity, taddress)
												VALUES ('1','".$taid."','".$tlat."','".$tlon."','".$ttype."','".$ttitle."','".$tdescription."','".$tprice."','".$tpic."','".$tquantity."','".$taddress."')")
									or die(mysql_error());
									
		
//for post table
$price = number_format($tprice, 2, '.', '');
$postTextTemp = "Product : $ttitle
Price : $price
Description : $tdescription";
$postText = $postTextTemp;
if (strlen($_POST['ttitle']) >= 1)
{
$temptext = "";
$temptext = $postText;
$temptext = str_replace(chr(10), "", $temptext);
$temptext = str_replace(chr(13), "", $temptext);
$temptext = str_replace("\r", "", $temptext);
$detail[pid]	 = "1500".time();
$detail[ptext]	 = $postText;
$detail[lat]	 = $tlat;
$detail[lon]	 = $tlon;
$detail[locname] = $taddress;
$detail[pcat]	 = 1600;
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

		
		// everything was fine !
		header('Location: index.php?op=trades&s=success');
		
	}
	else
	{
		
		$taid = $_POST['aid'];
		$tlat = $_POST['tlat'];
		$tlon = $_POST['tlon'];
		$ttype = $_POST['ttype'];
		$ttitle = $_POST['ttitle'];
		$tdescription = $_POST['tdescription'];
		$tquantity = $_POST['tquantity'];
		$tprice = $_POST['tprice'];
		$taddress = $_POST['taddress'];
		$tpic = "no_image.gif";
		
		$queryinsert = mysql_query("INSERT INTO trades (status, aid, tlat, tlon, ttype, ttitle, tdescription, tprice, tpic, tquantity, taddress)
												VALUES ('1','".$taid."','".$tlat."','".$tlon."','".$ttype."','".$ttitle."','".$tdescription."','".$tprice."','".$tpic."','".$tquantity."','".$taddress."')") or die(mysql_error());
		
//for post table
$price = number_format($tprice, 2, '.', '');
$postTextTemp = "Product : $ttitle
Price : $price
Description : $tdescription";
$postText = $postTextTemp;
if (strlen($_POST['ttitle']) >= 1)
{
$temptext = "";
$temptext = $postText;
$temptext = str_replace(chr(10), "", $temptext);
$temptext = str_replace(chr(13), "", $temptext);
$temptext = str_replace("\r", "", $temptext);
$detail[pid]	 = "1500".time();
$detail[ptext]	 = $postText;
$detail[lat]	 = $tlat;
$detail[lon]	 = $tlon;
$detail[locname] = $taddress;
$detail[pcat]	 = 1600;
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
	
	$handle-> Clean();
}

?>