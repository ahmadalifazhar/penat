<?php
	// 0 = Not Logged in
	// 1 = Unexisted user - unknown user
	// 2 = Unexisted user - fail auth
	// 3 = Invalid auth
	// 5 = Logged in
	$cookieidDetail = 0;
	$cookieExpiry = 60*60*24; //expired in 1 day        

	// EOF
	$uID = $_REQUEST[uid];
	if ($cookieAuthID >= 1)
	{
		$userRow = mysql_fetch_array(mssql_query("SELECT * FROM account WHERE auth='$cookieAuthName', aid='$cookieAuthID' LIMIT 0,1"));
		if ($userRow)
		{
			$cookieAuthName = md5(time());
			mysql_query("UPDATE account set auth='$cookieAuthName' WHERE aid='$cookieAuthID'");
			$account = $userRow;
			if (page("logout"))
			{
				$userWebID=2;
				$logoutmsg = "<p>You have been logged out.</p>";
				$_SESSION[$cookienameID] = "";
				$_SESSION[$cookienameName] = "";
			}
			else
			{
				$userWebID=4;
			}
		}
	}
	else if (isset($_POST['username']))
	{
		$Login = $_POST['username'];
		$pwd = $_POST['passwd'];
		if (empty($Login) || empty($pwd))
		{
			$uWeb_accountdbmsg = " - All fields is empty.";
		}
		else if ($userRow = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE uname='$Login' AND upass='$pwd' LIMIT 0,1")))
		{
			if ($userRow["aid"] >= 1)
			{
				$chkid = $userRow["aid"];
				$cookieAuthID = $chkid;
				$cookieAuthName = md5(time());
				mysql_query("UPDATE account set auth='$cookieAuthName' WHERE aid='$cookieAuthID'");
				$account = $userRow;
				$uWeb_vinfo = $userRow;
				$userWebID=5;
			}
		}
	}
	if ($userWebID >= 4)
	{
		$_SESSION[$cookienameID] = $cookieAuthID;
		$_SESSION[$cookienameName] = $cookieAuthName;
	}

?>