<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

include "../cloud/classes/class.upload.php";
//include "../cloud/classes/aidy.php";
$wid = $_POST['wid'];
$wtype = $_POST['wtype'];
$wtitle = $_POST['wtitle'];
$wdescription = $_POST['wdescription'];
$wprice = $_POST['wprice'];

if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'updatewish')
{
		$dir_dest = "wish"; // tukar kat sini mana nak letak

		$handle = new Upload($_FILES['file']);

		$handle->Process($dir_dest);

		if ($handle->processed)
		{	
			$wpic = $handle->file_dst_name;

			mysql_query("UPDATE wishlist w SET w.wtype = '".$wtype."',
											 w.wtitle = '".$wtitle."',
											 w.wdescription = '".$wdescription."',
											 w.wprice = '".$wprice."',
											 w.wpic = '".$wpic."'
						WHERE w.wid = '".$wid."'") or die(mysql_error());
			
			// everything was fine !
			header('Location: mywishlist.php?s=update');
		}

	
		else
		{
			mysql_query("UPDATE wishlist w SET w.wtype = '".$wtype."',
											 w.wtitle = '".$wtitle."',
											 w.wdescription = '".$wdescription."',
											 w.wprice = '".$wprice."'
						WHERE w.wid = '".$wid."'") or die(mysql_error());
			
			header('Location: mywishlist.php?s=update');
		}

	$handle-> Clean();
}

?>