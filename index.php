<?php 
error_reporting(0);
include "modules/config.php";
include "modules/accDB.php";
include "modules/smiley.php";
include "modules/functions.php";
include "modules/mailsys.php";
//////////////////////// Accounts Module -Marhazli (pinit/01/04/003.a/01)
$accDB = array();
include "modules/pages/account/accounts.sys.php";
include "modules/pages/phpjobscheduler/firepjs.php";
include "modules/pintext.php";
$web = new PinIt();

	
if (isset($_REQUEST["op"]))
{
	if ($_REQUEST["op"] == "logout")
	{
		$includefile = "home";
		$admin = 0;
		$member = 0;
	}
	else if ($_REQUEST["op"] == "share")
	{
		include "share.php";
		die();
	}
	elseif ($op == "gfx")
	{
		if ($_REQUEST[type] == "icon")
		{
			$myImage = imagecreatefromgif("images/uploaded_images/resized/".$_REQUEST[file]."_t.gif");
			header("Content-type: image/gif");
			imagegif($myImage);
		}
		if ($_REQUEST[size] == "m")
		{
			$myImage = imagecreatefromjpeg("images/uploaded_images/resized/".$_REQUEST[file]."_m.jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		else if ($_REQUEST[type] == "jpg")
		{
			$myImage = imagecreatefromjpeg("images/uploaded_images/".$_REQUEST[file].".jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		else if ($_REQUEST[type] == "png")
		{
			$myImage = imagecreatefrompng("images/uploaded_images/".$_REQUEST[file].".png");
			header("Content-type: image/png");
			imagepng($myImage);
		}
		else if ($_REQUEST[type] == "gif")
		{
			$myImage = imagecreatefromgif("images/uploaded_images/".$_REQUEST[file].".gif");
			header("Content-type: image/gif");
			imagegif($myImage);
		}
		else
		{
			if (file_exists("images/uploaded_images/resized/".$_REQUEST[file].".jpg"))
				$myImage = imagecreatefromjpeg("images/uploaded_images/resized/".$_REQUEST[file].".jpg");
			else
				$myImage = imagecreatefromjpeg("images/uploaded_images/resized/".$_REQUEST[name].".jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		imagedestroy($myImage);
		die();

	}
	else
	{
		$includefile = $_REQUEST["op"];
	}
}
else
{
	$includefile = "home";
}
if ((isset($_REQUEST["header"])) && ($_REQUEST["header"] == 1))
{
	include "modules/include.php";
}
else
{
	include "modules/file.php";
}
?>