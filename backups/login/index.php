<?php
	if ((strlen($_POST["uname"]) >= 1) && (isset($_POST["upass"]))
	{
		//Fetching the 1st stage of registration of the current registrar
		$result = mysql_query("SELECT * FROM accounts WHERE uname='".$_POST[uname]."'");
		{
			$row = mysql_fetch_array($result);
			if ($row[upass] == $_POST[upass])
			{
				//Generate the SESSION to make sure the user is REAL!!
				// $data = gendata("accounts", $udetail, "MYSQL");
				// mysql_query($data[0]);
				//
				$web->loadpage("profile", "index.html", $row);
			}
			else
			{
				$web->msg("Howdy _UNAME_, failed to login. Please check your password.");
				$web->loadpage("login", "index.html", $row);
			}
		}
		else
		{
			$web->errmsg("Howdy _UNAME_, failed to login. Your username is not existed.");
			$web->loadpage("login", "index.html", $_POST); //Use _POST instead of ROW for security reasons
		}
	}
	else
	{
		$web->msg("Hello there, failed to login. Please check your username and password form.");
		$web->loadpage("login", "index.html", $_POST);
	}
?>