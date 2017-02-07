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

echo "Hello ".$account[auname]." (User ID: ".$chkid.") - ".$account[aid];

echo "Upload: " . $_FILES["file"]["name"] . "<br>";
echo "Type: " . $_FILES["file"]["type"] . "<br>";
echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
?>

<?php

$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));

if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/jpg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  || ($_FILES["file"]["type"] == "image/x-png")
  || ($_FILES["file"]["type"] == "image/png"))
	
  && in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
    {
    	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    	if (file_exists("files/" . $_FILES["file"]["name"]))
      	{
     		echo $_FILES["file"]["name"] . " already exists. ";
      	}
    	else
      	{
			  move_uploaded_file($_FILES["file"]["tmp_name"],
			  $account[auname] . "-" . $_FILES["file"]["name"]);
			  echo "Stored in: " . "files/" . $account[auname] . "-" . $_FILES["file"]["name"];
			  
			  //echo "<img src='files/".$account[auname] . "-" . $_FILES["file"]["name"]."'>";
      	}
    }
  }
else
{
	echo "Invalid file";
}

?>
</body>

</html>