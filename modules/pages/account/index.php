<?php if ($member)
{error_reporting(0);
	//if ($_POST[opchk] == "Login")
	//	$web->msg("You have successfully logged in");
	include "modules/pages/home/member.php";
}
else
	include "modules/pages/account/login.php";
?>
