<?php
$server = "localhost";
$namauser = "marhazk_psm";
$passuser = "Psm123456"; 
$db = "marhazk_psm";
$con = mysql_connect($server, $namauser, $passuser) or die("Cannot Connect To Database!!");
  	  mysql_select_db($db,$con);
	  
$data = mysql_query("SELECT * FROM test1aidy") or die(mysql_error());

while($dataOut = mysql_fetch_array($data))
{
	$tid = $dataOut['tid'];
	//echo $tid."<br>";
}
?>