<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

include "../cloud/classes/class.upload.php";
$tid = $_POST['tid'];
$tlat = $_POST['tlat'];
$tlon = $_POST['tlon'];
$ttype = $_POST['ttype'];
$ttitle = $_POST['ttitle'];
$tdescription = $_POST['tdescription'];
$tprice = $_POST['tprice'];

if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'update')
{
		$dir_dest = "files"; // tukar kat sini mana nak letak

		$handle = new Upload($_FILES['file']);

		$handle->Process($dir_dest);

		if ($handle->processed)
		{	
			$tpic = $handle->file_dst_name;
			
			mysql_query("UPDATE trades t SET t.tlat = '".$tlat."',
											 t.tlon = '".$tlon."',
											 t.ttype = '".$ttype."',
											 t.ttitle = '".$ttitle."',
											 t.tdescription = '".$tdescription."',
											 t.tprice = '".$tprice."',
											 t.tpic = '".$tpic."'
						WHERE t.tid = '".$tid."'") or die(mysql_error());
			
			// everything was fine !
			header('Location: myproduct.php?s=update');
		}

	
	else
	{
		/*
		echo '<p class="result">';
		echo ' <b>File not uploaded to the wanted location</b><br />';
		echo ' Error: ' . $handle->error . '';
		echo '</p>';
		
		$tid = $_POST['tid'];
		$tlat = $_POST['tlat'];
		$tlon = $_POST['tlon'];
		$ttype = $_POST['ttype'];
		$ttitle = $_POST['ttitle'];
		$tdescription = $_POST['tdescription'];
		$tprice = $_POST['tprice'];
		*/	
		mysql_query("UPDATE trades t SET t.tlat = '".$tlat."',
										 t.tlon = '".$tlon."',
										 t.ttype = '".$ttype."',
										 t.ttitle = '".$ttitle."',
										 t.tdescription = '".$tdescription."',
										 t.tprice = '".$tprice."'
					WHERE t.tid = '".$tid."'") or die(mysql_error());
		header('Location: myproduct.php?s=update');
	}

	$handle-> Clean();
}

?>