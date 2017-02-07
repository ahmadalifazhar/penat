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
include "../phpjobscheduler/firepjs.php";
}

$jid = $_REQUEST['jid'];

 	$uid = $account[aid];
	
	echo "Date is ".$now = date('Y-m-d');
	  
	 mysql_query("INSERT INTO jobpostoutdated SELECT * FROM jobpost WHERE jdeadline='$now'");
	  
	 $query_delete = mysql_query("DELETE FROM jobpost WHERE jdeadline='$now'");
	  
	  
	  if(!$query_insert_select){
echo "<script>alert('Sorry, there is a problem in adding your job advertisement,Please Try Again');</script>";
echo '<script>window.history.back();</script>';
			}
else{
echo "<script>alert('Your Job Advertisement Successfully Added!');</script>";
echo '<script>window.location.href = "?op=job&load=postJob"</script>';
}

?>