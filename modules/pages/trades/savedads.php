<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------


$aid = $_GET['aid'];
$tid = $_GET['tid'];

/*
echo $aid;
echo "<br>";
echo $tid;
*/

$query = mysql_query("INSERT INTO tradesmark (aid,tid) VALUES ('$aid','$tid')") or die(mysql_error());

header("Location: http://www.pinit.uni.me/modules/pages/trades/productdetail.php?product=$tid");
?>