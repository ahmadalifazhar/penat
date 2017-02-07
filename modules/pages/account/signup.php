<?php
if ($opchk == "Continue")
{
	$chkExists = "SELECT * FROM accounts WHERE auname = '".$_POST[auname]."' OR aemail = '".$_POST[aemail]."'";
	$chkErr = false;
	if (mysql_fetch_array(mysql_query($chkExists)))
	{
		$chkErr = true;
		msg("ERROR", "Username or email is exists, please choose another");
	}
	else if (empty($_POST[auname]) || empty($_POST[aemail]) || empty($_POST[afname]) || empty($_POST[alname]))
	{
		$chkErr = true;
		msg("ERROR", "No values in the registeration form, please fill in the blanks");
	}
	else if ((strpos($_POST[auname]," ") !== false) || (strlen($_POST[auname]) < 5))
	{
		$chkErr = true;
		msg("ERROR", "Invalid username has entered. Please check your username. Make sure there is no spaces or symbols, more than 5 length");
	}
	else if (strlen($_POST[afname]) < 3)
	{
		$chkErr = true;
		msg("ERROR", "Invalid first name has entered. Please check your username. Make sure its more than 5 length");
	}
	else if (strlen($_POST[alname]) < 3)
	{
		$chkErr = true;
		msg("ERROR", "Invalid last name has entered. Please check your username. Make sure its more than 5 length");
	}
	else if ((strpos($_POST[aemail]," ") !== false) || (strlen($_POST[aemail]) <= 5))
	{
		$chkErr = true;
		msg("ERROR", "Invalid email address has entered. Please check your email.");
	}
	else if (!(strpos($_POST[aemail],"@") !== false))
	{
		$chkErr = true;
		msg("ERROR", "Invalid email address has entered. Please check your email.");
	}
	else if (!(strpos($_POST[aemail],".") !== false))
	{
		$chkErr = true;
		msg("ERROR", "Invalid email address has entered. Please check your email.");
	}
	if ($chkErr)
		include "modules/pages/account/register1.php";
	else
		include "modules/pages/account/register2.php";
}
else if ($opchk == "Register")
{
	if ($_POST[apwd1] == $_POST[apwd2])
	{
		$details[aid]		=	"10".time();
		$details[auname]	=	base64_decode($_POST[a1]);
		$details[aemail]	=	base64_decode($_POST[a2]);
		$details[afname]	=	base64_decode($_POST[a3]);
		$details[alname]	=	base64_decode($_POST[a4]);
		$details[apwd]		=	$_POST[apwd1];
		$details[asq]		=	$_POST[asq];
		$details[asa]		=	$_POST[asa];
		$details[areg]		=	gendate(time());
		$regsql = gendata("accounts", $details, "INSERT");
		if (strlen($_POST[apwd1]) <= 5)
		{
			$chkErr = true;
			msg("ERROR", "Invalid password has entered. Please check your username. Make sure its more than 5 length");
			include "modules/pages/account/register1.php";
		}
		else if (mysql_query($regsql))
		{	
			$detailfs[aid]		= $details[aid];
			$detailfs[faid]		= 0;
			$detailfs[approve]	= 0;
			$regsql = gendata("friends", $detailfs, "INSERT");
			mysql_query($regsql);
			
			$detailp[aid]	= $details[aid];
			$regsql2 = gendata("privacies", $detailp, "INSERT");
			mysql_query($regsql2);
			msg("NOTICE", "Registeration completed, you may logged in now");
			include "modules/pages/home/index.php";
		}
		else
		{
			msg("ERROR", "Registeration failed, check your details");
			include "modules/pages/account/register1.php";
		}
	}
	else
	{
		msg("ERROR", "Registeration failed, check your passwords and more than 5 length");
		include "modules/pages/account/register1.php";
	}
}
else
	include "modules/pages/account/register1.php";
?>