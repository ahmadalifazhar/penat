<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";

$tid = $_GET['id'];
$status = $_GET['status'];

if($status=="1")
{
	mysql_query("UPDATE trades t SET t.status = 2 WHERE t.tid = '".$tid."'") or die(mysql_error());
	echo "<meta http-equiv='refresh' content='0; url=myproduct.php'>";
}
else if($status=="2")
{
	mysql_query("UPDATE trades t SET t.status = 1 WHERE t.tid = '".$tid."'") or die(mysql_error());
	echo "<meta http-equiv='refresh' content='0; url=myproduct.php'>";
}


?>
</body>
</html>