<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------


$tid = $_GET['id'];
//echo $tid;
mysql_query("UPDATE trades t SET t.status = '3' WHERE t.tid = '".$tid."'") or die(mysql_error());
?>

<script>
//alert("Data has been deleted");
window.location = 'myproduct.php';
</script>

<?php

?>

</body>
</html>