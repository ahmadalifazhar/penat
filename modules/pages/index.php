<?php if ($member)
{
	if ($_POST[opchk] == "Login")
		msg("NOTIS", "You have successfully logged in");
	include "modules/pages/home/member.php";
}
else
	include "modules/pages/account/login.php";
?>
