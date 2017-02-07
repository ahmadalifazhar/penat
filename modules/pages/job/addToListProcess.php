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

$jid = $_REQUEST['jid'];

 	$uid = $account[aid];
	  
	  $ujobwatchlist_query = mysql_query("SELECT * FROM ujobwatchlist WHERE uid=$uid AND jid = $jid");
	  
		if(mysql_num_rows($ujobwatchlist_query) != 0)
			{
				echo "<script>alert('This Job Already In Your Watch List');</script>";
				echo '<script>window.location.href = "?op=job&load=latestJob"</script>';
			}
			else
				{
					
					//for ujobwatchlist table
						$query1= mysql_query("INSERT INTO ujobwatchlist(uid,jid)
						values('$chkid','$jid')") or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  
						
						
						if(!$query1){
						echo "<script>alert('Sorry, there is a problem in adding job to your watchlist,Please Try Again');</script>";
						echo '<script>window.history.back();</script>';
									}
						else{
						echo "<script>alert('Job Successfully Added Into Your Watchlist');</script>";
						echo '<script>window.location.href = "?op=job&load=latestJob"</script>';
						}
					
				}
						  
					
					

?>