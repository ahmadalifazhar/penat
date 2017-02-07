<?php
if (page("register"))
{
	$err = 0;
	$errtext = "";
	$minlen = 6;
	$maxlen = 10;
	if (!chk($_POST[uname], $minlen, $maxlen, false))
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Username is short than $minlen or large than $maxlen</font>";
	}
	if (!chk($_POST[upass], $minlen, $maxlen, true))
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Password is short than $minlen or large than $maxlen, or does not contain small and big letters, and numbers</font>";
	}
	if ($_POST[upass] !== $_POST[upass2])
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Password is mismatch with the retyped password</font>";
	}
	if (!chk($_POST[usa1], $minlen, $maxlen, false))
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Secret Answer no 1 is short than $minlen or large than $maxlen</font>";
	}
	if (!chk($_POST[usa2], $minlen, $maxlen, false))
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Secret Answer no 2 is short than $minlen or large than $maxlen</font>";
	}
	if (!chk($_POST[dob], $minlen, $maxlen, false))
	{
		$err = $err + 1;
		$errtext .= "<font color=red>ERROR: Secret Answer no 2 is short than $minlen or large than $maxlen</font>";
	}
	if ($err < 1)
	{
		sql("
	}
}
?>