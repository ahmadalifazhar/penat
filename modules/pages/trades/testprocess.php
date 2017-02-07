<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$nama = $_POST['nama'];
$nombor = $_POST['nombor'];

echo "nama : " . $nama . "<br>";
echo "nombor : " . $nombor . "<br>";

$queryinsert = mysql_query("INSERT INTO test VALUES ('".$nama."','".$nombor."')") or die(mysql_error());
	
	if(!$queryinsert)
	{
		echo "<script>alert('Fail to add data, please try again.')</script>";
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=registerstudent.php">'; 
	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=test.php">'; 
	}

?>