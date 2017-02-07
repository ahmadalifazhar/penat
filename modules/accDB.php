<?php
	// 0 = Not Logged in
	// 1 = Unexisted user - unknown user
	// 2 = Unexisted user - fail auth
	// 3 = Invalid auth
	// 5 = Logged in
	$cookieidDetail = 0;
	$cookieExpiry = 60*60*7; //expired in 7 days

	// EOF
	$uAuth = $_REQUEST[auth];
	$uID = $_REQUEST[uid];
	if ($cookieAuthID >= 1)
	{
            
		setcookie("$cookienameID",$cookieAuthID, time()+$cookieExpiry);
                $sql = "SELECT * FROM accounts WHERE aid='$cookieAuthID' LIMIT 0,1";
		$userRow = mysql_fetch_array(MySQL_Query($sql));
		$account = $userRow;
		$chkid = $userRow[aid];
		if ($_REQUEST["op"] == "logout")
		{
			$logoutmsg = "<p>Anda telah berjaya keluar dari sistem.</p>";
			setcookie($cookienameID, "", time()-3600);
			$account[afname] = "";
		}
	}
        
	else if (isset($_POST['auname']))
	{
		setcookie($cookienameID, "", time()-3600);
		//$_SESSION[$cookienameID] = 0;
		//$_SESSION[$cookienameAuth] = 0;
		$Login = $_POST['auname'];
		$pwd = $_POST['apwd'];
		
		
		if (empty($Login) || empty($pwd))
		{
			$uWeb_accountdbmsg = " - All fields is empty.";
		}
		else if ($userRow = mysql_fetch_array(MySQL_Query("SELECT * FROM accounts WHERE auname='$Login' AND apwd='$pwd' LIMIT 0,1")))
		{
			if ((StrLen($Login) < 4) or (StrLen($Login) > 120)) 
			{
				$uWeb_accountdbmsg = " - Login must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 120)) 
			{
				$uWeb_accountdbmsg = " - Password must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 120))
			{
				$uWeb_accountdbmsg = " - Repeat password must have more 4 and not more 10 symbols.";
			}
			else if ($userRow["aid"] >= 1)
			{
				$userWebID=5;
				$chkid = $userRow["aid"];
	
				$uWeb_vinfo = $userRow;
				$cookieAuthID = $chkid;
				setcookie("$cookienameID",$userRow['aid'], time()+$cookieExpiry);
				$account = $userRow;
				//$_REQUEST[option] = $defaultmID;
			}
			else
			{
				die("TEST".$userRow["aid"]);
			}
		}
	}
	if ($cookieAuthID >= 1)
	{
		if ($account[apos] >= 5)
		{
			$member = 1;
			$admin = 1;
			
			$startMid = $account[mid];
			$endMid = $account[mid]+99;
			if ($account[pos] == 5)
			{
				// SUPER ADMIN - FULL ACCESS
				$admin = 5;
			}
			else if (($account[pos] >= 2) && (substr($account[mid],1,2) == "00"))
			{
				// ADMIN
				$admin = 4;
			}
			else if ($account[pos] >= 2)
			{
				// STAFF
				$admin = 3;
			}
		}
		else
		{
			$member = 1;
			$admin = 0;
		}
	}

?>