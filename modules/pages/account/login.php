<?php if ($member)
{
	//msg("NOTIS", "You have successfully logged in");
	
}
else
{
	$web->loadpage("modules/pages/account", "login2.php", $_POST);
}
?>

