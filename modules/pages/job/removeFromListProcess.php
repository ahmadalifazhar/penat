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
					//for ujobwatchlist table
						$query1= mysql_query("DELETE FROM ujobwatchlist WHERE uid=$uid AND jid=$jid") or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  
						
						
						if(!$query1){
						echo "<script>alert('Sorry, there is a problem in removing job from your watchlist,Please Try Again');</script>";
						echo '<script>window.history.back();</script>';
									}
						else{
						echo "<script>alert('Job Successfully Removed From Your Watchlist');</script>";
						echo '<script>window.location.href = "?op=job&load=myWatchList"</script>';
						}
?>