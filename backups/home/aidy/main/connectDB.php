<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript">
function connectDB()
{
<?php

$uid = "marhazk_psm";
$pwd = "Psm123456";
$serverName = "http://www.pinit.uni.me/phpmyadmin/";
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"pin"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn )
{	$out = "Connection established."; }
else
{
	$out = "Connection could not be established.";
	die( print_r( sqlsrv_errors(), true));
}

echo "woot".$out;
?>
}
</script>

</head>

<body>
<?php
echo "woot";
?>
</body>
</html>