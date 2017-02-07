
<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

include "../cloud/classes/class.upload.php";
include "../cloud/classes/aidy.php";
/*
action
aid
wtype
wtitle
wdescription
wquantity
wprice
file
*/


$waid = $_POST['aid'];
$wtype = $_POST['wtype'];
$wtitle = $_POST['wtitle'];
$wdescription = $_POST['wdescription'];
$wquantity = $_POST['wquantity'];
$wprice = $_POST['wprice'];

if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'wish')
{
	
	$dir_dest = "wish"; // tukar kat sini mana nak letak
	$handle = new Upload($_FILES['file']);
	
	$handle->Process($dir_dest);
	
	if ($handle->processed)
	{	
		$wpic = $handle->file_dst_name;
		
$queryinsert = mysql_query("INSERT INTO wishlist (status, aid, wtype, wtitle, wdescription, wprice, wpic)
VALUES ('1','".$waid."','".$wtype."','".$wtitle."','".$wdescription."','".$wprice."','".$wpic."')") or die(mysql_error());
											
		
		// everything was fine !
		//header('Location: index.php?op=trades&go=wishupload');
		
	}
	else
	{
		$wpic = "no_image.gif";
		
$queryinsert = mysql_query("INSERT INTO wishlist (status, aid, wtype, wtitle, wdescription, wprice, wpic)
VALUES ('1','".$waid."','".$wtype."','".$wtitle."','".$wdescription."','".$wprice."','".$wpic."')") or die(mysql_error());
		
		// everything was fine !
		//header('Location: index.php?op=trades&go=wishupload');
	}
	
	$handle-> Clean();
	echo '<script>window.location.href = "mywishlist.php?s=success";</script>';
	//header('Location: http://www.facebook.com');
}

?>
