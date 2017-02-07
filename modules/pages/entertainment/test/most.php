<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php

include "../../../config.php";
include "../../../accDB.php";
include "../../../functions.php";
include "../../../mailsys.php";
include "../../../account/accounts.sys.php";

?>

<?php
    $highest_id = mysql_result(mysql_query("SELECT MAX(views) FROM cloud where (type='mp4' OR type='flv' OR type='3gp')"), 0);
	
	$address = mysql_result(mysql_query("SELECT location FROM cloud where views='".$highest_id."'"), 0);
	
	echo $address;
?>   
</body>
</html>