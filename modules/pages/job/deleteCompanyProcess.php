<?php 
$offlineDB = 'config/dbconnect.php';

if (file_exists($offlineDB)) {
    include("config/dbconnect.php");
} else {

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
}

$pid = $_REQUEST['pid'];

 	$uid = $account[aid];
	  
	  $query_delete = mysql_query("DELETE FROM jobCompanyProfile WHERE profileid = $pid AND uid=$uid");
						
		if(!$query_delete)
		{
				echo "<script>alert('Sorry, there is a problem in removing the company profile,Please Try Again');</script>";
				echo '<script>window.history.back();</script>';
			}
		else{
				echo "<script>alert('Company Profile Successfully Removed');</script>";
				echo '<script>window.location.href = "?op=job&load=jobSetting"</script>';
			}
?>